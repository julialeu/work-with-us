<?php

namespace WorkWithUs\Publishing\Application;

use WorkWithUs\Auth\Domain\Entity\JobVacancy;
use WorkWithUs\Auth\Domain\Service\GenerateRandomStringService;
use WorkWithUs\Auth\Domain\Service\GenerateUuidService;
use WorkWithUs\Publishing\Domain\ValueObject\JobVacancyStatus;
use WorkWithUs\Publishing\Domain\Repository\JobVacancyRepositoryInterface;

class CreateJobVacancyUseCase
{
    private JobVacancyRepositoryInterface $jobVacancyRepository;
    private GenerateRandomStringService $generateRandomStringService;
    private GenerateUuidService $generateUuidService;

    public function __construct(
        JobVacancyRepositoryInterface $jobVacancyRepository,
        GenerateRandomStringService $generateRandomStringService,
        GenerateUuidService $generateUuidService
    ) {
        $this->jobVacancyRepository = $jobVacancyRepository;
        $this->generateRandomStringService = $generateRandomStringService;
        $this->generateUuidService = $generateUuidService;
    }

    public function execute(
        int $userId,
        string $title,
        string $description,
        int $companyId,
        string $location,
        string $modality,
        string $workingTime,
        string $experience
    ) {
        $urlToken = $this->generateRandomStringService->generateRandomString(11);
        $uuid = $this->generateUuidService->generate();

        $jobVacancyStatus = JobVacancyStatus::unpublished();

        $jobVacancy = (new JobVacancy())
            ->setUserId($userId)
            ->setJobVacancyStatus($jobVacancyStatus)
            ->setTitle($title)
            ->setDescription($description)
            ->setCompanyId($companyId)
            ->setLocation($location)
            ->setModality($modality)
            ->setWorkingTime($workingTime)
            ->setExperience($experience)
            ->setUrlToken($urlToken)
            ->setUuid($uuid);

        $this->jobVacancyRepository->createJobVacancy($jobVacancy);
    }
}
