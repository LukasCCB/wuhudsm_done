<?php
/*
 * Copyright (c) 08/08/23, 16:53.
 * Created By WebZow Soluções Digitais.
 * Site: https://webzow.com
 * Discord: https://discord.gg/TgCccsKSYu
 */

namespace App\Http\Controllers\Frontend;
 
use App\Http\Controllers\Backend\ApiLootDataController;
use App\Http\Controllers\Backend\ApiMarketplaceController;
use App\Http\Controllers\Controller;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

// Third controllers

class LootDataController extends Controller
{
    private $apiLootData;
    private $apiMarketplace;

    public function __construct()
    {
        $this->apiMarketplace = new ApiMarketplaceController;
        $this->apiLootData = new ApiLootDataController;
        $this->apiUrlPath = $this->getApiUrl();
    }

    public function all()
    {
        try {
            $loots = $this->apiLootData->index()->original;

            // Convert data-info to string
            /*foreach ($loots as $st) {
                $searchItemNameByItemID = $this->apiMarketplace->show($st->ItemID)->original;
                $st->FNAME = $searchItemNameByItemID[0]["FNAME"];
            }*/

            return view('admin.pages.loot.all', compact(
                "loots"
            ));
        } catch (Exception $e) {

        }
    }

    public function add()
    {
        try {
            $getAllLootID = $this->apiLootData->showAllLootID()->original;
            $getAllItems = $this->apiMarketplace->index()->original;

            return view('admin.pages.loot.add', compact('getAllLootID', 'getAllItems'));

        } catch (RequestException|GuzzleException|Exception $e) {
            return redirect()->route("admin.loot.add");
        }
    }

    public function edit(int $id)
    {
        try {
            $result = $this->apiLootData->show($id)->original;
            $getAllItems = $this->apiMarketplace->index()->original;
            $AllLootID = $this->apiLootData->showAllLootID()->original;

            return view('admin.pages.loot.edit', compact('result', 'AllLootID', 'getAllItems'));

        } catch (RequestException|GuzzleException|Exception $e) {
            return redirect()->route("admin.loot.all");
        }
    }

    public function delete($id)
    {
        try {
            $this->apiLootData->destroy($id)->original;

            return redirect()->route("admin.loot.all");
        } catch (Exception $e) {

        }
    }
}
