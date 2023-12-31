<?php

namespace InvestApp\application\databases;

use PDO;

class ConnectionToMySQL
{
    private static $conn = null;

    private function __construct() {

    }

    private function __clone() {

    }

    public static function connect(): ?PDO {
        if (self::$conn == null) {
            if(file_exists(dirname(__DIR__, 1) . '/config/db.php')) {
                $config = require dirname(__DIR__, 1) . '/config/db.php';
                self::$conn = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'], $config['user'], $config['password']);
            } else {
                return null;
            }
		}
		return self::$conn;
	}
}