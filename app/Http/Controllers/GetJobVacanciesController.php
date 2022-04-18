<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use WorkWithUs\Auth\Domain\Service\GetAuthenticatedUserService;
use WorkWithUs\Publishing\Application\GetJobVacanciesUseCase;

class GetJobVacanciesController extends Controller
{
        public function __invoke(
            Request $request,
            GetJobVacanciesUseCase $getJobVacanciesUseCase,
            GetAuthenticatedUserService $getAuthenticatedUserService
        ): JsonResponse
        {
            $numPage = $request->get('numPage', 1);

            $actingUser = $getAuthenticatedUserService->execute();

            $data = $getJobVacanciesUseCase->execute(
                $numPage,
                $actingUser
            );

            return new JsonResponse($data);
        }
}
