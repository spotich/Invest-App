<?php

namespace application\contracts;

interface DatabaseInterface
{
    public function executeQuery($query, $params = []);
    public function row($query, $params = []);
    public function column($sql, $params = []);
}