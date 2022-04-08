<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use WorkWithUs\Auth\Domain\Service\GetAuthenticatedUserService;
use WorkWithUs\Publishing\Application\MarkJobVacancyAsUnpublishedUseCase;

class MarkJobVacancyAsUnpublishedController extends Controller
{

    public function __invoke(
        MarkJobVacancyAsUnPublishedUseCase $markJobVacancyAsUnpublishedUseCase,
        Request $request,
        GetAuthenticatedUserService $getAuthenticatedUserService
    ): JsonResponse {
        $joVacancyUuid = $request->get('uuid');

        $actingUser = $getAuthenticatedUserService->execute();

        $markJobVacancyAsUnpublishedUseCase->execute(
            $actingUser,
            $joVacancyUuid,
        );

        return new JsonResponse();
    }

}
