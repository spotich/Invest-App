<?php

namespace application\models;
use application\core\Model;
date_default_timezone_set('Asia/Novosibirsk');

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

    public function createResetCodeForUser(int $user_id): string {
        $expiry = 5 * 60; // 5 min
        $expiration_time = date('Y-m-d H:i:s',  time() + $expiry);
        $reset_code = bin2hex(random_bytes(20));
        $params = [
            'user_id' => $user_id,
            'reset_code' => $reset_code,
            'expiration_time' => $expiration_time,
        ];
        $this->db->executeQuery('INSERT INTO resets (user_id, reset_code, expiration_time) VALUES (:user_id, :reset_code, :expiration_time)', $params);
        return $reset_code;
    }

    public function getResetDataForUser(int $user_id): array|false {
        $params = [
            'user_id' => $user_id,
        ];
        $result = $this->db->getRow('SELECT resets.reset_code, resets.expiration_time FROM users INNER JOIN resets ON (users.id=resets.user_id) WHERE users.id=:user_id', $params);
        $this->db->executeQuery('DELETE FROM resets WHERE user_id=:user_id', $params);
        return $result;
    }
}