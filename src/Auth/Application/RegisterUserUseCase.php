<?php

namespace WorkWithUs\Auth\Application;

use WorkWithUs\Auth\Domain\Entity\User;
use WorkWithUs\Auth\Domain\Service\HashPasswordService;
use WorkWithUs\Auth\Infrastructure\Repository\UsersRepository;

class RegisterUserUseCase
{
    private UsersRepository $usersRepository;
    private HashPasswordService $hashPasswordService;

    public function __construct(
        UsersRepository $usersRepository,
        HashPasswordService $hashPasswordService
    ) {
        $this->usersRepository = $usersRepository;
        $this->hashPasswordService = $hashPasswordService;
    }

    public function execute(
        string $email,
        string $rawPassword,
        string $name,
        string $company
    ) {
        $userWithSameEmail = $this->usersRepository->findByEmail($email);

        if ($userWithSameEmail !== null) {
            throw new UserWithSameEmailExistException('A user with that email already exists');
        }

        $hashedPassword = $this->hashPasswordService->hash($rawPassword);

        $user = (new User())
            ->setEmail($email)
            ->setName($name)
            ->setHashedPassword($hashedPassword)
            ->setCompany($company);

        $this->usersRepository->createUser($user);
    }
}
