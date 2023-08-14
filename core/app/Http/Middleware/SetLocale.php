<?php
/*
 * Copyright (c) 09-09/08/23, 15:11.
 * Created By WebZow Soluções Digitais.
 * Site: https://webzow.com
 * Discord: https://discord.gg/TgCccsKSYu
 */


namespace App\Http\Middleware;

//use App\Models\PanelSetting;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        //$panelConf = PanelSetting::where('id', 1)->first();
        //if (!Session::has('locale')) App::setLocale($panelConf->default_language); // Default language init

        if ($request->has('lang')) {
            App::setLocale($request->lang);
            Session::put('locale', $request->lang);
        }

        return $next($request);
    }
}
