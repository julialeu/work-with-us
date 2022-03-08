<?php

namespace WorkWithUs\Auth\Domain\Service;

use App\Models\UserModel;
use WorkWithUs\Auth\Domain\Entity\User;

class TransformUserModelService
{
    public function transformUserModel(UserModel $userModel): User
    {
        $email = $userModel->email;
        $name = $userModel->name;
        $password = $userModel->password;
        $company = $userModel->company;

        $user = new User();
        $user->setEmail($email);
        $user->setName($name);
        $user->setHashedPassword($password);
        $user->setCompany($company);

        return $user;
    }
}