<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use WorkWithUs\Auth\Domain\Service\GetAuthenticatedUserService;
use WorkWithUs\Publishing\Application\MarkJobVacancyAsPublishedUseCase;

class MarkJobVacancyAsPublishedController extends Controller
{
    public function __invoke(
        MarkJobVacancyAsPublishedUseCase $markJobVacancyAsPublishedUseCase,
        Request $request,
        GetAuthenticatedUserService $getAuthenticatedUserService
    ): JsonResponse {
        $joVacancyUuid = $request->get('uuid');

        $actingUser = $getAuthenticatedUserService->execute();

        $markJobVacancyAsPublishedUseCase->execute(
            $actingUser,
            $joVacancyUuid,
        );

        return new JsonResponse();
    }
}
