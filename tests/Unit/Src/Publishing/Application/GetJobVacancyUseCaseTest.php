<?php

namespace Tests\Unit\Src\Publishing\Application;

use Tests\TestCase;
use WorkWithUs\Publishing\Domain\Entity\JobVacancy;
use WorkWithUs\Publishing\Application\GetJobVacancyUseCase;
use WorkWithUs\Publishing\Domain\Repository\JobVacancyRepositoryInterface;
use WorkWithUs\Publishing\Domain\ValueObject\JobVacancyStatus;

class GetJobVacancyUseCaseTest extends TestCase
{
    private GetJobVacancyUseCase $sut;

    private JobVacancyRepositoryInterface $jobVacancyRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->jobVacancyRepository = $this->createMock(JobVacancyRepositoryInterface::class);

        $this->sut = new GetJobVacancyUseCase($this->jobVacancyRepository);
    }

    public function test_get_job_vacancy_is_created_correctly(): void
    {
        $jobVacancy = (new JobVacancy())
            ->setId(1)
            ->setUserId(2)
            ->setJobVacancyStatus(JobVacancyStatus::published())
            ->setTitle('Trainee front-end')
            ->setDescription('Trainee front-end')
            ->setCompanyId('3')
            ->setLocation('Pamplona')
            ->setModality('on_site')
            ->setWorkingTime('Jornada completa')
            ->setExperience('trainee')
            ->setUrlToken('churro78123')
            ->setUuid('aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee');

        $this->jobVacancyRepository
            ->expects(self::once())
            ->method('findByUuid')
            ->with('aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee')
            ->willReturn($jobVacancy);

        $result = $this->sut->execute('aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee');

        $expected = [
            'id' => 1,
            'status' => 'published',
            'title' => 'Trainee front-end',
            'description' => 'Trainee front-end',
            'company_id' => 3,
            'location' => 'Pamplona',
            'modality' => 'on_site',
            'working_time' => 'Jornada completa',
            'experience' => 'trainee',
        ];

        $this->assertSame(
            $expected,
            $result
        );
    }
}
