<?php

declare(strict_types=1);

namespace App\Controller\Traits;

trait MessageGenerator
{
    /**
     * вывод сообщений через form.js - результаты fetch запросы
     */
    public function message(string $status, string $message) {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }
}