<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use WorkWithUs\Auth\Domain\Service\GetAuthenticatedUserService;
use WorkWithUs\Company\Application\Service\GetMyCompaniesUseCase;

class GetMyCompaniesController extends Controller
{
    public function __invoke(
        GetMyCompaniesUseCase $getMyCompaniesUseCase,
        Request $request,
        GetAuthenticatedUserService $getAuthenticatedUserService
    ): JsonResponse {
        $actingUser = $getAuthenticatedUserService->execute();

        $companyItems = $getMyCompaniesUseCase->execute(
            $actingUser
        );

        return new JsonResponse($companyItems);
    }

}
