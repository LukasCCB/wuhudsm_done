<?php
/*
 * Copyright (c) 08/08/23, 16:53.
 * Created By WebZow Soluções Digitais.
 * Site: https://webzow.com
 * Discord: https://discord.gg/TgCccsKSYu
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Item\ItemsGeneric;
use App\Models\Item\LootData;
use Illuminate\Http\Request;

class ApiLootDataController extends Controller
{
    private $lootData;

    public function __construct()
    {
        $this->lootData = new LootData();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loot = $this->lootData->all();

        return response()->json($loot);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'LootID' => 'required',
            'Chance' => 'required',
            'ItemID' => 'required|array',
            'GDMin' => 'nullable|numeric',
            'GDMax' => 'nullable|numeric',
            'Name' => 'nullable',
            'IsVisible' => 'nullable|boolean',
            'FNAME' => 'nullable',
        ]);

        $loots = [];
        foreach ($data['ItemID'] as $itemID) {
            $lootData = $data;
            $lootData['ItemID'] = $itemID;

            $loot = $this->lootData->create($lootData);
            $loots[] = $loot;
        }

        return response()->json(['message' => 'Loot created successfully!', 'aded' => $loots], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param $param
     * @param $withAll
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($param)
    {
        $loot = $this->lootData->where('RecordID', $param)
            ->orWhere('LootID', $param)
            ->orWhere('ItemID', $param)
            //->orWhereRaw("Name like ?", ['%' . $param . '%'])
            ->get();


        if ($loot->isEmpty()) {
            return response()->json(['message' => 'Loot not found!'], 404);
        }

        return response()->json($loot[0], 200);
    }

    public function showAllLootID()
    {
        // Get all Item_LootBox
        $getItemsGeneric = new ItemsGeneric();
        $getAllLootID = $getItemsGeneric->getAllLootID();

        return response()->json($getAllLootID, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $loot = $this->lootData->find($id);
        if (!$loot) return response()->json(['message' => 'Loot not found!'], 404);

        $loot->update([
            'LootID' => $request->input('LootID'),
            'ItemID' => $request->input('ItemID'),
            'Chance' => $request->input('Chance'),
            'GDMin' => $request->input('GDMin') ?? 0,
            'GDMax' => $request->input('GDMax') ?? 0,
            'Name' => $request->input('Name') ?? "-- Request update name ---",
            'IsVisible' => $request->input('IsVisible') ?? 1,
            'FNAME' => $request->input('FNAME') ?? "-- Request update name ---",
        ]);

        return response()->json(['type' => 'success', 'message' => 'Loot updated succesfully!', 'updated' => $loot], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loot = $this->lootData->find($id);
        if (!$loot) return response()->json(['message' => 'Loot not found!'], 404);

        $loot->delete();

        return response()->json(['message' => 'Loot deleted successfully!'], 200);
    }
}
