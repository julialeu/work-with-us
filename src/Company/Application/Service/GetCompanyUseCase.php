<?php

namespace WorkWithUs\Company\Application\Service;

use WorkWithUs\Company\Infrastructure\CompanyRepository;

class GetCompanyUseCase
{
    public function __construct(
        private CompanyRepository $companyRepository
    ) {
    }

    public function execute(int $companyId): array
    {
        $company = $this->companyRepository->getById($companyId);

        return  [
            'id' => $company->id(),
            'name' => $company->name(),
            'description' => $company->description(),
        ];
    }
}
