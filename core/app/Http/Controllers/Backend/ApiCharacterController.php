<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Item\ItemsGear;
use Illuminate\Http\Request;

class ApiCharacterController extends Controller
{
    private $itemsGear;

    public function __construct()
    {
        $this->itemsGear = new ItemsGear();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chars = $this->itemsGear->getAllCharacters();
        return response()->json($chars);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $char = ItemsGear::find($id);
        if (!$char)  return response()->json(['message' => 'Character not found!'], 404);

        return response()->json($char->toArray(), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $char = ItemsGear::find($id);
        if (!$char)  return response()->json(['message' => 'Skilltree not found!'], 404);

        $char->update([
            'Name' => $request->input('Name'),
            'PriceP' => $request->input('PriceP'),
            'GPriceP' => $request->input('GPriceP'),
            'IsNew' => $request->input('IsNew'),
            'Description' => $request->input('Description') ?? "",
            'IsVisible' => $request->input('IsVisible'),
        ]);

        return response()->json(['type' => 'success', 'message' => 'Character updated succesfully!', 'updated' => $char], 200);
    }
}
