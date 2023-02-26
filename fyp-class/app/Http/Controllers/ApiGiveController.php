<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiGiveController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();
        if ($user) {
            if (Hash::check($password, $user->password)) {
                return response()->json([
                    'status' => true,
                    'user' => $user
                ]);
            }
            return response()->json([
                'status' => false,
                'message' => 'Password not matched'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'User Not Exist'
        ]);
    }
    public function register(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        // $phone = $request->phone;
        $password = $request->password;


        if ($name == null || $email == null || $password == null) {
            return response()->json([
                'status' => false,
                'messsage' => 'Please Provide name, email and password',
            ]);
        }


        $user = User::where('email', $email)->first();
        if ($user) {
            return response()->json([
                'status' => false,
                'message' => 'User already Exist'
            ]);
        }
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'registered successfully',
                'user' => $user,
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'User Not Exist'
        ]);
    }
}
