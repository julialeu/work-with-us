<?php

namespace WorkWithUs\Auth\Application;

use RuntimeException;
use WorkWithUs\Auth\Domain\Entity\User;
use WorkWithUs\Auth\Domain\Service\HashPasswordService;
use WorkWithUs\Auth\Infrastructure\Repository\UsersRepository;
use WorkWithUs\Auth\Infrastructure\Service\AuthenticateUserService;

class RegisterUserUseCase
{
    private UsersRepository $usersRepository;
    private HashPasswordService $hashPasswordService;
    private AuthenticateUserService $authenticateUserService;

    public function __construct(
        UsersRepository $usersRepository,
        HashPasswordService $hashPasswordService,
        AuthenticateUserService $authenticateUserService,
    ) {
        $this->usersRepository = $usersRepository;
        $this->hashPasswordService = $hashPasswordService;
        $this->authenticateUserService = $authenticateUserService;
    }

    public function execute(
        string $email,
        string $rawPassword,
        string $name
    ): array {
        $userWithSameEmail = $this->usersRepository->findByEmail($email);

        if ($userWithSameEmail !== null) {
            throw new UserWithSameEmailExistException('A user with that email already exists');
        }

        $hashedPassword = $this->hashPasswordService->hash($rawPassword);

        $user = (new User())
            ->setEmail($email)
            ->setName($name)
            ->setHashedPassword($hashedPassword);

        $this->usersRepository->createUser($user);

        $credentials = [
            'email' => $email,
            'password' => $rawPassword
        ];

        if (!($token = $this->authenticateUserService->login($credentials))) {
            throw new RuntimeException('UserModel created but error in authentication');
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->authenticateUserService->getTTl()
        ];
    }
}
