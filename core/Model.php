<?php

namespace Core;

use App\Config;
use mysqli;

/**
 * Базовый класс реализующий модели
 */
 abstract class Model {
     
    /**
     * Возвращает подключение к базе данных
     * 
     * @return mixed
     */
    protected static function getDB() {
        static $db = null;
        
        if ($db === null)
            $db = @new mysqli(Config::DB_HOST, Config::DB_USER, Config::DB_PASS, Config::DB_NAME);

        return $db;
    }
 }