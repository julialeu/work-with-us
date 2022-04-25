<?php

namespace WorkWithUs\Publishing\Application;

use RuntimeException;
use WorkWithUs\Auth\Domain\Entity\JobVacancy;
use WorkWithUs\Auth\Domain\Entity\User;
use WorkWithUs\Publishing\Domain\ValueObject\JobVacancyStatus;
use WorkWithUs\Publishing\Domain\Repository\JobVacancyRepositoryInterface;

class MarkJobVacancyAsUnpublishedUseCase
{
    private JobVacancyRepositoryInterface $jobVacancyRepository;

    public function __construct(
        JobVacancyRepositoryInterface $jobVacancyRepository
    ) {
        $this->jobVacancyRepository = $jobVacancyRepository;
    }

    public function execute(
        User $actingUser,
        string $joVacancyUuid
    ): void {
        $actingUserId = $actingUser->id();
        $jobVacancy = $this->jobVacancyRepository->findByUuid($joVacancyUuid);

        $this->assertJobVacancyBelongsToActingUser($jobVacancy, $actingUserId);
        $this->assertJobVacancyIsUnpublished($jobVacancy);

        $jobVacancyStatus = JobVacancyStatus::unpublished();
        $jobVacancy->setJobVacancyStatus($jobVacancyStatus);

        $this->jobVacancyRepository->updateJobVacancy($jobVacancy);
    }

    public function assertJobVacancyBelongsToActingUser(
        JobVacancy $jobVacancy,
        int $actingUserId
    ): void {
        $jobVacancyUserId = $jobVacancy->userId();

        if ($jobVacancyUserId !== $actingUserId) {
            // Es un hacker
            throw new RuntimeException('Invalid action');
        }
    }

    /**
     * @param JobVacancy $jobVacancy
     */
    public function assertJobVacancyIsUnpublished(JobVacancy $jobVacancy): void
    {
        if ($jobVacancy->jobVacancyStatus()->getValue() === 'unpublished') {
            throw new \InvalidArgumentException('This job vacancy is already unpublished');
        }
    }
}

