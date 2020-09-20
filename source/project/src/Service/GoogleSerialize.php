<?php

namespace App\Service;


class GoogleSerialize
{
    /** @var GoogleService $googleService*/
    private $googleService;

    private $key;
    private $exception;      // исключить из отображения для google_all_scraper || google_stat
    private $required = [];  // обязательные для показа

    public function __construct(GoogleService $service, array $key, bool $flag=false) {
        $this->googleService = $service;
        $this->key = &$key;
        $this->create_arrays($flag);
    }

    public function serialize(array $data, int $width=30) {
        //$db = null;

        //$db = $this->googleService->getAll($data['keyword']);   // получим данные из DB
        $db = $this->googleService->getAll();// getAll($data['keyword']);   // получим данные из DB
        return $this->casting($db, $width);              // сделаем кастинг для вывода данных
    }

    /**
     * Кастинг Массива PHP под вывод данных
     * @param array $data
     * @param int $width
     * @return array
     */
    private function casting(array &$data, int $width): array {
        $arr = [];
        foreach ($data as $key => $val) {
            $arr_t = [];
            $val_t = $val->getDataProp();
            foreach ($val_t as $k => $v) {
                // исключим не нужные поля
                if(!$this->check($k, $this->exception)) {
                    if($k === 'statistics')
                        $v = json_encode($v->getData());
                    array_push($arr_t, ['name' => $k, 'value' => $v, 'strim' => mb_strimwidth($v, 0, $width),]);
                }
            }
            // добавим нужные но отсутствующие в данных, как пустые значения
            $size = count($this->required);
            $flag = false;
            for ($i = 0; $i < $size; $i++) {
                if($flag) $flag = false;
                foreach ($val_t as $k => $v) {
                    if ($this->required[$i] === $k) {
                        $flag = true;
                        break;
                    }
                }
                if(!$flag)
                    array_push($arr_t, [ 'name' => $this->required[$i], 'value' => '-----', 'strim' => '-----', ]);
            }
            array_push($arr, $this->order_headers($arr_t));
        }
        //---
        return $arr;
    }

    /**
     * упорядочивание вывода заголовков и данных (проблема с PHP массивами, могут менять порядок)
     * @param array $data
     * @return array
     */
    private function order_headers(array &$data): array {
        $arr = [];
        $len = count($this->key);
        for($i = 0; $i < $len; $i++) {
            foreach($data as $k => $v) {
                if($v['name'] === $this->key[$i])
                    $arr[] = $v;
            }
        }
        //---
        return $arr;
    }

    /**
     * проверка ключей
     * @param string $check
     * @param array $arr
     * @return bool
     */
    private function check(string $check, array &$arr): bool {
        foreach($arr as $item)
            if($check === $item)
                return true;
        //---
        return false;
    }

    /**
     * Создание массива исключений и обязательных значений
     */
    private function create_arrays($flag) {
        if(!$flag) {
            $this->exception = [
                'descriptionHTML',
                'histogram',
                'androidVersionText',
                'developerId',
                'developerInternalID',
                'genreId',
                'familyGenreId',
                'screenshots',
                'video',
                'videoImage',
                'contentRatingDescription',
                'adSupported',
                'updated',
                'recentChanges',
                'comments',
                'editorsChoice',
                'statistics',
            ];
        } else {
            $this->exception = [
                'description',
                'descriptionHTML',
                'summary',
                'installs',
                'minInstalls',
                'maxInstalls',
                'score',
                'scoreText',
                'ratings',
                'reviews',
                'histogram',
                'price',
                'free',
                'currency',
                'priceText',
                'offersIAP',
                'IAPRange',
                'size',
                'androidVersion',
                'androidVersionText',
                'developer',
                'developerId',
                'developerEmail',
                'developerWebsite',
                'developerAddress',
                'privacyPolicy',
                'developerInternalID',
                'genre',
                'genreId',
                'familyGenre',
                'familyGenreId',
                'icon',
                'headerImage',
                'screenshots',
                'video',
                'videoImage',
                'contentRating',
                'contentRatingDescription',
                'adSupported',
                'released',
                'updated',
                'version',
                'recentChanges',
                'comments',
                'editorsChoice',
                'url',
            ];
        }

        $flag = false;
        foreach ($this->key as $item_k) {
            if($flag) $flag = false;
            foreach ($this->exception as $item_e) {
                if($item_k === $item_e) {
                    $flag = true;
                    break;
                }
            }
            if(!$flag)
                $this->required[] = $item_k;
        }
    }
}