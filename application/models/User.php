<?php

namespace InvestApp\application\models;

use InvestApp\application\contracts\UserRepository;
use stdClass;
class User extends Model
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
        return is_null($userArray) ? null : self::toObject($userArray);
    }

    public static function findByEmail(string $email): ?User
    {
        $userArray = self::$userRepo->getUserByEmail($email);
        return is_null($userArray) ? null : self::toObject($userArray);
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
                self::$userRepo->updateUser($this->toArray());
            }
        } else {
            $this->id = self::$userRepo->createNewUser($this->toArray());
        }
    }
}