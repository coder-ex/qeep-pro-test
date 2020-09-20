<?php

namespace App\Service;

use App\Entity\GoogleCache;
use App\Entity\Filter;
use App\Entity\Statistics;
use App\Repository\FilterRepository;
use App\Repository\GoogleCacheRepository;
use App\Repository\StatisticsRepository;
use Doctrine\ORM\EntityManagerInterface;

class GoogleService
{
    /** @var EntityManagerInterface $entityManager*/
    private $entityManager;

    public function __construct(EntityManagerInterface $manager) {
        $this->entityManager = $manager;
    }

    public function getFilterAll() {
        /** @var FilterRepository $filterRepository */
        $filterRepository = $this->entityManager->getRepository(Filter::class);
        return $filterRepository->findAll();
    }

    public function getFilterOne(string $keyword) {
        /** @var FilterRepository $filterRepository */
        $filterRepository = $this->entityManager->getRepository(Filter::class);
        return $filterRepository->findOneFilter($keyword);
    }

    public function getKeyAll(string $keyword): array {
        /** @var GoogleCacheRepository $googleRepository */
        $googleRepository = $this->entityManager->getRepository(GoogleCache::class);
        return $googleRepository->findAllUnit($keyword);
    }

    public function getAll(): array {
        /** @var GoogleCacheRepository $googleRepository */
        $googleRepository = $this->entityManager->getRepository(GoogleCache::class);
        return $googleRepository->findAll();
    }

    public function saveAll(array $data): int {
        if(!isset($data)) return 0;

        //--- установка временной зоны по умолчанию. Доступно с PHP 5.1 (что бы дата/время выводилось без ошибок)
        date_default_timezone_set('UTC');
        $_today = date("Y-m-d H:i:s");                   // 2001-03-10 17:16:18 (формат MySQL DATETIME)

        $batchSize = 20; $cnt = 0;
        foreach($data as $key => $value) {
            $value['histogram'] = serialize($value['histogram']);
            $value['screenshots'] = serialize($value['screenshots']);
            $value['comments'] = serialize($value['comments']);

            $stat_data = [];
            $stat_data['date'] = $_today;
            if(!isset($value['score']))
                $stat_data['score'] = '0.0';
            else
                $stat_data['score'] = $value['score'];

            if(!isset($value['reviews']))
                $stat_data['reviews'] = '0';
            else
                $stat_data['reviews'] = $value['reviews'];

            if(!isset($value['ratings']))
                $stat_data['ratings'] = '0';
            else
                $stat_data['ratings'] = $value['ratings'];

            $unit = new GoogleCache($value);

            $stat = new Statistics();
            $stat->setData( [ $stat_data, ] );

            // установка связей в таблицах
            $stat->setGoogleCache($unit);
            $unit->setStatistics($stat);

            $this->entityManager->persist($unit);
            $this->entityManager->persist($stat);
            // сбрасывать все в базу данных каждые 20 вставок

            if(($key % $batchSize) == 0) {
                $this->entityManager->flush();
                $this->entityManager->clear();
            }
            $cnt++;
        }
        // промыть оставшиеся предметы
        $this->entityManager->flush();
        $this->entityManager->clear();
        //---
        return $cnt;
    }

    public function updateAll(array $data): array {
        if(!isset($data)) return [];

        //--- установка временной зоны по умолчанию. Доступно с PHP 5.1 (что бы дата/время выводилось без ошибок)
        date_default_timezone_set('UTC');
        $_today = date("Y-m-d H:i:s");                   // 2001-03-10 17:16:18 (формат MySQL DATETIME)

        /** @var GoogleCacheRepository $googleRepository */
        $googleRepository = $this->entityManager->getRepository(GoogleCache::class);
        $new_arr = [];
        foreach($data as $key => $value) {
            $unit = $googleRepository->findOneByAppId($value['appId']);
            if($unit === null) {       // запомним отсутствующий юнит для записи в DB
                $new_arr[] = $data[$key];
                continue;
            } else {                    // если есть, то обновим в DB
                $stat_data = [];
                $stat_data['date'] = $_today;
                if(!isset($data[$key]['score']))
                    $stat_data['score'] = '0.0';
                else
                    $stat_data['score'] = $data[$key]['score'];

                if(!isset($data[$key]['reviews']))
                    $stat_data['reviews'] = '0';
                else
                    $stat_data['reviews'] = $data[$key]['reviews'];

                if(!isset($data[$key]['ratings']))
                    $stat_data['ratings'] = '0';
                else
                    $stat_data['ratings'] = $data[$key]['ratings'];

                $t_stat_data = $unit->getStatistics()->getData();
                array_push($t_stat_data, $stat_data);
                $unit->getStatistics()->setData($t_stat_data);

                $this->entityManager->flush();
                $this->entityManager->clear();
            }
        }
        //---
        return $new_arr;
    }
}