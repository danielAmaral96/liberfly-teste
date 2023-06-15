<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\{
    AuthRegisterRequest,
    AuthLoginRequest
};
use App\Models\User;



class AuthController extends Controller
{

    

    public function register(AuthRegisterRequest $request)
    {
                
        $user = new User([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        $user->save();

        return response()->json(['message' => 'Registration successful'], 201);
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid credentials'], 400);
        }

        if (!auth()->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = auth()->user();
        $token = $user->createToken('AuthToken')->plainTextToken;

        return response(['user'=> $user,'access_token' => $token]);
    }

}