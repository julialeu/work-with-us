<?php

namespace WorkWithUs\Auth\Infrastructure\Repository;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use WorkWithUs\Auth\Domain\Entity\User;

class UsersRepository
{
    public function findByEmail(string $email): ?User
    {
        $query = "select * from users where email = '$email'";

        $result = DB::select($query);

        if (empty($result)) {
            return null;
        }

        $row = $result[0];

        $user = new User();
        $user->setEmail($row->email);

        return $user;
    }

    public function createUser(User $user)
    {
        $name = $user->name();
        $company = $user->company();
        $email = $user->email();
        $password =$user->hashedPassword();

        $now = Carbon::now()->format('Y-m-d H:i:s');

        $query = "
        INSERT INTO users (name, company, email, password, created_at, updated_at)
        VALUES ('$name', '$company', '$email', '$password', '$now', '$now');
        ";

        DB::statement( $query );



        //var_dump($query);
    }
}
