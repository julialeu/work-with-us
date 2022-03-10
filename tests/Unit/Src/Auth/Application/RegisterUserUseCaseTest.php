<?php

namespace Tests\Unit\Src\Auth\Application;

use Tests\TestCase;
use WorkWithUs\Auth\Application\RegisterUserUseCase;
use WorkWithUs\Auth\Application\UserWithSameEmailExistException;
use WorkWithUs\Auth\Domain\Entity\User;
use WorkWithUs\Auth\Domain\Service\HashPasswordService;
use WorkWithUs\Auth\Infrastructure\Repository\UsersRepository;

class RegisterUserUseCaseTest extends TestCase
{
    private RegisterUserUseCase $sut;
    private UsersRepository $usersRepository;
    private HashPasswordService $hashPasswordService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->usersRepository = $this->createMock(UsersRepository::class);
        $this->hashPasswordService = $this->createMock(HashPasswordService::class);

        $this->sut = new RegisterUserUseCase(
            $this->usersRepository,
            $this->hashPasswordService
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

        $this->sut->execute(
            'gato@gmail.com',
                '1234',
            'Gato',
            'Gato S.L.'
        );
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
