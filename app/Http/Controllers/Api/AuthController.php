<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getAuthStatus()
    {
        $authenticated = Auth::check();
        $user = null;
        if ($authenticated) {
            $user = Auth::user();
        }
        return response()->json([
            'authenticated' => $authenticated,
            'user' => $user
        ]);
    }
}

// $authenticated = Auth::check();
//         $user = null;
//         if ($authenticated) {
//             $user = Auth::user();
//         }
//         return response()->json([
//             'authenticated' => $authenticated,
//             'user' => $user
//         ]);

// if (Auth::check()) {
//     $user = Auth::user();
//     return response()->json([
//         'authenticated' => true,
//         'user' => $user
//     ]);
// } else {
//     return response()->json([
//         'authenticated' => false
//     ]);
// }
