<?php
/*
 * Copyright (c) 08/08/23, 20:32.
 * Created By WebZow Soluções Digitais.
 * Site: https://webzow.com
 * Discord: https://discord.gg/TgCccsKSYu
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Skilltree;
use Illuminate\Http\Request;

class ApiSkilltreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skilltree = Skilltree::all();
        return response()->json($skilltree);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $skilltree = Skilltree::find($id);
        if (!$skilltree) return response()->json(['message' => 'Skilltree not found!'], 404);

        return response()->json($skilltree->toArray(), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $skilltree = Skilltree::find($id);
        if (!$skilltree) return response()->json(['message' => 'Skilltree not found!'], 404);

        // Valide os dados recebidos do JSON
        $request->validate([
            'Lv1' => 'required|integer',
            'Category' => 'required|string',
            'Name' => 'required|string',
            'Description' => 'required|string',
        ]);

        $skilltree->update([
            'Lv1' => $request->input('Lv1'),
            'Category' => $request->input('Category'),
            'Name' => $request->input('Name'),
            'Description' => $request->input('Description'),
        ]);

        return response()->json(['type' => 'success', 'message' => 'Skilltree updated succesfully!', 'updated' => $skilltree], 200);
    }
}
