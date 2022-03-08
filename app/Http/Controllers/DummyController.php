<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class DummyController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function execute()
    {

        $user = new UserModel();
        $user->name = 'Julia';
        $user->email = 'julia@gmail.com';
        $user->password = Hash::make('1234');

        $user->save();



        die('Hola');
    }

}
