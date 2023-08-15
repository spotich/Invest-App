<?php

namespace application\contracts;

interface UserRepository extends Database
{
    public function getUserByEmail(string $email): ?array;
    public function getUserById(int $id): ?array;
    public function getUserAvatar(int $id): ?string;
    public function createNewUser(array $user): ?int;
    public function updateUser(array $user): ?bool;
    public function newAuthenticationCodeForUser(int $id): ?string;
    public function newExpirationTimeForUser(int $id);
    public function newResetCodeForUser(int $id): ?string;
    public function getResetDataForUser(int $id): ?array;
    public function getAuthenticationDataForUser(int $id): ?array;
}