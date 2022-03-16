<?php

namespace WorkWithUs\Auth\Application;

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
    public function execute(): array
    {
        $user = $this->getAuthenticatedUserService->execute();
        $userId = $user->id();

        $jobVacancies = $this->jobVacancyRepository->getAll($userId);

        $data = [
            'items' => $jobVacancies,
            'numPage' => 1,
            'resultsPerPage' => 1,
            'totalPages' => 2,
        ];


        return $data;
    }
}
