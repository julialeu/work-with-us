<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
//    /**
//     * Get a JWT via given credentials.
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function execute()
//    {
//
//        $user = new User();
//        $user->name = 'Julia';
//        $user->email = 'julia@gmail.com';
//        $user->password = Hash::make('1234');
//        $user->company = '';
//
//        $user->save();
//
//        die('Hola');
//    }



}

//class CreateTestController extends Controller
//{
//    private TestRepository $testRepository;
//
//    public function __construct(TestRepository $testRepository)
//    {
//        $this->testRepository = $testRepository;
//    }
//
//    public function __invoke(Request $request)
//    {
//        $method = $request->getMethod();
//
//        if ($method === 'POST') {
//
//            $title = $request->input('title');
//            $description = $request->input('description');
//            $user = Auth::user();
//            $userId = $user->id();
//
//            $test = (new Test())
//                ->setTitle($title)
//                ->setDescription($description)
//                ->setUserId($userId);
//
//            $this->testRepository->save($test);
//
//            return redirect('/dashboard');
//        }
//
//        return view('create_test');
//    }
//
//}
