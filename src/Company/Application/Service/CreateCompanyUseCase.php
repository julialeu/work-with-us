<?php

namespace WorkWithUs\Company\Application\Service;

use WorkWithUs\Auth\Domain\Service\SlugifyService;
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
    ) {

        // TODO create the slug from the name !!!

        $slug = $this->slugifyService->slugify($name);

        $company = (new Company())
            ->setMainUserId($actingUserId)
            ->setName($name)
            ->setSlug($slug);

        $this->companyRepository->createCompany($company);
    }
}
