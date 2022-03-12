<?php

namespace Tests\Unit\Src\Auth\Application;

use Tests\TestCase;
use WorkWithUs\Auth\Application\CreateJobVacancyUseCase;
use WorkWithUs\Auth\Domain\Entity\JobVacancy;
use WorkWithUs\Auth\Infrastructure\Repository\JobVacancyRepository;

class CreateJobVacancyUseCaseTest extends TestCase
{
   private CreateJobVacancyUseCase $sut;
   private JobVacancyRepository $jobVacancyRepository;

   protected function setUp(): void
   {
       parent::setUp();

       $this->jobVacancyRepository = $this->createMock(JobVacancyRepository::class);

       $this->sut = new CreateJobVacancyUseCase(
           $this->jobVacancyRepository
       );
   }

   public function test_job_vacancy_is_created_correctly(): void
   {
       $jobVacancy = (new JobVacancy())
           ->setUserId(2)
           ->setTitle('Trainee front-end')
           ->setCompany('Cocacola')
           ->setLocation('Pamplona')
           ->setModality('on_site')
           ->setWorkTime('Jornada completa')
           ->setExperience('trainee');

       $this->jobVacancyRepository
           ->expects(self::once())
           ->method('createJobVacancy')
           ->with($jobVacancy);

       $this->sut->execute(
           2,
           'Trainee front-end',
           'Cocacola',
           'Pamplona',
           'on_site',
           'Jornada completa',
           'trainee'
       );
   }
}
