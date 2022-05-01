<?php

namespace WorkWithUs\Company\Application\Service;

use WorkWithUs\Shared\Domain\Service\SlugifyService;
use WorkWithUs\Company\Domain\Entity\Company;
use WorkWithUs\Company\Infrastructure\CompanyRepository;

class CreateCompanyUseCase
{
    public function __construct(
        private CompanyRepository $companyRepository,
        private SlugifyService $slugifyService
    ) {
    }

    public function execute(
        int $actingUserId,
        string $name,
        string $description,
    ) {
        $slug = $this->slugifyService->slugify($name);

        $company = (new Company())
            ->setMainUserId($actingUserId)
            ->setName($name)
            ->setDescription($description)
            ->setSlug($slug);

        $this->companyRepository->createCompany($company);
    }
}
