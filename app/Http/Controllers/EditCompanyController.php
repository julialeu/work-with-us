<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use WorkWithUs\Company\Application\Service\EditCompanyUseCase;
use WorkWithUs\Company\Domain\ValueObject\EditCompanyRequest;

class EditCompanyController extends Controller
{
    public function __invoke(
        EditCompanyUseCase $editCompanyUseCase,
        Request $request
    ): JsonResponse {
        $companyId = $request->get('companyId');
        $name = $request->get('title');
        $description = $request->get('description');

        $editCompanyRequest = new EditCompanyRequest(
            $companyId,
            $name,
            $description
        );

        $editCompanyUseCase->execute(
            $editCompanyRequest
        );

        return new JsonResponse();
    }
}
