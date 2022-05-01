<?php

namespace WorkWithUs\Company\Domain\ValueObject;

class EditCompanyRequest
{
    private int $companyId;
    private string $name;
    private string $description;

    public function __construct(
        int $companyId,
        ?string $name,
        ?string $description,
    ) {
        $this->companyId = $companyId;
        $this->name = $name;
        $this->description = $description;
    }

    public function companyId(): int
    {
        return $this->companyId;
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function description(): ?string
    {
        return $this->description;
    }
}
