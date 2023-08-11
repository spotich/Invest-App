<?php

namespace application\databases;
use application\contracts\Database;
use PDO;
use PDOStatement;

abstract class DatabaseMySQL implements Database
{
    public $db;

    public function __construct()
    {
        $this->db = ConnectionToMySQL::connect();
    }

    public function executeQuery($query, $params = []): false|PDOStatement {
        $stmt = $this->db->prepare($query);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(":$key", $val);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function getRow($query, $params = []): array|false {
        $result = $this->executeQuery($query, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getColumn($sql, $params = []) {
        $result = $this->executeQuery($sql, $params);
        return $result->fetchColumn();
    }
}