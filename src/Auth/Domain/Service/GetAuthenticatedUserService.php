<?php

namespace WorkWithUs\Auth\Domain\Service;

use WorkWithUs\Auth\Domain\Entity\User;

class GetAuthenticatedUserService
{
    private TransformUserModelService $transformUserModelService;

    public function __construct(
        TransformUserModelService $transformUserModelService
    ) {
        $this->transformUserModelService = $transformUserModelService;
    }

    public function execute(): User
    {
        $userModel = auth()->user();
        $user = $this->transformUserModelService->transformUserModel($userModel);

        return $user;
    }
}
