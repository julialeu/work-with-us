<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use WorkWithUs\Auth\Domain\Service\GetAuthenticatedUserService;
use WorkWithUs\Publishing\Application\CreateJobVacancyUseCase;

class ShowCompanyPageController
{
    public function __invoke(
        Request $request,
        CreateJobVacancyUseCase $addJobVacancyUseCase,
        GetAuthenticatedUserService $getAuthenticatedUserService
    ) {

        $companySlug = $request->route('companySlug');

        // 1. Buscar la company que tenga ese slug
        // 2. Coger las posiciones publicadas de esa company

        // https://css-tricks.com/how-to-create-a-shrinking-header-on-scroll-without-javascript/
        
        return view('company-page', ['name' => 'Finn']);
    }
}
