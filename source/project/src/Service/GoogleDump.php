<?php

namespace App\Service;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class GoogleDump
{
    /** @var GoogleService $googleService */
    private $googleService;

    public function __construct(GoogleService $service) {
        $this->googleService = $service;
    }

    /*
    Позиция в выдаче - ? score
    Количество отзывов - reviews
    Количество оценок - ratings
    Общий рейтинг - ? ratings

            //--- установка временной зоны по умолчанию. Доступно с PHP 5.1 (что бы дата/время выводилось без ошибок)
        date_default_timezone_set('UTC');
        $_today = date("Y-m-d H:i:s");                   // 2001-03-10 17:16:18 (формат MySQL DATETIME)
    */

    /**
     * сахар по получению данных
     * @param array $param - [ 'keyword' => 'ребро', 'depth' => 100 ]
     * @param string $path
     * @return int
     */
    public function run(array $param, string $path=''): int {
        // получаем данные
        $process = new Process([
            'nodejs',
            ($path==='') ? './js/google_parser.js' : $path,
            '--keyword='.$param['keyword'],
            '--depth='.$param['depth']
        ]);
        $process->setTimeout(600);
        $process->run();
        if(!$process->isSuccessful())                      // выполнится после завершения команды
            throw new ProcessFailedException($process);

        $res = json_decode($process->getOutput(), true);
        $res_check = $this->checkOverlap($res);
        //---
        return $this->googleService->saveAll($this->googleService->updateAll($res_check));
    }

    /**
     * проверка на совпадения по appId (ID в google play) из запроса
     * @param array $arr_check
     * @return array
     */
    private function checkOverlap(array $arr_check):array {
        $size = count($arr_check);
        $arr = [];
        $flag = false;
        for($i = 0; $i < $size; $i++) {
            if($flag) $flag = false;

            if($i == 0) {
                array_push($arr, ['arr' => $arr_check[$i], 'overlap' => 0,]);
                continue;
            }

            foreach ($arr as $key => $value) {
                if($arr[$key]['arr']['appId'] === $arr_check[$i]['appId']) {
                    $arr[$key]['overlap'] += 1;
                    $flag = true;
                    break;
                }
            }

            if($flag) continue;

            array_push($arr, ['arr' => $arr_check[$i], 'overlap' => 0,]);
        }
        $arr_new = [];
        $size_t = count($arr);
        for($i = 0; $i < $size_t; $i++) {
            if ($arr[$i]['overlap'] == 0)
                $arr_new[] = $arr[$i]['arr'];
        }
        //---
        return $arr_new;
    }

    /**
     * фильтр на новые по appId (ID в google play)
     * @param array $arr_new
     * @return array
     */
    private function filterNewData(array $arr_new): array {
        $arr_old = $this->googleService->getAll();
        $size = count($arr_new);
        $arr = [];
        $flag = false;
        for($i = 0; $i < $size; $i++) {
            if($flag) $flag = false;

            foreach ($arr_old as $key => $value) {
                if($arr_new[$i]['appId'] == $arr_old[$key]->getAppId()) {
                    $flag = true;
                    break;
                }
            }
            if($flag) continue;

            $arr[] = $arr_new[$i];
        }
        //---
        return $arr;
    }
}