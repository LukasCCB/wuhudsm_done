<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// DISABLED
// DISABLED
// DISABLED
// DISABLED
// DISABLED
// DISABLED

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Check if already logged
        if (Auth::check()) return response()->json(['type' => 'success', 'msg' => 'Authenticated successfully!!', "redirect" => "/admin"]);

        // Convert string pwd with Hash MD5.
        $string_to_hash = getenv("DB_PASSWORD_HASH") . $request->password;
        $md5_hash = md5($string_to_hash);

        // Check user on database table "Accounts"
        $user = User::where('email', $request->email)
            ->where('MD5Password', $md5_hash)
            ->first();

        // If user found, credentials are correct
        if ($user) {

            // Check permission
            if ($user->UserData->IsDeveloper === "0") {

                return response()->json([
                    'type' => 'error',
                    'msg' => 'Invalid Permissions.',
                    'errors' => [
                        'permission' => 'Missing permissions!'
                    ]
                ]);

            } else {
                Auth::login($user, true);
                //$user->remember_token = Auth::user()->remember_token;

                return response()->json(['type' => 'success', 'msg' => 'Authenticated successfully!', "redirect" => "/admin"]);
            }

        } else {
            return response()->json([
                'type' => 'error',
                'msg' => 'The credentials provided are incorrect.',
                'errors' => [
                    'login' => 'E-mail or Password incorrect or missing permissions!',

                ]
            ]);
        }
    }
}
