<?php

namespace Tests\Unit\Src\Publishing\Application;

use Tests\TestCase;
use WorkWithUs\Auth\Domain\Entity\JobVacancy;
use WorkWithUs\Publishing\Application\GetJobVacancyUseCase;
use WorkWithUs\Publishing\Infrastructure\Repository\JobVacancyRepository;

class GetJobVacancyUseCaseTest extends TestCase
{
    private GetJobVacancyUseCase $sut;

    private JobVacancyRepository $jobVacancyRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->jobVacancyRepository = $this->createMock(JobVacancyRepository::class);

        $this->sut = new GetJobVacancyUseCase($this->jobVacancyRepository);
    }

    public function test_get_job_vacancy_is_created_correctly(): void
    {
        $jobVacancy = (new JobVacancy())
            ->setId(1)
            ->setUserId(2)
            ->setTitle('Trainee front-end')
            ->setDescription('Trainee front-end')
            ->setCompanyName('Cocacola')
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
            'title' => 'Trainee front-end',
            'description' => 'Trainee front-end',
            'company' => 'Cocacola',
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


//    public function test_get_job_vacancy_is_created_correctly(): void
//    {
//        $jobVacancy = (new JobVacancy())
//            ->setId(1)
//            ->setUserId(2)
//            ->setTitle('Trainee front-end')
//            ->setDescription('Trainee front-end')
//            ->setCompany('Cocacola')
//            ->setLocation('Pamplona')
//            ->setModality('on_site')
//            ->setWorkingTime('Jornada completa')
//            ->setExperience('trainee')
//            ->setUrlToken('churro78123')
//            ->setUuid('aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee');
//
//        $this->jobVacancyRepository
//            ->expects(self::once())
//            ->method('findByUuid')
//            ->with('aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee')
//            ->willReturn($jobVacancy);
//
//        $result = $this->sut->execute('aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee');
//
//        $expected = [
//            'id' => 1,
//            'title' => 'Trainee front-end',
//            'description' => 'Trainee front-end',
//            'company' => 'Cocacola',
//            'location' => 'Pamplona',
//            'modality' => 'on_site',
//            'working_time' => 'Jornada completa',
//            'experience' => 'trainee',
//        ];
//
//        $this->assertSame(
//            $expected,
//            $result
//        );
//    }
}
