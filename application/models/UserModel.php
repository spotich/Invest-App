<?php

namespace application\models;
use application\core\Model;

class UserModel extends Model
{
    public function getUserByEmail($email): array|null {
        $params = ['email' => $email];
        $result = $this->db->getRow('SELECT * FROM users WHERE email = :email', $params);
        return (!$result) ? null : $result[0];
    }

    public function getUserById($id): array|null {
        $params = ['id' => $id];
        $result = $this->db->getRow('SELECT * FROM users WHERE id = :id', $params);
        return (!$result) ? null : $result[0];
    }

    public function createNewUser($user = []) {
        $ok = (isset($user['name']) and isset($user['surname']) and isset($user['email']) and isset($user['role']) and isset($user['password']));
        if ($ok) {
            $this->db->executeQuery('INSERT INTO users (name, surname, email, role, password) VALUES (:name, :surname, :email, :role, :password)', $user);
        }
        return false;
    }

    public function updateAuthenticationCodeForUser(int $id): string {
        $code = bin2hex(random_bytes(20));
        $params = [
            'id' => $id,
            'two_factor_authentication_code' => $code,
        ];
        $this->db->executeQuery('UPDATE users SET two_factor_authentication_code = :two_factor_authentication_code WHERE id = :id', $params);
        return $code;
    }

    public function updateExpirationTimeForUser(int $id) {
        $expiry = 7 * 24 * 60 * 60; // 1 week
        $time = date('Y-m-d H:i:s',  time() + $expiry);
        $params = [
          'id' => $id,
          'expiration_time' => $time,
        ];
        $this->db->executeQuery('UPDATE users SET expiration_time = :expiration_time  WHERE id = :id', $params);
    }
}