<?php

namespace InvestApp\application\contracts;

interface Database
{
    public function executeQuery($query, $params = []);
    public function getRow($query, $params = []);
    public function getColumn($sql, $params = []);
}