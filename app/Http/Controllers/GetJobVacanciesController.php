<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use WorkWithUs\Auth\Application\GetJobVacanciesUseCase;

class GetJobVacanciesController extends Controller
{
        public function __invoke(
            Request $request,
            GetJobVacanciesUseCase $getJobVacanciesUseCase
        ): JsonResponse
        {
            $data = $getJobVacanciesUseCase->execute();

            return new JsonResponse($data);
        }
}
