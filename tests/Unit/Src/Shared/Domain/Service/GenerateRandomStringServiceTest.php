<?php

namespace Tests\Unit\Src\Auth\Domain\Service;

use Tests\TestCase;
use WorkWithUs\Shared\Domain\Service\GenerateRandomStringService;

class GenerateRandomStringServiceTest extends TestCase
{
    private GenerateRandomStringService $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new GenerateRandomStringService();
    }

    public function test_generate_random_string_service_is_done_correctly(): void
    {
        $result = $this->sut->generateRandomString(11);

        $this->assertEquals(11, strlen($result));
    }


    public function test_generate_random_string_service_is_ok(): void
    {
        $result = $this->sut->generateRandomString(4);

        $this->assertEquals(4, strlen($result));
    }
}
