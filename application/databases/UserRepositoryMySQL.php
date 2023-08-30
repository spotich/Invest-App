<?php

namespace InvestApp\application\databases;

use InvestApp\application\contracts\UserRepository;

date_default_timezone_set('Asia/Novosibirsk');

class UserRepositoryMySQL extends RepositoryMySQL implements UserRepository
{
    public function getUserByEmail(string $email): ?array
    {
        $result = $this->getRow('SELECT * FROM users WHERE email = :email', ['email' => $email]);
        return is_array($result) ? $result[0] : null;
    }

    public function getUserById(int $id): ?array
    {
        $result = $this->getRow('SELECT * FROM users WHERE id = :id', ['id' => $id]);
        return is_array($result) ? $result[0] : null;
    }

    public function getAllTeamMembers(): ?array
    {
        if ($teamMembers = $this->getUnique('SELECT id, name, surname, avatar FROM users WHERE role = :role', ['role' => 'Team member'])) {
            return $teamMembers;
        } else {
            return null;
        }
    }

    public function createNewUser(array $user): ?int
    {
        $ok = (isset($user['name']) and isset($user['surname']) and isset($user['email']) and isset($user['role']) and isset($user['password']));
        if ($ok) {
            $user['avatar'] = 'person.jpeg';
            $this->executeQuery('INSERT INTO users (name, surname, email, role, password, avatar) VALUES (:name, :surname, :email, :role, :password, :avatar)', $user);
            $code = bin2hex(random_bytes(20));
            $id = $this->getUserByEmail($user['email'])['id'];
            $params = [
                'user_id' => $id,
                'code' => $code,
            ];
            $this->executeQuery('INSERT INTO authentications (code, user_id) VALUES (:code, :user_id)', $params);
            unset($params['code']);
        }
        return is_int($id) ? $id : null;
    }

    public function getAuthenticationDataForUser(int $id): ?array
    {
        $result = $this->getRow('SELECT code, expiration_time FROM authentications WHERE user_id = :user_id', ['user_id' => $id]);
        return is_array($result) ? $result[0] : null;
    }

    public function updateUser(array $user)
    {
        if (!isset($user['id'])) {
            return null;
        }
        $setting = $this->getUpdateSetting($user);
        $this->executeQuery("UPDATE users SET $setting WHERE id = :id", $user);
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
        $result = $this->getRow('SELECT reset_code, expiration_time FROM resets WHERE user_id = :user_id', ['user_id' => $id]);
        $this->executeQuery('DELETE FROM resets WHERE user_id = :user_id', ['user_id' => $id]);
        return is_array($result) ? $result : null;
    }
}