<?php
/*
 * Copyright (c) 08-09/08/23, 19:17.
 * Created By WebZow Soluções Digitais.
 * Site: https://webzow.com
 * Discord: https://discord.gg/TgCccsKSYu
 */

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use \RachidLaasri\LaravelInstaller\Helpers\MigrationsHelper;

    protected $loggedUser;
    public $apiUrlPath;

    public function __construct()
    {
        if (!Session::has('locale')) {
            App::setLocale('en');
            Session::put('locale', 'en');
            config(['app.locale' => 'en']);
        }

        $this->middleware(function ($request, $next) {
            $this->loggedUser = Auth::user();
            view()->share('u', $this->loggedUser);
            return $next($request);
        });
    }

    /**
     * AccountStatus number to String
     * * Recommended do a Switch Case
     *
     * @param $number
     * @return string
     */
    public function AccountStatusStr($number)
    {
        if ($number != 100) return "Banned";
        else return "Normal";
    }

    /**
     * IsDeveloper number to String
     * * Recommended do a Switch Case
     *
     * @param $number
     * @return string
     */
    public function AccountTypeStr($number)
    {
        if ($number >= 1) return "Developer";
        else return "User";

    }

    /**
     * Get URL for mount the API path.
     */
    public function getApiUrl()
    {
        $url = "/api/" . getenv("API_VERSION");
        return url($url);
    }

}
