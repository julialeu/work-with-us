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
            $numPage = $request->get('numPage');

            $data = $getJobVacanciesUseCase->execute($numPage);

            return new JsonResponse($data);
        }
}
