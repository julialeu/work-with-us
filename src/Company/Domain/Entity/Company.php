<?php

namespace WorkWithUs\Company\Domain\Entity;

use Carbon\Carbon;

class Company
{
    private int $id;
    private int $mainUserId;
    private string $name;
    private string $slug;
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

    public function mainUserId(): int
    {
        return $this->mainUserId;
    }

    public function setMainUserId(int $mainUserId): self
    {
        $this->mainUserId = $mainUserId;

        return $this;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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
}
