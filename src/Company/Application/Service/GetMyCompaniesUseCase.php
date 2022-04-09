<?php

namespace WorkWithUs\Company\Application\Service;

use WorkWithUs\Auth\Domain\Entity\User;
use WorkWithUs\Company\Infrastructure\CompanyRepository;

class GetMyCompaniesUseCase
{
    private CompanyRepository $companyRepository;

    public function __construct(
        CompanyRepository $companyRepository
    ) {
        $this->companyRepository = $companyRepository;
    }

    public function execute(
        User $actingUser
    ): array {
        $companies = $this->companyRepository->getByUserId($actingUser->id());

        $dataItems = [];

        foreach ($companies as $company) {
            $item = [
                'id' => $company->id(),
                'name' => $company->name(),
                'slug' => $company->slug(),
            ];

            $dataItems[] = $item;
        }

        return [
            'items' => $dataItems
        ];
    }
}
