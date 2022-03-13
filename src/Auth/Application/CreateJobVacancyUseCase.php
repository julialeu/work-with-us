<?php

namespace WorkWithUs\Auth\Application;

use WorkWithUs\Auth\Domain\Entity\JobVacancy;
use WorkWithUs\Auth\Infrastructure\Repository\JobVacancyRepository;

class CreateJobVacancyUseCase
{
    private JobVacancyRepository $jobVacancyRepository;

    public function __construct(JobVacancyRepository $jobVacancyRepository)
    {
        $this->jobVacancyRepository = $jobVacancyRepository;
    }

    public function execute(
        int $userId,
        string $title,
        string $company,
        string $location,
        string $modality,
        string $workingTime,
        string $experience
    ) {
        $jobVacancy = (new JobVacancy())
            ->setUserId($userId)
            ->setTitle($title)
            ->setCompany($company)
            ->setLocation($location)
            ->setModality($modality)
            ->setWorkingTime($workingTime)
            ->setExperience($experience);

        $this->jobVacancyRepository->createJobVacancy($jobVacancy);

    }
}
