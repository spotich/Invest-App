<?php

namespace application\contracts;

interface DatabaseInterface
{
    public function executeQuery($query, $params = []);
    public function getRow($query, $params = []);
    public function getColumn($sql, $params = []);
}