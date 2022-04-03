<?php

namespace Tests\Unit\Src\Publishing\Application;

use Tests\TestCase;
use WorkWithUs\Auth\Domain\Entity\JobVacancy;
use WorkWithUs\Publishing\Application\EditJobVacancyUseCase;
use WorkWithUs\Publishing\Infrastructure\Repository\JobVacancyRepository;

class EditJobVacancyUseCaseTest extends TestCase
{
    private EditJobVacancyUseCase $sut;
    private JobVacancyRepository $jobVacancyRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->jobVacancyRepository = $this->createMock(JobVacancyRepository::class);

        $this->sut = new EditJobVacancyUseCase($this->jobVacancyRepository);
    }

    public function test_when_only_title_is_given_should_update_only_the_title(): void
    {
        $jobVacancy = (new JobVacancy())
            ->setId(8765)
            ->setUserId(2)
            ->setTitle('Old title');

        $this->jobVacancyRepository
            ->expects(self::once())
            ->method('findByUuid')
            ->with('ZzD5gQMA-dXdy-ytg7-N023-MoyX9cJj6zBM')
            ->willReturn($jobVacancy);

        $jobVacancyToStore = (clone $jobVacancy)
            ->setTitle('Programmer senior');

        $this->jobVacancyRepository
            ->expects(self::once())
            ->method('editJobVacancy')
            ->with($jobVacancyToStore);

        $this->sut->execute(
            'ZzD5gQMA-dXdy-ytg7-N023-MoyX9cJj6zBM',
            'Programmer senior',
            null,
            null,
            null,
            null,
            null,
            null,
        );
    }
}
