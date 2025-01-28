<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        
        // => insert into users
        // POST /api/register

        $fields = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        //in postman body>raw>json
        // {
        //     "name": "James Bond",
        //     "email": "bond@gmail.com",
        //     "password": "bond",
        //     "password_confirmation": "bond"
        // }

        $user = User::create($fields);

        return ['user' => $user];
    }

    public function login(Request $request) {

        // => select users where email and password .... exist
        // POST /api/login

        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        //select user where email = ....
        $user = User::where('email', $request->email)->first();

        //if user with email not exist or password not match
        if (!$user || !Hash::check($request->password, $user->password)) {
            return [
                'message' => 'Wrong email or password!'
            ];
        }

        //$user exist!
        //generate sanctum token
        $token = $user->createToken($user->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    //this must checked for user login or not
    //add ->middleware('auth:sanctum') at route
    public function logout(Request $request) {
       
        //delete token
        $request->user()->tokens()->delete();

        return [
            'message' => 'You are logged out!'
        ];
    }
}
