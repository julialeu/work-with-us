<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use WorkWithUs\Publishing\Application\GetJobVacancyUseCase;

class GetJobVacancyController extends Controller
{
    public function __invoke(
        Request $request,
        GetJobVacancyUseCase $getJobVacancyUseCase
    ): JsonResponse
    {
        $uuid = $request->get('uuid');

        $item = $getJobVacancyUseCase->execute($uuid);

        return new JsonResponse($item);
    }
}
