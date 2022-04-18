<?php

namespace Tests\Unit\Src\Publishing\Application;

use Carbon\Carbon;
use Tests\TestCase;
use WorkWithUs\Auth\Domain\Entity\JobVacancy;
use WorkWithUs\Auth\Domain\Entity\User;
use WorkWithUs\Publishing\Application\GetJobVacanciesUseCase;
use WorkWithUs\Publishing\Domain\ValueObject\JobVacancyStatus;
use WorkWithUs\Publishing\Infrastructure\Repository\JobVacancyRepository;

class GetJobVacanciesUseCaseTest extends TestCase
{

    private GetJobVacanciesUseCase $sut;

    private JobVacancyRepository $jobVacancyRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->jobVacancyRepository = $this->createMock(JobVacancyRepository::class);

        $this->sut = new GetJobVacanciesUseCase(
            $this->jobVacancyRepository
        );
    }

    public function test_job_vacancies_are_returned_correctly(): void
    {
        $user = new User();
        $user->setUserId(555);

        $jobVacancies = [];

        $jobVacancyStatus = new JobVacancyStatus('published');

        $jobVacancies[0] = (new JobVacancy())
            ->setId(1)
            ->setUserId(555)
            ->setJobVacancyStatus($jobVacancyStatus)
            ->setTitle('Trainee front-end')
            ->setDescription('Trainee front-end')
            ->setCompanyId(3)
            ->setCompanyName('Cocacola')
            ->setLocation('Pamplona')
            ->setModality('on_site')
            ->setWorkingTime('Jornada completa')
            ->setExperience('trainee')
            ->setUrlToken('churro78123')
            ->setUuid('aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee')
            ->setCreatedAt(new Carbon('2022-04-18 11:16:44'));

        $jobVacancies[1] = (new JobVacancy())
            ->setId(2)
            ->setUserId(555)
            ->setTitle('Senior front-end')
            ->setDescription('Senior front-end')
            ->setCompanyName('Zara')
            ->setLocation('Pamplona')
            ->setModality('on_site')
            ->setWorkingTime('Jornada completa')
            ->setExperience('senior')
            ->setUrlToken('churro98123')
            ->setUuid('aaaapaaa-bbbb-cccc-dddd-eeeeeeeeeeee')
            ->setCreatedAt(new Carbon('2022-04-18 11:16:48'));


        $this->jobVacancyRepository
            ->expects(self::once())
            ->method('getJobVacanciesByUserIdPaginated')
            ->with(
                2,
                555,
                4
            )
            ->willReturn($jobVacancies);

        $this->jobVacancyRepository
            ->expects(self::once())
            ->method('countJobVacanciesByUserId')
            ->with(555)
            ->willReturn(2);


        $this->sut->execute(
            2,
            $user
        );

    }

}