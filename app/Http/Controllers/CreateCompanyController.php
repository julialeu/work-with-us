<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use WorkWithUs\Auth\Domain\Service\GetAuthenticatedUserService;
use WorkWithUs\Company\Application\Service\CreateCompanyUseCase;

class CreateCompanyController extends Controller
{
    public function __invoke(
        Request $request,
        CreateCompanyUseCase $createCompanyUseCase,
        GetAuthenticatedUserService $getAuthenticatedUserService
    ): JsonResponse {
        $actingAdminUser = $getAuthenticatedUserService->execute();
        $actingAdminUserId = $actingAdminUser->id();

        $name = $request->get('name');


        $createCompanyUseCase->execute(
            $actingAdminUserId,
            $name
        );

        return new JsonResponse();
    }
}

