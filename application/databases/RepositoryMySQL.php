<?php

namespace InvestApp\application\databases;

use InvestApp\application\contracts\Repository;
use PDO;
use PDOStatement;

abstract class RepositoryMySQL implements Repository
{
    public $db;

    public function __construct()
    {
        $this->db = ConnectionToMySQL::connect();
        if (is_null($this->db)) {
            echo 'Database connection error';
            exit;
        }
    }

    public function executeQuery($query, $params = []): false|PDOStatement
    {
        $stmt = $this->db->prepare($query);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(":$key", $val);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function getRow($query, $params = []): array|false
    {
        $result = $this->executeQuery($query, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getColumn($sql, $params = [])
    {
        $result = $this->executeQuery($sql, $params);
        return $result->fetchColumn();
    }
}