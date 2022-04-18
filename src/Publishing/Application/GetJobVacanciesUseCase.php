<?php

namespace WorkWithUs\Publishing\Application;

use WorkWithUs\Auth\Domain\Entity\JobVacancy;
use WorkWithUs\Auth\Domain\Entity\User;
use WorkWithUs\Publishing\Infrastructure\Repository\JobVacancyRepository;

class GetJobVacanciesUseCase
{
    private JobVacancyRepository $jobVacancyRepository;

    public function __construct(
        JobVacancyRepository $jobVacancyRepository,
    ) {
        $this->jobVacancyRepository = $jobVacancyRepository;
    }
    public function execute(
        int $numPage,
        User $actingUser
    ): array
    {
        $userId = $actingUser->id();
        $resultsPerPage = JobVacancy::NUM_JOB_VACANCIES_PER_PAGE;

        $jobVacancies = $this->jobVacancyRepository->getJobVacanciesByUserIdPaginated(
            $numPage,
            $userId,
            $resultsPerPage
        );

        $numJobVacanciesUser = $this->jobVacancyRepository->countJobVacanciesByUserId($userId);

        $totalNumPages = (int) ceil($numJobVacanciesUser / $resultsPerPage);

        $dataItems = [];


        foreach ($jobVacancies as $jobVacancy) {
            $item = [
                'id' => $jobVacancy->id(),
                'status' => $jobVacancy->jobVacancyStatus()->getValue(),
                'title' => $jobVacancy->title(),
                'description' => $jobVacancy->description(),
                'company_id' => $jobVacancy->companyId(),
                'company_name' => $jobVacancy->companyName(),
                'location' => $jobVacancy->location(),
                'modality' => $jobVacancy->modality(),
                'working_time' => $jobVacancy->workingTime(),
                'experience' => $jobVacancy->experience(),
                'uuid' => $jobVacancy->uuid(),
                'created' => $jobVacancy->createdAt()->format('Y-m-d H:i:s')
            ];

            $dataItems[] = $item;
            
        }

        $data = [
            'items' => $dataItems,
            'numPage' => $numPage,
            'resultsPerPage' => $resultsPerPage,
            'totalPages' => $totalNumPages,
        ];

        return $data;
    }
}
