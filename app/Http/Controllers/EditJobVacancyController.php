<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use WorkWithUs\Publishing\Application\EditJobVacancyUseCase;

class EditJobVacancyController extends Controller
{
    public function __invoke(
        EditJobVacancyUseCase $editJobVacancyUseCase,
        Request $request
    ): JsonResponse {
        $uuid = $request->get('uuid');
        $title = $request->get('title');
        \Log::info($title);
        $description = $request->get('description');
        $company = $request->get('company');
        $location = $request->get('location');
        $modality = $request->get('modality');
        $workingTime = $request->get('workingTime');
        $experience = $request->get('experience');

        $editJobVacancyUseCase->execute(
            $uuid,
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
