<?php

namespace WorkWithUs\Publishing\Application;

use WorkWithUs\Publishing\Infrastructure\Repository\JobVacancyRepository;

class EditJobVacancyUseCase
{
    private JobVacancyRepository $jobVacancyRepository;

    public function __construct(
        JobVacancyRepository $jobVacancyRepository,
    ) {
        $this->jobVacancyRepository = $jobVacancyRepository;
    }

    public function execute(
        string $uuid,
        ?string $title,
        ?string $description,
        ?string $company,
        ?string $location,
        ?string $modality,
        ?string $workingTime,
        ?string $experience
    ): void {
        $jobVacancy = $this->jobVacancyRepository->findByUuid($uuid);

        if ($title !== null) {
            $jobVacancy->setTitle($title);
        }

        if ($description !== null) {
            $jobVacancy->setDescription($description);
        }

        if ($company !== null) {
            $jobVacancy->setCompany($company);
        }

        if ($location !== null) {
            $jobVacancy->setLocation($location);
        }

        if ($modality !== null) {
            $jobVacancy->setModality($modality);
        }

        if ($workingTime !== null) {
            $jobVacancy->setWorkingTime($workingTime);
        }

        if ($experience !== null) {
            $jobVacancy->setExperience($experience);
        }

        $this->jobVacancyRepository->updateJobVacancy($jobVacancy);
    }
}
