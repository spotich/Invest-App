<?php

namespace application\models;
use application\core\Model;

class UserModel extends Model
{

    public function getUserByEmail($email): array {
        $params = ['email' => $email];
        $result = $this->db->row('SELECT * FROM users WHERE email = :email', $params);
        return $result[0];
    }


}