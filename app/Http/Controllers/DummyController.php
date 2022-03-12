<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use WorkWithUs\Auth\Domain\Service\GetAuthenticatedUserService;
use WorkWithUs\Auth\Domain\Service\TransformUserModelService;

class DummyController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function execute()
    {
        $transformUserModelService = new TransformUserModelService(
        );
        $getAuthenticatedUserService = new GetAuthenticatedUserService(new TransformUserModelService());



        die('Hola');
    }

}
