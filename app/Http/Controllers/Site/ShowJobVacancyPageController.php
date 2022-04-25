<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use WorkWithUs\Company\Infrastructure\CompanyRepository;
use WorkWithUs\Publishing\Domain\Repository\JobVacancyRepositoryInterface;

class ShowJobVacancyPageController
{

    public function __invoke(
        Request $request,
        CompanyRepository $companyRepository,
        JobVacancyRepositoryInterface $jobVacancyRepository

    )
    {
        $companySlug = $request->route('companySlug');
        $jobVacancyUrlToken = $request->route('urlToken');

        $company = $companyRepository->getBySlug($companySlug);
        $jobVacancy = $jobVacancyRepository->getJobVacancyByUrlToken($jobVacancyUrlToken);

        return view('job-vacancy-page', [
            'companyName' => $company->name(),
            'jobVacancy' => $jobVacancy
        ]);


    }
}
