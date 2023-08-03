<?php

namespace application\core;

use application\contracts\DatabaseInterface;

abstract class Model
{
    public $db;

    public function __construct(DatabaseInterface $Database) {
        $this->db = $Database;
    }
}