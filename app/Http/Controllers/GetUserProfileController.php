<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use WorkWithUs\Auth\Domain\Service\GetAuthenticatedUserService;

class GetUserProfileController extends Controller
{
    private GetAuthenticatedUserService $getAuthenticatedUserService;

    public function __construct(
        GetAuthenticatedUserService $getAuthenticatedUserService
    ) {
        $this->getAuthenticatedUserService = $getAuthenticatedUserService;
    }

    public function __invoke(
        Request $request,
    ): JsonResponse {
        try {
            $user = $this->getAuthenticatedUserService->execute();
            $username = $user->name();

            return new JsonResponse(
                [
                    'name' => $username
                ]
            );
        } catch (Throwable $e) {
            Log::error('Error: ' . $e->getMessage());
            return new JsonResponse(
                [
                    'errorMessage' => $e->getMessage(),
                    'errorTrace' => $e->getTraceAsString()
                ],
                500
            );
        }
    }
}

