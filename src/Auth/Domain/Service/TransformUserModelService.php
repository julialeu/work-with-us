<?php

namespace WorkWithUs\Auth\Domain\Service;

use App\Models\UserModel;
use WorkWithUs\Auth\Domain\Entity\User;

class TransformUserModelService
{
    public function transformUserModel(UserModel $userModel): User
    {
        $userId = $userModel->id;
        $email = $userModel->email;
        $name = $userModel->name;
        $password = $userModel->password;

        $user = new User();
        if ($userId !== null) {
            $user->setUserId($userId);
        }
        $user->setEmail($email);
        $user->setName($name);
        $user->setHashedPassword($password);

        return $user;
    }
}
