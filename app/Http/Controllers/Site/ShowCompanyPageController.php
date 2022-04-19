<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use WorkWithUs\Auth\Domain\Service\GetAuthenticatedUserService;
use WorkWithUs\Company\Infrastructure\CompanyRepository;
use WorkWithUs\Publishing\Infrastructure\Repository\JobVacancyRepository;

class ShowCompanyPageController
{
    public function __invoke(
        Request $request,
        GetAuthenticatedUserService $getAuthenticatedUserService,
        CompanyRepository $companyRepository,
        JobVacancyRepository $jobVacancyRepository

    ) {
        $companySlug = $request->route('companySlug');
        $workingTime = $request->get('working_time');


        $modality = $request->get('modality');
        $experience = $request->get('experience');

        $company = $companyRepository->getBySlug($companySlug);
        $jobVacancies = $jobVacancyRepository->findPublishedByCompanyId(
            $company->id(),
            $workingTime,
            $modality,
            $experience
        );

        return view('company-page', [
            'companyName' => $company->name(),
            'companySlug' => $company->slug(),
            'jobVacancies' => $jobVacancies,
            'workingTime' => $workingTime,
            'modality' => $modality,
            'experience' => $experience
        ]);
    }
}
