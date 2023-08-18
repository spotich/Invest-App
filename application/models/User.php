<?php

namespace InvestApp\application\models;

use InvestApp\application\contracts\UserRepository;
use stdClass;
class User
{
    public int $id;
    public string $name;
    public string $surname;
    public string $email;
    public string $role;
    public string $password;
    public string $avatar;
    private static UserRepository $userRepo;

    public static function init(UserRepository $userRepo): void
    {
        self::$userRepo = $userRepo;
    }

    public static function findById(int $id): ?User
    {
        $userArray = self::$userRepo->getUserById($id);
        return is_null($userArray) ? null : self::deserializeFromArray($userArray);
    }

    public static function findByEmail(string $email): ?User
    {
        $userArray = self::$userRepo->getUserByEmail($email);
        return is_null($userArray) ? null : self::deserializeFromArray($userArray);
    }

    public function getAvatar(): void
    {
        $avatar = self::$userRepo->getUserAvatar($this->id);
        $this->avatar = $avatar;
    }

    public function isUptoDate(): bool
    {
        $authenticationData = self::$userRepo->getAuthenticationDataForUser($this->id);
        return (date('Y-m-d H:i:s', time()) <= $authenticationData['expiration_time']);
    }

    public function getAuthenticationCode(): ?array
    {
        $authenticationData = self::$userRepo->getAuthenticationDataForUser($this->id);
        return $authenticationData['code'];
    }

    public function setVerificationCode(string $verificationCode): void
    {
        self::$userRepo->setVerificationCodeForUser($this->id, $verificationCode);
    }

    public function setRecoveryCode(string $recoveryCode, string $expirationTime): void
    {
        self::$userRepo->setRecoveryCodeForUser($this->id, $recoveryCode, $expirationTime);
    }

    public function getResetData(): ?stdClass
    {
        $resetDataArray = self::$userRepo->getResetDataForUser($this->id);
        if (is_null($resetDataArray)) {
            return null;
        }
        if (isset($resetDataArray[0]['reset_code']) and isset($resetDataArray[0]['expiration_time'])) {
            $resetDataObject = new stdClass();
            $resetDataObject->resetCode = $resetDataArray[0]['reset_code'];
            $resetDataObject->expirationTime = $resetDataArray[0]['expiration_time'];
            return $resetDataObject;
        }
        return null;
    }

    public function setExpirationTime(string $expirationTime): void
    {
        self::$userRepo->setExpirationTimeForUser($this->id, $expirationTime);
    }

    public function save(): void
    {
        if (isset($this->id)) {
            $result = self::$userRepo->getUserById($this->id);
            if (!is_null($result)) {
                self::$userRepo->updateUser($this->serializeToArray());
            }
        } else {
            $this->id = self::$userRepo->createNewUser($this->serializeToArray());
        }
    }

    public static function deserializeFromArray(array $data): User
    {
        $user = new User();
        if (isset($data['id']) and is_int($data['id'])) $user->id = $data['id'];
        if (isset($data['name']) and is_string($data['name'])) $user->name = $data['name'];
        if (isset($data['surname']) and is_string($data['surname'])) $user->surname = $data['surname'];
        if (isset($data['email']) and is_string($data['email'])) $user->email = $data['email'];
        if (isset($data['role']) and is_string($data['role'])) $user->role = $data['role'];
        if (isset($data['password']) and is_string($data['password'])) $user->password = $data['password'];
        if (isset($data['avatar']) and is_string($data['avatar'])) $user->avatar = $data['avatar'];
        return $user;
    }

    public function serializeToArray(): array
    {
        $result = [];
        if (isset($this->id)) $result['id'] = $this->id;
        if (isset($this->name)) $result['name'] = $this->name;
        if (isset($this->surname)) $result['surname'] = $this->surname;
        if (isset($this->email)) $result['email'] = $this->email;
        if (isset($this->role)) $result['role'] = $this->role;
        if (isset($this->password)) $result['password'] = $this->password;
        if (isset($this->avatar)) $result['avatar'] = $this->avatar;
        return $result;
    }
}