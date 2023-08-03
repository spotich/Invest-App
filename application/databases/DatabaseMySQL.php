<?php

namespace application\databases;
use application\contracts\DatabaseInterface;
use PDO;
use PDOStatement;

class DatabaseMySQL implements DatabaseInterface
{
    private $db;

    public function __construct()
    {
        $this->db = ConnectionToMySQL::connect();
    }

    public function executeQuery($query, $params = []): false|PDOStatement {
        $stmt = $this->db->prepare($query);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $stmt->bindParam(":$key", $val);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function row($query, $params = []): array|false {
        $result = $this->executeQuery($query, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = []) {
        $result = $this->executeQuery($sql, $params);
        return $result->fetchColumn();
    }
}