<?php

namespace WorkWithUs\Auth\Application;

use Illuminate\Support\Facades\Hash;
use WorkWithUs\Auth\Domain\Entity\User;
use WorkWithUs\Auth\Infrastructure\Repository\UsersRepository;

class RegisterUserUseCase
{
    private UsersRepository $usersRepository;

    public function __construct(
        UsersRepository $usersRepository
    ) {
        $this->usersRepository = $usersRepository;
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

        $hashedPassword = Hash::make($rawPassword);

        $user = (new User())
            ->setEmail($email)
            ->setName($name)
            ->setHashedPassword($hashedPassword)
            ->setCompany($company);

        $this->usersRepository->createUser($user);

    }
}
