<?php

namespace application\models;
use application\core\Model;

class UserModel extends Model
{
    public function getUserByEmail($email) {
        $params = ['email' => $email];
        $result = $this->db->row('SELECT * FROM users WHERE email = :email', $params);
        return (!$result) ? null : $result[0];
    }

    public function addUser($user = []): bool {
        if (!empty($user)) {
            $user['tfa'] = bin2hex(random_bytes(20));
            $result = $this->db->executeQuery('INSERT INTO users (name, surname, email, role, password, tfa) VALUES (:name, :surname, :email, :role, :password, :tfa)', $user);
        }
        return $result;
    }
}