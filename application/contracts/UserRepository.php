<?php

namespace InvestApp\application\contracts;

interface UserRepository extends Repository
{
    public function getUserByEmail(string $email): ?array;
    public function getUserById(int $id): ?array;
    public function getAllTeamMembers(): ?array;
    public function createNewUser(array $user): ?int;
    public function updateUser(array $user);
    public function setVerificationCodeForUser(int $id, string $verificationCode): void;
    public function setExpirationTimeForUser(int $id, string $expirationTime): void;
    public function setRecoveryCodeForUser(int $id, string $recoveryCode, string $expirationTime): void;
    public function getResetDataForUser(int $id): ?array;
    public function getAuthenticationDataForUser(int $id): ?array;
}