<?php
/*
 * Copyright (c) 09-09/08/23, 15:49.
 * Created By WebZow Soluções Digitais.
 * Site: https://webzow.com
 * Discord: https://discord.gg/TgCccsKSYu
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PanelSetting;
use App\Models\User\User;
use App\Models\User\UserData;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /*public function __construct()
    {
        //$this->middleware('auth');
    }*/

    public function landing()
    {
        $panelConf = PanelSetting::where('id', 1)->first();
        return view('admin.landing', compact('panelConf'));
    }

    public function index()
    {
        $now = Carbon::now();
        $Latest24 = $now->copy()->subDay(); // Limit 24 hours ago
        $Latest30d = $now->copy()->addMonth(); // Limit 30 days ago

        // Users
        $Latest24_NewUsers_10 = User::where('dateregistered', '>=', $Latest24)->orderBy("CustomerID", "desc")->take(10)->get();
        $Latest24_NewUsers = User::where('dateregistered', '>=', $Latest24)->count();
        $Latest30d_NewUsers = User::where('dateregistered', '>=', $Latest30d)->count();

        // Banneds
        $Latest24h_Banneds = UserData::where('AccountStatus', '!=', 100)->where('BanTime', '>=', $Latest24)->count();

        // Premium
        $Latest24h_NewPremium = UserData::where('PremiumExpireTime', '>=', $Latest24)->count();

        // Users most active
        $AllTime_UsersMostActive = UserData::where('DateActiveUntil', '>=', $Latest24)->orderBy("TimePlayed", "desc")->take(10)->get();

        foreach ($AllTime_UsersMostActive as $UserMostActive) {

            $secs = $UserMostActive->TimePlayed;

            // Convert Secs to Months
            $months = intdiv($secs, 60 * 60 * 24 * 30);
            $secs %= 60 * 60 * 24 * 30;

            // Convert secs to days
            $days = intdiv($secs, 60 * 60 * 24);
            $secs %= 60 * 60 * 24;

            // Convert Secs to Hours
            $hours = intdiv($secs, 60 * 60);
            $secs %= 60 * 60;

            // Convert Secs to Minutes
            $minutes = intdiv($secs, 60);

            //$UserMostActive->TimePlayed = "$months/m $days/d, $hours/h, $minutes/m";

            $tempoFormatado = [];

            if ($months > 0) {
                $tempoFormatado[] = "$months/m";
            }

            if ($days > 0) {
                $tempoFormatado[] = "$days/d";
            }

            if ($hours > 0) {
                $tempoFormatado[] = "$hours/h";
            }

            if ($minutes > 0) {
                $tempoFormatado[] = "$minutes/min";
            }

            // Concatenar os valores formatados em uma string separados por espaço
            $UserMostActive->TimePlayed = implode(' ', $tempoFormatado);

        }

        return view('admin.dashboard', compact(
            "Latest24_NewUsers_10",
            "Latest24_NewUsers",
            "Latest30d_NewUsers",
            "Latest24h_NewPremium",
            "Latest24h_Banneds",
            "AllTime_UsersMostActive"
        ));
    }
}
