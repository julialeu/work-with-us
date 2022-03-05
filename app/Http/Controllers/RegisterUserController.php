<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use WorkWithUs\Auth\Application\RegisterUserUseCase;
use WorkWithUs\Auth\Application\UserWithSameEmailExistException;


class RegisterUserController extends Controller
{
    public function __invoke(
        Request $request,
        RegisterUserUseCase $registerUserUseCase
    ): JsonResponse {
        $email = $request->get('email');
        $password = $request->get('password');
        $name = $request->get('name');
        $company = $request->get('company');

        try {
            $registerUserUseCase->execute($email, $password, $name, $company);
        } catch (UserWithSameEmailExistException $e) {
            return new JsonResponse(
                ['errorMessage' => 'Ya existe un usuario registrado con este email'],
                400
            );
        }

        return new JsonResponse(
            ['ok']
        );
    }
}

