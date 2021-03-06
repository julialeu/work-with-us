<?php

namespace Tests\Unit\Src\Publishing\Application;

use Tests\TestCase;
use WorkWithUs\Publishing\Application\CreateJobVacancyUseCase;
use WorkWithUs\Publishing\Domain\Entity\JobVacancy;
use WorkWithUs\Publishing\Domain\ValueObject\JobVacancyStatus;
use WorkWithUs\Publishing\Domain\Repository\JobVacancyRepositoryInterface;
use WorkWithUs\Shared\Domain\Service\GenerateRandomStringService;
use WorkWithUs\Shared\Domain\Service\GenerateUuidService;

class CreateJobVacancyUseCaseTest extends TestCase
{
    private CreateJobVacancyUseCase $sut;

    private JobVacancyRepositoryInterface $jobVacancyRepository;
    private GenerateRandomStringService $generateRandomStringService;
    private GenerateUuidService $generateUuidService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->jobVacancyRepository = $this->createMock(JobVacancyRepositoryInterface::class);
        $this->generateRandomStringService = $this->createMock(GenerateRandomStringService::class);
        $this->generateUuidService = $this->createMock(GenerateUuidService::class);

        $this->sut = new CreateJobVacancyUseCase(
            $this->jobVacancyRepository,
            $this->generateRandomStringService,
            $this->generateUuidService
        );
    }

    public function test_job_vacancy_is_created_correctly(): void
    {
        $this->generateRandomStringService
            ->expects(self::once())
            ->method('generateRandomString')
            ->with(11)
            ->willReturn('churro78123');

        $this->generateUuidService
            ->expects(self::once())
            ->method('generate')
            ->willReturn('aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee');

        $jobVacancyStatus = new JobVacancyStatus(JobVacancyStatus::UNPUBLISHED);

        $jobVacancy = (new JobVacancy())
            ->setUserId(2)
            ->setCompanyId(70)
            ->setJobVacancyStatus($jobVacancyStatus)
            ->setTitle('Trainee front-end')
            ->setDescription('Trainee front-end')
            ->setLocation('Pamplona')
            ->setModality('on_site')
            ->setWorkingTime('Jornada completa')
            ->setExperience('trainee')
            ->setUrlToken('churro78123')
            ->setUuid('aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee');

        $this->jobVacancyRepository
            ->expects(self::once())
            ->method('createJobVacancy')
            ->with($jobVacancy);

        $this->sut->execute(
            2,
            'Trainee front-end',
            'Trainee front-end',
            70,
            'Pamplona',
            'on_site',
            'Jornada completa',
            'trainee'
        );
    }
}
