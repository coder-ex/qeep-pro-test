<?php


namespace App\Service;

use App\Entity\Filter;
use App\Entity\Profile;
use App\Repository\FilterRepository;
use Doctrine\ORM\EntityManagerInterface;

class FilterService
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function getFilterAll() {
        /** @var FilterRepository $filterRepository */
        $filterRepository = $this->entityManager->getRepository(Filter::class);
        return $filterRepository->findAll();
    }

    public function getFilter(string $keyword) {
        /** @var FilterRepository $configRepository */
        $configRepository = $this->entityManager->getRepository(Filter::class);
        return $configRepository->findOneFilter($keyword);
    }

    public function save(string $user, string $keyword, int $depth, bool $active): ?int {
        /** @var Profile $user */
        $profile = $this->entityManager->getRepository(Profile::class)->findOneBySomeField($user);

        if($profile === null) {     // моделируем ситуацию отсутствия пользователя в DB
            $profile = new Profile();
            $profile->setName($user);
        }

        $filter = new Filter();
        $filter->setKeyword($keyword);
        $filter->setDepth($depth);

        if($active) {
            $filter->addProfile($profile);
            $this->entityManager->persist($profile);
        }
        $this->entityManager->persist($filter);

        $this->entityManager->flush();
        $this->entityManager->clear();
        //---
        return $filter->getId();
    }

    public function update(int $f_id, string $keyword, int $depth, string $user=null): bool {
        /** @var FilterRepository $filterRepository */
        $filterRepository = $this->entityManager->getRepository(Filter::class);
        /** @var Filter $filter */
        $filter = $filterRepository->find($f_id);

        if($filter === false) return false;
        if(strlen($keyword) > 0 && $keyword != $filter->getKeyword()) $filter->setKeyword($keyword);
        if($depth != $filter->getDepth()) $filter->setDepth($depth);

        if($user) {
            /** @var Profile $profile */
            $profile = $this->entityManager->getRepository(Profile::class)->findOneBySomeField($user);
            $profile->setFilter($filter);
            $filter->addProfile($profile);
            $this->entityManager->persist($profile);
        }

        $this->entityManager->flush();
        $this->entityManager->clear();
        //---
        return true;
    }

    public function delete(int $p_id): bool {
        /** @var FilterRepository $filterRepository */
        $filterRepository = $this->entityManager->getRepository(Filter::class);
        $filter = $filterRepository->find($p_id);

        if($filter === false) return false;

        $this->entityManager->remove($filter);
        $this->entityManager->flush();
        $this->entityManager->clear();
        //---
        return true;
    }
}