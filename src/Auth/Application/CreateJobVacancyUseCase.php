<?php

namespace WorkWithUs\Auth\Application;

use WorkWithUs\Auth\Domain\Entity\JobVacancy;
use WorkWithUs\Auth\Domain\Service\GenerateRandomStringService;
use WorkWithUs\Auth\Domain\Service\GenerateUuidService;
use WorkWithUs\Auth\Infrastructure\Repository\JobVacancyRepository;

class CreateJobVacancyUseCase
{
    private JobVacancyRepository $jobVacancyRepository;
    private GenerateRandomStringService $generateRandomStringService;
    private GenerateUuidService $generateUuidService;

    public function __construct(
        JobVacancyRepository $jobVacancyRepository,
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
        string $company,
        string $location,
        string $modality,
        string $workingTime,
        string $experience
    ) {
        $urlToken = $this->generateRandomStringService->generateRandomString(11);
        $uuid = $this->generateUuidService->generate();

        $jobVacancy = (new JobVacancy())
            ->setUserId($userId)
            ->setTitle($title)
            ->setDescription($description)
            ->setCompany($company)
            ->setLocation($location)
            ->setModality($modality)
            ->setWorkingTime($workingTime)
            ->setExperience($experience)
            ->setUrlToken($urlToken)
            ->setUuid($uuid);

        $this->jobVacancyRepository->createJobVacancy($jobVacancy);

    }
}
