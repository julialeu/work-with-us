<?php

namespace WorkWithUs\Auth\Application;

use WorkWithUs\Auth\Infrastructure\Repository\JobVacancyRepository;

class GetJobVacancyUseCase
{
    private JobVacancyRepository $jobVacancyRepository;

    public function __construct(JobVacancyRepository $jobVacancyRepository)
    {
        $this->jobVacancyRepository = $jobVacancyRepository;
    }

    public function execute(string $uuid): array
    {
        $jobVacancy = $this->jobVacancyRepository->findByUuid($uuid);

        $item = [
            'id' => $jobVacancy->id(),
            'title' => $jobVacancy->title(),
            'description' => $jobVacancy->description(),
            'company' => $jobVacancy->company(),
            'location' => $jobVacancy->location(),
            'modality' => $jobVacancy->modality(),
            'working_time' => $jobVacancy->workingTime(),
            'experience' => $jobVacancy->experience(),
        ];

        return $item;
    }
}
