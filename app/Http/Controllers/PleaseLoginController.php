<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PleaseLoginController extends Controller
{
    public function __invoke(
        Request $request,
    ): JsonResponse {
        return new JsonResponse(['Please login :)']);
    }
}
