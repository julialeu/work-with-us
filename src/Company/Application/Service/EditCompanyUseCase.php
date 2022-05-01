<?php

namespace WorkWithUs\Company\Application\Service;

use WorkWithUs\Company\Domain\ValueObject\EditCompanyRequest;
use WorkWithUs\Company\Infrastructure\CompanyRepository;

class EditCompanyUseCase
{
    public function __construct(
        private CompanyRepository $companyRepository,
    ) {
    }

    public function execute(
        EditCompanyRequest $editCompanyRequest
    ): void {
        $company = $this->companyRepository->getById($editCompanyRequest->companyId());

        if ($editCompanyRequest->name() !== null) {
            $company->setName($editCompanyRequest->name());
        }

        if ($editCompanyRequest->description() !== null) {
            $company->setDescription($editCompanyRequest->description());
        }

        $this->companyRepository->updateCompany($company);
    }
}
