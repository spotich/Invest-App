<?php

namespace InvestApp\application\databases;

use InvestApp\application\contracts\UserRepository;

date_default_timezone_set('Asia/Novosibirsk');

class UserRepositoryMySQL extends RepositoryMySQL implements UserRepository
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

    public function setVerificationCodeForUser(int $id, string $verificationCode): void
    {
        $params = [
            'user_id' => $id,
            'code' => $verificationCode,
        ];
        $this->executeQuery('UPDATE authentications SET code = :code WHERE user_id = :user_id', $params);
    }

    public function setExpirationTimeForUser(int $id, string $expirationTime): void
    {
        $params = [
            'user_id' => $id,
            'expiration_time' => $expirationTime,
        ];
        $this->executeQuery('UPDATE authentications SET expiration_time = :expiration_time  WHERE user_id = :user_id', $params);
    }

    public function setRecoveryCodeForUser(int $id, string $recoveryCode, string $expirationTime): void
    {
        $params = [
            'user_id' => $id,
            'reset_code' => $recoveryCode,
            'expiration_time' => $expirationTime,
        ];
        $this->executeQuery('INSERT INTO resets (user_id, reset_code, expiration_time) VALUES (:user_id, :reset_code, :expiration_time)', $params);
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