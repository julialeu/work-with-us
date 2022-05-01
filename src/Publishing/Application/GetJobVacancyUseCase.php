<?php

namespace WorkWithUs\Publishing\Application;

use WorkWithUs\Publishing\Domain\Repository\JobVacancyRepositoryInterface;

class GetJobVacancyUseCase
{
    private JobVacancyRepositoryInterface $jobVacancyRepository;

    public function __construct(JobVacancyRepositoryInterface $jobVacancyRepository)
    {
        $this->jobVacancyRepository = $jobVacancyRepository;
    }

    public function execute(string $uuid): array
    {
        $jobVacancy = $this->jobVacancyRepository->findByUuid($uuid);

        $item = [
            'id' => $jobVacancy->id(),
            'status' => $jobVacancy->jobVacancyStatus()->getValue(),
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
