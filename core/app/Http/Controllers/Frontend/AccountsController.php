<?php
/*
 * Copyright (c) 08-09/08/23, 11:09.
 * Created By WebZow Soluções Digitais.
 * Site: https://webzow.com
 * Discord: https://discord.gg/TgCccsKSYu
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\User\UserData;
use Illuminate\Support\Carbon;

class AccountsController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function all()
    {
        //$users = User::with('UserData')->get();
        $users = User::select(['CustomerID', 'email', 'AccountStatus', 'IsDeveloper', 'dateregistered', 'lastloginIP'])->get();

        // Convert data-info to string
        foreach ($users as $user) {
            $datetime = new Carbon($user->dateregistered);
            $user->dateregistered = $datetime->format('Y-m-d | H:i:s');
            $user->AccountStatus = $this->AccountStatusStr($user->AccountStatus);
            $user->IsDeveloper = $this->AccountTypeStr($user->IsDeveloper);
        }

        //return response()->json($users);

        return view('admin.pages.accounts.all', compact("users"));
    }

    public function edit($id)
    {
        $account = $this->user->find($id);

        // detect if have any char, show only first
        if ($account->UserChars) $account->firstChar = $account->UserChars[0]->HeroItemID; else $account->firstChar = "skull";

        return view('admin.pages.accounts.edit', compact("account"));
    }

    public function premium()
    {
        $users = User::with('UserData')
            ->whereHas('UserData', function ($query) {
                $query->where('PremiumExpireTime', '>', Carbon::now());
            })
            ->get();

        // Convert data-info to string
        foreach ($users as $user) {

            $datetime = new Carbon($user->dateregistered);
            $user->dateregistered = $datetime->format('Y-m-d | H:i:s');

            $datetimeExpire = new Carbon($user->PremiumExpireTime);
            $user->PremiumExpireTime = $datetimeExpire->format('Y-m-d | H:i:s');
            $user->PremiumTimeRemaining = Carbon::now()->diff($user->UserData->PremiumExpireTime)->format('%d day(s), %h hour(s), %i minute(s) e %s sec(s)');

            $user->AccountStatus = $this->AccountStatusStr($user->AccountStatus);
            $user->IsDeveloper = $this->AccountTypeStr($user->IsDeveloper);
        }

        return view('admin.pages.accounts.premium', compact("users"));
    }

    public function developers()
    {

        $users = User::with('UserData')
            ->whereHas('UserData', function ($query) {
                $query->where('IsDeveloper', '!=', 0);
            })
            ->get();

        // Convert data-info to string
        foreach ($users as $user) {
            $datetime = new Carbon($user->dateregistered);
            $user->dateregistered = $datetime->format('Y-m-d | H:i:s');
            $user->AccountStatus = $this->AccountStatusStr($user->AccountStatus);
            $user->IsDeveloper = $this->AccountTypeStr($user->IsDeveloper);
        }

        return view('admin.pages.accounts.developers', compact("users"));

    }

    public function banneds()
    {

        $users = User::with('UserData')
            ->whereHas('UserData', function ($query) {
                $query->where('AccountStatus', '!=', 100);
            })
            ->get();

        // Convert data-info to string
        foreach ($users as $user) {

            $datetime = new Carbon($user->dateregistered);
            $user->dateregistered = $datetime->format('Y-m-d | H:i:s');

            $BanTime = new Carbon($user->BanTime);
            $user->BanTime = $BanTime->format('Y-m-d | H:i:s');

            $user->BanExpireDate = Carbon::now()->diff($user->UserData->BanExpireDate)->format('%d day(s), %h hour(s), %i minute(s) e %s sec(s)');

            $user->AccountStatus = $this->AccountStatusStr($user->AccountStatus);
            $user->IsDeveloper = $this->AccountTypeStr($user->IsDeveloper);

        }

        return view('admin.pages.accounts.banneds', compact("users"));

    }

    public function gc()
    {
        $users = UserData::with('User')
            ->join('Accounts', 'UsersData.CustomerID', '=', 'Accounts.CustomerID')
            ->orderByDesc('UsersData.GamePoints')
            ->select('UsersData.*', 'Accounts.email')
            ->take(500)
            ->get();

        // Convert data-info to string
        foreach ($users as $user) {

            $user->GamePoints = number_format($user->GamePoints, 0, ',', '.');
            $user->GameDollars = number_format($user->GameDollars, 0, ',', '.');

            $datetime = new Carbon($user->dateregistered);
            $user->dateregistered = $datetime->format('Y-m-d | H:i:s');

            $user->AccountStatus = $this->AccountStatusStr($user->AccountStatus);
            $user->IsDeveloper = $this->AccountTypeStr($user->IsDeveloper);

        }

        return view('admin.pages.top_ranks.gc', compact("users"));

    }

    public function gd()
    {
        $users = UserData::with('User')
            ->join('Accounts', 'UsersData.CustomerID', '=', 'Accounts.CustomerID')
            ->orderByDesc('UsersData.GameDollars')
            ->select('UsersData.*', 'Accounts.email')
            ->take(500)
            ->get();

        // Convert data-info to string
        foreach ($users as $user) {

            $user->GameDollars = number_format($user->GameDollars, 0, ',', '.');
            $user->GamePoints = number_format($user->GamePoints, 0, ',', '.');

            $datetime = new Carbon($user->dateregistered);
            $user->dateregistered = $datetime->format('Y-m-d | H:i:s');

            $user->AccountStatus = $this->AccountStatusStr($user->AccountStatus);
            $user->IsDeveloper = $this->AccountTypeStr($user->IsDeveloper);

        }

        return view('admin.pages.top_ranks.gd', compact("users"));
    }
}
