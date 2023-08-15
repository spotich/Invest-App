<?php

namespace application\databases;

use application\contracts\UserRepository;

date_default_timezone_set('Asia/Novosibirsk');

class UserRepositoryMySQL extends DatabaseMySQL implements UserRepository
{
    public function getUserByEmail(string $email): ?array
    {
        $params = [
            'email' => $email,
            ];
        $result = $this->getRow('SELECT * FROM users WHERE email = :email', $params);
        return is_array($result) ? $result[0] : null;
    }

    public function getUserAvatar($id): ?string
    {
        $params = [
            'id' => $id,
        ];
        $result = $this->getRow('SELECT ua.name as avatar FROM users u JOIN user_avatars ua ON u.id = ua.user_id WHERE u.id = :id', $params);
        return is_array($result) ? $result[0]['avatar'] : null;
    }

    public function getUserById(int $id): ?array
    {
        $params = ['id' => $id];
        $result = $this->getRow('SELECT u.*, ua.name as avatar FROM users u JOIN user_avatars ua ON u.id = ua.user_id WHERE u.id = :id', $params);
        return is_array($result) ? $result[0] : null;
    }

    public function createNewUser(array $user): ?int
    {
        $ok = (isset($user['name']) and isset($user['surname']) and isset($user['email']) and isset($user['role']) and isset($user['password']));
        if ($ok) {
            $this->executeQuery('INSERT INTO users (name, surname, email, role, password) VALUES (:name, :surname, :email, :role, :password)', $user);
            $code = bin2hex(random_bytes(20));
            $id = $this->getUserByEmail($user['email'])['id'];

            $params = [
                'user_id' => $id,
                'code' => $code,
            ];
            $this->executeQuery('INSERT INTO authentications (code, user_id) VALUES (:code, :user_id)', $params);
            unset($params['code']);
            $params['name'] = 'person.jpg';
            $this->executeQuery('INSERT INTO user_avatars (user_id, name) VALUES (:user_id, :name)', $params);
        }
        return is_int($id) ? $id : null;
    }

    public function getAuthenticationDataForUser(int $id): ?array
    {
        $params = [
            'user_id' => $id,
        ];
        $result = $this->getRow('SELECT code, expiration_time FROM authentications WHERE user_id=:user_id', $params);
        return is_array($result) ? $result[0] : null;
    }

    public function updateUser(array $user): ?bool
    {
        $ok = (isset($user['id']) and (isset($user['name']) or isset($user['surname']) or isset($user['email']) or isset($user['role']) or isset($user['password'])));
        if ($ok) {
            $id = $user['id'];
            unset($user['id']);
            $setting = '';
            foreach (array_keys($user) as $key) {
                $setting = "$setting$key = :$key, ";
            }
            $setting = substr($setting, 0, -2);
            $user['id'] = (int)$id;
            $result = $this->executeQuery("UPDATE users SET $setting WHERE id=:id ", $user);
            if ($result === false) {
                return false;
            } else {
                return true;
            }
        } else {
            return null;
        }
    }

    public function newAuthenticationCodeForUser(int $id): ?string
    {
        $code = bin2hex(random_bytes(20));
        $params = [
            'user_id' => $id,
            'code' => $code,
        ];
        $result = $this->executeQuery('UPDATE authentications SET code = :code WHERE user_id = :user_id', $params);
        if ($result === false) {
            return null;
        } else {
            return $code;
        }
    }

    public function newExpirationTimeForUser(int $id)
    {
        $expiry = 7 * 24 * 60 * 60; // 1 week
        $time = date('Y-m-d H:i:s', time() + $expiry);
        $params = [
            'user_id' => $id,
            'expiration_time' => $time,
        ];
        $result = $this->executeQuery('UPDATE authentications SET expiration_time = :expiration_time  WHERE user_id = :user_id', $params);
        if ($result === false) {
            return null;
        }
    }

    public function newResetCodeForUser(int $id): ?string
    {
        $expiry = 5 * 60; // 5 min
        $expiration_time = date('Y-m-d H:i:s', time() + $expiry);
        $reset_code = bin2hex(random_bytes(20));
        $params = [
            'user_id' => $id,
            'reset_code' => $reset_code,
            'expiration_time' => $expiration_time,
        ];
        $result = $this->executeQuery('INSERT INTO resets (user_id, reset_code, expiration_time) VALUES (:user_id, :reset_code, :expiration_time)', $params);
        if ($result === false) {
            return null;
        } else {
            return $reset_code;
        }
    }

    public function getResetDataForUser(int $id): ?array
    {
        $params = [
            'user_id' => $id,
        ];
        $result = $this->getRow('SELECT reset_code, expiration_time FROM resets WHERE user_id=:user_id', $params);
        $this->executeQuery('DELETE FROM resets WHERE user_id=:user_id', $params);
        return is_array($result) ? $result : null;
    }
}