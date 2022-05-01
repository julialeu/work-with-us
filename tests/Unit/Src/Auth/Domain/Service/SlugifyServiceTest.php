<?php

namespace Tests\Unit\Src\Auth\Domain\Service;

use Tests\TestCase;
use WorkWithUs\Shared\Domain\Service\SlugifyService;

class SlugifyServiceTest extends TestCase
{
    private SlugifyService $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new SlugifyService();
    }

    /**
     * @dataProvider slugify
     */
    public function test_slugify_service_works_correctly($expectedResult, $input): void
    {
        self::assertSame($expectedResult, $this->sut->slugify($input));
    }

    public function slugify()
    {
        return [
            [
                'julia-leuenberger',
                'Julia Leuenberger',
            ],
            [
                'n-a',
                '    ',
            ],
            [
                'n-a',
                '-',
            ],
            [
                'zara',
                ' ZARA ',
            ]
        ];
    }
}
