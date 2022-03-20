<?php

namespace WorkWithUs\Auth\Application;

use WorkWithUs\Auth\Domain\Entity\JobVacancy;
use WorkWithUs\Auth\Domain\Service\GetAuthenticatedUserService;
use WorkWithUs\Auth\Infrastructure\Repository\JobVacancyRepository;

class GetJobVacanciesUseCase
{
    private JobVacancyRepository $jobVacancyRepository;
    private GetAuthenticatedUserService $getAuthenticatedUserService;

    public function __construct(
        JobVacancyRepository $jobVacancyRepository,
        GetAuthenticatedUserService $getAuthenticatedUserService
    ) {
        $this->jobVacancyRepository = $jobVacancyRepository;
        $this->getAuthenticatedUserService = $getAuthenticatedUserService;
    }
    public function execute(
        int $numPage
    ): array
    {
        $user = $this->getAuthenticatedUserService->execute();
        $userId = $user->id();
        $resultsPerPage = JobVacancy::NUM_JOB_VACANCIES_PER_PAGE;

        $jobVacancies = $this->jobVacancyRepository->getJobVacanciesByUserIdPaginated(
            $numPage,
            $userId,
            $resultsPerPage
        );

        $numJobVacanciesUser = $this->jobVacancyRepository->countJobVacanciesByUserId($userId);

        $totalNumPages = ceil($numJobVacanciesUser / $resultsPerPage);

        $data = [
            'items' => $jobVacancies,
            'numPage' => $numPage,
            'resultsPerPage' => $resultsPerPage,
            'totalPages' => $totalNumPages,
        ];

        return $data;
    }
}
