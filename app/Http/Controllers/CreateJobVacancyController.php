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
        $description = $request->get('description');

        \Log::info('title: ' . $title);



        $company = $request->get('company');
        $location = $request->get('location');
        $modality = $request->get('modality');
        $workingTime = $request->get('workingTime');
        $experience = $request->get('experience');

//        var_dump($experience);
//        die;
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

