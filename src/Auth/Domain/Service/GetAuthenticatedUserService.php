<?php

namespace WorkWithUs\Auth\Domain\Service;

use WorkWithUs\Auth\Domain\Entity\User;
use WorkWithUs\Auth\Domain\Exception\UserUnauthenticatedException;

class GetAuthenticatedUserService
{
    private TransformUserModelService $transformUserModelService;

    public function __construct(
        TransformUserModelService $transformUserModelService
    ) {
        $this->transformUserModelService = $transformUserModelService;
    }

    /**
     * @return User
     * @throws UserUnauthenticatedException
     */
    public function execute(): User
    {
        $userModel = auth()->user();
        if ($userModel === null) {
            throw new UserUnauthenticatedException('User is not authenticated!!');
        }

        return $this->transformUserModelService->transformUserModel($userModel);
    }
}
