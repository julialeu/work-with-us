<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use WorkWithUs\Auth\Domain\Service\GetAuthenticatedUserService;
use WorkWithUs\Publishing\Application\CreateJobVacancyUseCase;

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
        $description = $request->get('description');

        $company = $request->get('company');
        $location = $request->get('location');
        $modality = $request->get('modality');
        $workingTime = $request->get('workingTime');
        $experience = $request->get('experience');

        $addJobVacancyUseCase->execute(
            $userId,
            $title,
            $description,
            $company,
            $location,
            $modality,
            $workingTime,
            $experience
        );

        return new JsonResponse();
    }
}

