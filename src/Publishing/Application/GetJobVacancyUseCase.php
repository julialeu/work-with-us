<?php

namespace WorkWithUs\Publishing\Application;

use WorkWithUs\Publishing\Infrastructure\Repository\JobVacancyRepository;

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
            'status' => $jobVacancy->jobVacancyStatus(),
            'title' => $jobVacancy->title(),
            'description' => $jobVacancy->description(),
            'company_id' => $jobVacancy->companyId(),
            'location' => $jobVacancy->location(),
            'modality' => $jobVacancy->modality(),
            'working_time' => $jobVacancy->workingTime(),
            'experience' => $jobVacancy->experience(),
        ];

        return $item;
    }
}
