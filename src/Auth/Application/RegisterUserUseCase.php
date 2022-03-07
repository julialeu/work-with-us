<?php

namespace WorkWithUs\Auth\Application;

use http\Exception\RuntimeException;
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
    ): array {
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


        $credentials = [
            'email' => $email,
            'password' => $rawPassword
        ];

        if (! ($token = auth()->attempt($credentials))) {
            throw new RuntimeException('User created but error in authentication');
        }

        return $this->respondWithToken($token);

    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
