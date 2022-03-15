<?php

namespace WorkWithUs\Auth\Domain\Entity;


class JobVacancy
{
    private int $id;
    private int $userId;
    private string $title;
    private string $company;
    private string $location;
    private string $modality;
    private string $workingTime;
    private string $experience;
    private string $uuid;
    private string $urlToken;

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


    public function title(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function company(): string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

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

}
