<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validazione dati utente
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'date_of_birth' => 'required|date',
            'password' => 'required|string|confirmed'
        ]);

        // Creazione utente
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'date_of_birth' => $data['date_of_birth'],
            'password' => bcrypt($data['password']),
        ]);

        // Generazione token
        $token = $user->createToken('myapptoken')->plainTextToken;

        // Risposta
        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        // Validazione dati utente esistente
        $data = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        // Controllo email
        $user = User::where('email', $data['email'])->first();

        // Controllo password
        if(!$user || !Hash::check($data['password'], $user->password)) {
            return response([
                'message' => 'E-mail o password errate.'
            ], 401);
        }

        // Generazione token
        $token = $user->createToken('myapptoken')->plainTextToken;

        // Risposta
        $response = [
            'user' => $user,
            'token' => $token,
            'message' => 'hai eseguito il login con successo'
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
