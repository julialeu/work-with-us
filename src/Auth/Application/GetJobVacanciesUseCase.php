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

        $jobVacancies = $this->jobVacancyRepository->getAll(
            $numPage,
            $userId,
            $resultsPerPage
        );

        // TODO. contar el número de items de ese usuario
        // TODO el resultado dividirlo por el número de ofertas por página
        // TODO eso redondearlo (eso es el número de páginas que hay. Hay que devolver ese dato

        $data = [
            'items' => $jobVacancies,
            'numPage' => $numPage,
            'resultsPerPage' => $resultsPerPage,
            'totalPages' => 2,
        ];

        return $data;
    }
}
