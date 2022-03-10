<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use WorkWithUs\Auth\Domain\Service\TransformUserModelService;


class GetUserProfileController extends Controller
{
    private TransformUserModelService $transformUserModelService;

    public function __construct(TransformUserModelService $transformUserModelService)
    {
        $this->transformUserModelService = $transformUserModelService;
    }

    public function __invoke(
        Request $request,
    ): JsonResponse {
        try {
            $userModel = auth()->user();
            $user = $this->transformUserModelService->transformUserModel($userModel);
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

