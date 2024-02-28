<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Commerce;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    public function login(LoginRequest $datos)
    {
        $credenciales = $datos->only('email', 'password');

        if (Auth::attempt($credenciales)) {
            $user = User::where('email', $datos->email)->first();
            $token = $user->createtoken('my_app_token')->plainTextToken;

            $response = [
                'token' => $token
            ];

            return response($response, 201);
        }

        return response()->json(['error' => 'Ususario no encontrado'], 404);
    }

    public function register(RegisterRequest $datos) {
        $user = User::create([
            'name' => $datos->name,
            'email' => $datos->email,
            'phone' => $datos->phone,
            'password' => Hash::make($datos->password)
        ]);
        $credentials = $datos->only('email', 'password');
        Auth::attempt($credentials);
        if($datos->empresa) {
            $user->assignRole('commerce');
            $commerce = Commerce::create([
            ]);
            $commerce->user->attach($user->id);
        }else {
            $user->assignRole('customer');
            $customer = Customer::create([
            ]);
            $customer->user()->attach($user->id);
        }
        
        
        $response = [
            'message' => 'Usuario credo correctamente',
            'user' => $user
        ];
            
        
        return response($response, 201);
    }
}
