<?php
/*
 * Copyright (c) 08-09/08/23, 10:52.
 * Created By WebZow Soluções Digitais.
 * Site: https://webzow.com
 * Discord: https://discord.gg/TgCccsKSYu
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ApiAccountsController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //$users = User::with('UserData')->get();
        // some db is IsDevelopers
        $users = $this->user->select(['CustomerID', 'email', 'AccountStatus', 'IsDeveloper', 'dateregistered', 'lastloginIP'])->get();

        // Convert data-info to string
        foreach ($users as $user) {
            $datetime = new Carbon($user->dateregistered);
            $user->dateregistered = $datetime->format('Y-m-d | H:i:s');
            $user->AccountStatus = $this->AccountStatusStr($user->AccountStatus);
            $user->IsDeveloper = $this->AccountTypeStr($user->IsDeveloper);
        }

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->find($id);
        if (!$user) return response()->json(['message' => 'User not found!'], 404);

        return response()->json($user->toArray(), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->user->find($id);
        if (!$user) return response()->json(['message' => 'User not found!'], 404);

        // Valide os dados recebidos do JSON
        $request->validate([
            'email' => 'email|string|min:10|max:50', // |unique:accounts,email
            'BadLoginCount' => 'integer',
            'AccountStatus' => 'integer',
            'IsDeveloper' => 'integer', // IsDevelopers
            'AccountType' => 'integer',
            'MD5Password' => 'string',
            // UsersData
            'GamePoints' => 'numeric',
            'GameDollars' => 'numeric',
        ]);

        // Fix duplicated fields
        $AccountStatus = $request->input('AccountStatus', $user->AccountStatus);
        $IsDevelopers = $request->input('IsDevelopers', $user->IsDeveloper);

        $user->email = $request->input('email', $user->email);
        $user->BadLoginCount = $request->input('BadLoginCount', $user->BadLoginCount);
        $user->MD5Password = (!empty($request->input('password'))) ? $this->user->HashPassword($request->input('password')) : $user->MD5Password;
        $user->AccountStatus = $AccountStatus;
        $user->IsDeveloper = $IsDevelopers;
        $user->save();

        // UsersData
        if ($user->UserData) {
            $userData = $user->UserData;
            $userData->GamePoints = $request->input('GamePoints', $userData->GamePoints);
            $userData->GameDollars = $request->input('GameDollars', $userData->GameDollars);
            $userData->AccountType = $request->input('AccountType', $userData->AccountType);

            // Copy values from User to UserData
            if (!empty($AccountStatus)) $userData->AccountStatus = $AccountStatus;
            if (!empty($IsDevelopers)) $userData->IsDeveloper = $IsDevelopers;

            $userData->save();
        }

        return response()->json(['type' => 'success', 'message' => 'User updated succesfully!', 'updated' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
