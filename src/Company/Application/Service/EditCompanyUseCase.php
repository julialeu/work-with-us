<?php

namespace WorkWithUs\Company\Application\Service;

use WorkWithUs\Company\Infrastructure\CompanyRepository;

class EditCompanyUseCase
{
    public function __construct(
        private CompanyRepository $companyRepository,
    ) {
    }

    public function execute(
        string $companyId,
        ?string $name,
        ?string $description
    ): void {
        $company = $this->companyRepository->getById($companyId);

        if ($name !== null) {
            $company->setName($name);
        }

        if ($description !== null) {
            $company->setDescription($description);
        }

//        if ($description !== null) {
//            $company->setDescription($description);
//        }

        $this->companyRepository->updateCompany($company);
    }
}
