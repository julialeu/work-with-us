<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use WorkWithUs\Company\Infrastructure\CompanyRepository;
use WorkWithUs\Publishing\Domain\Repository\JobVacancyRepositoryInterface;

class ShowCompanyPageController
{
    public function __invoke(
        Request $request,
        CompanyRepository $companyRepository,
        JobVacancyRepositoryInterface $jobVacancyRepository
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
            $experience,
        );

        return view('company-page', [
            'companyName' => $company->name(),
            'companySlug' => $company->slug(),
            'companyDescription' => $company->description(),
            'jobVacancies' => $jobVacancies,
            'workingTime' => $workingTime,
            'modality' => $modality,
            'experience' => $experience
        ]);
    }
}
