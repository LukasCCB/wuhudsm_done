<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    public function page_login()
    {
        //dd(Auth::check());
        return view('admin.pages.login');
    }

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
            if ($user->UserData->IsDeveloper == "0") {

                return response()->json([
                    'type' => 'error',
                    'msg' => 'Invalid Permissions.',
                    'errors' => [
                        'permission' => 'Missing permissions!'
                    ]
                ]);

            } else {
                Auth::login($user);
                Session::put('loggedin', 'yes');
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

    public function logout()
    {
        // Check if has logged
        if (Auth::check()) {
            $user = Auth::user();
            //$user->remember_token = null;
            $user->save();

            session()->flush();
            Cache::flush();
            Auth::logout();
            session()->forget(Str::slug(env('APP_NAME', 'laravel'), '_') . '_session');

            return redirect()->route('admin.login');
        } else {
            return redirect()->route('admin');
        }
    }
}
