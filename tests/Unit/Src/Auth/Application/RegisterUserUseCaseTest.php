<?php

namespace Tests\Unit\Src\Auth\Application;

use Tests\TestCase;
use WorkWithUs\Auth\Application\RegisterUserUseCase;
use WorkWithUs\Auth\Application\UserWithSameEmailExistException;
use WorkWithUs\Auth\Domain\Entity\User;
use WorkWithUs\Auth\Domain\Service\HashPasswordService;
use WorkWithUs\Auth\Infrastructure\Repository\UsersRepository;
use WorkWithUs\Auth\Infrastructure\Service\AuthenticateUserService;

class RegisterUserUseCaseTest extends TestCase
{
    private RegisterUserUseCase $sut;
    private UsersRepository $usersRepository;
    private HashPasswordService $hashPasswordService;
    private AuthenticateUserService $authenticateUserService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->usersRepository = $this->createMock(UsersRepository::class);
        $this->hashPasswordService = $this->createMock(HashPasswordService::class);
        $this->authenticateUserService = $this->createMock(AuthenticateUserService::class);

        $this->sut = new RegisterUserUseCase(
            $this->usersRepository,
            $this->hashPasswordService,
            $this->authenticateUserService
        );
    }

    /**
     * Given there is no user found with the given email
     * Should create a new user using the repository
     * @throws UserWithSameEmailExistException
     */
    public function test_registration_is_done_correctly(): void
    {
        $this->usersRepository
            ->expects(self::once())
            ->method('findByEmail')
            ->with('gato@gmail.com')
            ->willReturn(null);

        $this->hashPasswordService
            ->expects(self::once())
            ->method('hash')
            ->with('1234')
            ->willReturn('7s9d8f79sdf8s0d8fa0s9df');

        $user = (new User())
            ->setEmail('gato@gmail.com')
            ->setName('Gato')
            ->setHashedPassword('7s9d8f79sdf8s0d8fa0s9df')
            ->setCompany('Gato S.L.');

        $this->usersRepository
            ->expects(self::once())
            ->method('createUser')
            ->with($user);

        $credentials = [
            'email' => 'gato@gmail.com',
            'password' => '1234'
        ];
        $this->authenticateUserService
            ->expects(self::once())
            ->method('login')
            ->with($credentials)
            ->willReturn('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9hdXRoL2xvZ2luIiwiaWF0IjoxNjQ3MTk4NjA3LCJleHAiOjE2NDczNzE0MDcsIm5iZiI6MTY0NzE5ODYwNywianRpIjoibTd5Y3FaaG5ZcWZRaG1WUSIsInN1YiI6IjIiLCJwcnYiOiI0MWRmODgzNGYxYjk4ZjcwZWZhNjBhYWVkZWY0MjM0MTM3MDA2OTBjIn0.qA4ClBeLk6EMBn1gL8IW-5aNRyPaeFf56KQ9');

        $response = $this->sut->execute(
            'gato@gmail.com',
                '1234',
            'Gato',
            'Gato S.L.'
        );

        $this->assertIsArray($response);


    }

    /**
     * When a user with the same email exists
     * should throw an specific exception
     */
    public function test_exception_is_triggered_when_same_email_exists(): void
    {
        $user = new User();

        $this->usersRepository
            ->expects(self::once())
            ->method('findByEmail')
            ->with('gato@gmail.com')
            ->willReturn($user);

        $this
            ->expectExceptionMessage('A user with that email already exists');

        $this->sut->execute(
            'gato@gmail.com',
            '1234',
            'Gato',
            'Gato S.L.'
        );
    }
}
