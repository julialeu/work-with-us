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
        CreateJobVacancyUseCase $createJobVacancyUseCase,
        GetAuthenticatedUserService $getAuthenticatedUserService
    ): JsonResponse {
        $user = $getAuthenticatedUserService->execute();
        $userId = $user->id();

        $title = $request->get('title');
        $description = $request->get('description');

        $companyId = $request->get('companyId');
        $location = $request->get('location');
        $modality = $request->get('modality');
        $workingTime = $request->get('workingTime');
        $experience = $request->get('experience');

        $createJobVacancyUseCase->execute(
            $userId,
            $title,
            $description,
            $companyId,
            $location,
            $modality,
            $workingTime,
            $experience
        );

        return new JsonResponse();
    }
}

