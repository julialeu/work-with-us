<?php

namespace Tests\Unit\Src\Auth\Domain\Service;

use Tests\TestCase;
use WorkWithUs\Shared\Domain\Service\GenerateUuidService;

class GenerateUuidServiceTest extends TestCase
{
    private GenerateUuidService $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new GenerateUuidService();
    }

    public function test_generate_uuid_service_is_done_correctly(): void
    {
        $result = $this->sut->generate();

        $this->assertEquals(36, strlen($result));

        $numDashes = substr_count(
            $result,
            '-'
        );
        $this->assertEquals(4, $numDashes);
    }
}
