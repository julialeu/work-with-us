<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use WorkWithUs\Company\Application\Service\GetCompanyUseCase;
use WorkWithUs\Publishing\Application\GetJobVacancyUseCase;

class GetCompanyController extends Controller
{
    public function __invoke(
        Request $request,
        GetCompanyUseCase $getCompanyUseCase
    ): JsonResponse
    {
        $companyId = $request->get('companyId');

        $item = $getCompanyUseCase->execute($companyId);

        return new JsonResponse($item);
    }
}
