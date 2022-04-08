<?php

namespace WorkWithUs\Publishing\Application;

use RuntimeException;
use WorkWithUs\Auth\Domain\Entity\JobVacancy;
use WorkWithUs\Auth\Domain\Entity\User;
use WorkWithUs\Publishing\Domain\ValueObject\JobVacancyStatus;
use WorkWithUs\Publishing\Infrastructure\Repository\JobVacancyRepository;

class MarkJobVacancyAsPublishedUseCase
{
    private JobVacancyRepository $jobVacancyRepository;

    public function __construct(
        JobVacancyRepository $jobVacancyRepository
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

        $jobVacancyStatus = JobVacancyStatus::published();
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
        if ($jobVacancy->jobVacancyStatus()->getValue() === 'published') {
            throw new \InvalidArgumentException('This job vacancy is already published');
        }
    }
}
