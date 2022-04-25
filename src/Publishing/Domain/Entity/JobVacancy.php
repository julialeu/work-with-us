<?php

namespace WorkWithUs\Auth\Domain\Entity;

use Carbon\Carbon;
use WorkWithUs\Publishing\Domain\ValueObject\JobVacancyStatus;

class JobVacancy
{
    public const NUM_JOB_VACANCIES_PER_PAGE = 4;

    private int $id;
    private int $userId;
    private int $companyId;
    private string $companyName;
    private JobVacancyStatus $jobVacancyStatus;
    private string $title;
    private ?string $description;
    private string $location;
    private string $modality;
    private string $workingTime;
    private string $experience;
    private string $uuid;
    private string $urlToken;
    private Carbon $createdAt;

    public function id(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function userId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function jobVacancyStatus(): JobVacancyStatus
    {
        return $this->jobVacancyStatus;
    }

    public function setJobVacancyStatus(JobVacancyStatus $jobVacancyStatus): self
    {
        $this->jobVacancyStatus = $jobVacancyStatus;

        return $this;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function companyId(): int
    {
        return $this->companyId;
    }

    public function setCompanyId(int $companyId): self
    {
        $this->companyId = $companyId;

        return $this;
    }

    public function location(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function modality(): string
    {
        return $this->modality;
    }

    public function setModality(string $modality): self
    {
        $this->modality = $modality;

        return $this;
    }

    public function workingTime(): string
    {
        return $this->workingTime;
    }

    public function setWorkingTime(string $workingTime): self
    {
        $this->workingTime = $workingTime;

        return $this;
    }

    public function experience(): string
    {
        return $this->experience;
    }

    public function setExperience(string $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function urlToken(): string
    {
        return $this->urlToken;
    }

    public function setUrlToken(string $urlToken): self
    {
        $this->urlToken = $urlToken;

        return $this;
    }

    public function createdAt(): Carbon
    {
        return $this->createdAt;
    }

    public function setCreatedAt(Carbon $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function isModalityRemote(): bool
    {
        return $this->modality() === 'remote';
    }

    public function  isModalityHibryd(): bool
    {
        return $this->modality() === 'hibryd';
    }

    public function companyName(): string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }



}
