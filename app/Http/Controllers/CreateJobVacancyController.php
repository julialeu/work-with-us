<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use WorkWithUs\Auth\Application\CreateJobVacancyUseCase;
use WorkWithUs\Auth\Domain\Service\GetAuthenticatedUserService;

class CreateJobVacancyController extends Controller
{
    public function __invoke(
        Request $request,
        CreateJobVacancyUseCase $addJobVacancyUseCase,
        GetAuthenticatedUserService $getAuthenticatedUserService
    ): JsonResponse {
        $user = $getAuthenticatedUserService->execute();
        $userId = $user->id();

        $title = $request->get('title');
        $company = $request->get('company');
        $location = $request->get('location');
        $modality = $request->get('modality');
        $workTime = $request->get('workTime');
        $experience = $request->get('experience');

        $addJobVacancyUseCase->execute(
            $userId,
            $title,
            $company,
            $location,
            $modality,
            $workTime,
            $experience
        );

        return new JsonResponse();
    }
}

