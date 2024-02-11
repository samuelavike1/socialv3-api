<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'=>'string',
            'phone'=>'string|required',
            'email'=>'string|required',
            'password'=> 'required|string',
        ]);

        $save_data = User::query()->create([
            'username' => $request['username'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'api_token' => Str::random(60),
        ]);

        $result = ($save_data) ? ['message'=>'Success', $save_data,] : ['message'=>'Registration failed'];
        return response()->json($result);

//        if ($save_data){
//            return response()->json([
//                'message'=>'Success',
//                $save_data,
//            ]);
//        }else {
//            return response()->json([
//                'message'=>'Registration failed'
//            ]);
//        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'phone'=>'required|string',
            'password'=>'string|required'
        ]);

        if (Auth::attempt($credentials)){
           $user = auth()->user();
           $token = $user->createToken('access_token');

           return response()->json([
               'message'=>'Success',
               'access_token'=>$token->plainTextToken,
           ]);
        }
    }

    public function logout()
    {

    }
}
