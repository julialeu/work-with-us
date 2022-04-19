<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use WorkWithUs\Company\Application\Service\EditCompanyUseCase;

class EditCompanyController extends Controller
{
    public function __invoke(
        EditCompanyUseCase $editCompanyUseCase,
        Request $request
    ): JsonResponse {
        $companyId = $request->get('companyId');
        $title = $request->get('title');
        $description = $request->get('description');

        $editCompanyUseCase->execute(
            $companyId,
            $title,
            $description
        );

        return new JsonResponse();
    }
}
