<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use WorkWithUs\Auth\Application\RegisterUserUseCase;
use WorkWithUs\Auth\Application\UserWithSameEmailExistException;

class RegisterUserController extends Controller
{
    public function __invoke(
        Request $request,
        RegisterUserUseCase $registerUserUseCase
    ): JsonResponse {

        try{
            $email = $request->get('email');
            $password = $request->get('password');
            $name = $request->get('name');
            try {
                $registrationResult = $registerUserUseCase->execute($email, $password, $name);
            } catch (UserWithSameEmailExistException $e) {
                return new JsonResponse(
                    ['errorMessage' => 'Ya existe un usuario registrado con este email'],
                    400
                );
            }

            return new JsonResponse($registrationResult);
        } catch (Throwable $e) {
            Log::error('Error: ' . $e->getMessage());
            return new JsonResponse(
                ['errorMessage' => 'Internal Error'],
                500
            );
        }
    }
}

