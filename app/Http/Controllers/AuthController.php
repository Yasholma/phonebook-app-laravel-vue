<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;
use App\User;


class AuthController extends Controller
{
    public function login(Request $request) {
        $credentials = ["email" => $request->email, "password" => $request->password];
        if (Auth::attempt($credentials)) {
            return response()->json(["message" => "Login successful", "data" => Auth::user()], 200);
        }

        return response()->json(["message" => "Login failed"], 403);
    }

    public function register(Request $request) {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        
        $user->save();

        Auth::login($user, true);

        return response()->json(["message" => "Registration successful", "data" => Auth::user()], 201);
    }
}