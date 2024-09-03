<?php

namespace MVC\core;

class Database
{
    private static $connection = null;

    private function __construct(){}

    private function __clone(){}

    public static function getConnection()
    {
        if (self::$connection == null) {
            self::initConnection();
        }
        return self::$connection;
    }

    private static function initConnection()
    {
        $config = require __DIR__ . '/../config/config.php';

        self::$connection = new \mysqli($config['host'],$config['username'],$config['password'],$config['db_name']);

        if (self::$connection->connect_error) {
            echo "Connection failed: " . self::$connection->connect_error;
        }
    }
}