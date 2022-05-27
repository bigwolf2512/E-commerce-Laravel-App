<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $req)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'phone_number' => 'required|string',
            'password' => 'required|string|min:6',
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'phone_number' => $req->phone_number,
            'password' => Hash::make($req->password),
            'verified' => User::VERIFIED_USER,
            'admin' => User::ADMIN_USER,
            'token' => (new \App\Models\User)->generateVerificationCode(),
        ]);
        $response = ['user' => $user];
        return response()->json($response, 200);
    }
    public function login(Request $req)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];
        $req->validate($rules);
        $user = User::where('email', $req->email)->first();
        if ($user && Hash::check($req->password, $user->password)) {
            $response = [
                'user' => $user,
            ];
            return response()->json($response, 200);
        }

        $response = ['message' => 'Incorect email or password, please try again'];
        return response()->json($response, 400);
    }
}
