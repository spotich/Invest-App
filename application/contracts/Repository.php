<?php

namespace InvestApp\application\contracts;

interface Repository
{
    public function executeQuery($query, $params = []);
    public function getRow($query, $params = []);
    public function getColumn($sql, $params = []);
    public function getUnique($sql, $params = []);

}