<?php

namespace WorkWithUs\Publishing\Domain\Repository;

use WorkWithUs\Auth\Domain\Entity\JobVacancy;

interface JobVacancyRepositoryInterface
{
    public function createJobVacancy(JobVacancy $jobVacancy): JobVacancy;

    public function getJobVacanciesByUserIdPaginated(
        int $pageNumber,
        int $userId,
        int $resultsPerPage
    ): array;

    public function countJobVacanciesByUserId(int $userId): int;

    public function findByUuid(string $uuid): JobVacancy;

    public function updateJobVacancy(JobVacancy $jobVacancy): void;

    public function findPublishedByCompanyId(
        int $companyId,
        ?string $workingTime,
        ?string $modality,
        ?string $experience
    ): array;

    public function getJobVacancyByUrlToken(string $urlToken): JobVacancy;
}
