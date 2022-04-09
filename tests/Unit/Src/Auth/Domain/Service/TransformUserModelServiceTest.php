<?php

namespace Tests\Unit\Src\Auth\Domain\Service;

use Tests\TestCase;
use WorkWithUs\Auth\Domain\Service\TransformUserModelService;
use App\Models\UserModel;

class TransformUserModelServiceTest extends TestCase
{
    private TransformUserModelService $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new TransformUserModelService();
    }

    public function test_transform_user_model_service_is_done_correctly(): void
    {
        $userModel = (new UserModel());
        $userModel->email = 'gato@gmail.com';
        $userModel->name = 'Gato';
        $userModel->password = '1234';

        $actual = $this->sut->transformUserModel($userModel);

        $this->assertEquals('gato@gmail.com', $actual->email());
        $this->assertEquals('Gato', $actual->name());
        $this->assertEquals('1234', $actual->hashedPassword());
    }
}
