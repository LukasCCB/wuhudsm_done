<?php
/*
 * Copyright (c) 08-08/08/23, 19:02.
 * Created By WebZow Soluções Digitais.
 * Site: https://webzow.com
 * Discord: https://discord.gg/TgCccsKSYu
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Item\AllItems;
use App\Models\Item\ItemsAttachments;
use App\Models\Item\ItemsGear;
use App\Models\Item\ItemsWeapons;
use Illuminate\Http\Request;

class ApiMarketplaceController extends Controller
{
    private $AllItems;
    private $itemsWeapons;
    private $itemsGear;
    private $attachments;

    public function __construct()
    {
        $this->itemsWeapons = new ItemsWeapons();
        $this->AllItems = new AllItems();
        $this->itemsGear = new ItemsGear();
        $this->attachments = new ItemsAttachments();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allItems = $this->AllItems->getAllItems();
        return response()->json($allItems);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $allItems = $this->AllItems->SearchItem($id);

        if ($allItems->isEmpty()) {
            return response()->json(['message' => 'Item not found!'], 404);
        }

        return response()->json($allItems, 200); // FIX: Removed return ->toArray()
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
        $item = $this->AllItems->SearchItem2($id);

        if (!$item->attachments && !$item->gear && !$item->generic && !$item->weapons) {
            return response()->json(['message' => 'Item not found!'], 404);
        }

        if ($item->attachments) {
            $item->attachments->update([
                'Name' => $request->input('Name'),
                'PriceP' => $request->input('PriceP'),
                'GPriceP' => $request->input('GPriceP'),
                'IsNew' => $request->input('IsNew'),
                'Description' => $request->input('Description') ?? "",
                'IsVisible' => $request->input('IsVisible'),
            ]);
        }

        if ($item->gear) {
            $item->gear->update([
                'Name' => $request->input('Name'),
                'PriceP' => $request->input('PriceP'),
                'GPriceP' => $request->input('GPriceP'),
                'IsNew' => $request->input('IsNew'),
                'Description' => $request->input('Description') ?? "",
                'IsVisible' => $request->input('IsVisible'),
            ]);
        }

        if ($item->generic) {
            $item->generic->update([
                'Name' => $request->input('Name'),
                'PriceP' => $request->input('PriceP'),
                'GPriceP' => $request->input('GPriceP'),
                'IsNew' => $request->input('IsNew'),
                'Description' => $request->input('Description') ?? "",
                'IsVisible' => $request->input('IsVisible'),
            ]);
        }

        if ($item->weapons) {
            $item->weapons->update([
                'Name' => $request->input('Name'),
                'PriceP' => $request->input('PriceP'),
                'GPriceP' => $request->input('GPriceP'),
                'IsNew' => $request->input('IsNew'),
                'Description' => $request->input('Description') ?? "",
                'IsVisible' => $request->input('IsVisible'),
            ]);
        }

        return response()->json(['type' => 'success', 'message' => 'Item updated successfully!', 'updated' => $item], 200);
    }

    // Display by Category items
    public function weapons()
    {
        $result = $this->itemsWeapons->getWeapons();
        return response()->json($result);
    }

    public function meeles()
    {
        $result = $this->itemsWeapons->getMeeles();
        return response()->json($result);
    }

    public function medicals()
    {
        $result = $this->itemsWeapons->getMedicals();
        return response()->json($result);
    }

    public function eats()
    {
        $result = $this->itemsWeapons->getFoodsWaters();
        return response()->json($result);
    }

    public function gears()
    {
        $result = $this->itemsGear->getGears();
        return response()->json($result);
    }

    public function attachments()
    {
        $result = $this->attachments->getAttachments();
        return response()->json($result);
    }

    public function ammo()
    {
        $result = $this->attachments->getAmmos();
        return response()->json($result);
    }

}
