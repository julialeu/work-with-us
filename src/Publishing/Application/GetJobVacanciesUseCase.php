<?php

namespace WorkWithUs\Publishing\Application;

use Carbon\Carbon;
use WorkWithUs\Auth\Domain\Entity\JobVacancy;
use WorkWithUs\Auth\Domain\Service\GetAuthenticatedUserService;
use WorkWithUs\Publishing\Infrastructure\Repository\JobVacancyRepository;

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

        $dataItems = [];

        foreach ($jobVacancies as $jobVacancy) {
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
