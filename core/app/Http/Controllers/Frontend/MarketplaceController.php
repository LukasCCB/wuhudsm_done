<?php
/*
 * Copyright (c) 08-08/08/23, 19:29.
 * Created By WebZow Soluções Digitais.
 * Site: https://webzow.com
 * Discord: https://discord.gg/TgCccsKSYu
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Backend\ApiMarketplaceController;
use App\Http\Controllers\Controller;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

// Third controllers

class MarketplaceController extends Controller
{
    private $apiMarketplace;

    public function __construct(ApiMarketplaceController $apiMarketplace)
    {
        $this->apiMarketplace = $apiMarketplace;
        $this->apiUrlPath = $this->getApiUrl();
    }

    public function all()
    {
        try {
            $items = $this->apiMarketplace->index()->original;

            // Convert data-info to string
            foreach ($items as $st) {
                $st->IsNew = ($st->IsNew) ? "Yes" : "No";
                $st->PriceP = number_format($st->PriceP, 0, ',', '.');
                $st->GPriceP = number_format($st->GPriceP, 0, ',', '.');
            }

            return view('admin.pages.marketplace.all', compact(
                "items"
            ));
        } catch (Exception $e) {

        }
    }

    public function edit(int $id)
    {
        try {
            $client = new Client();
            $response = $client->get($this->apiUrlPath . '/marketplace/show/' . $id);
            $item1 = json_decode($response->getBody(), false);
            $item = $item1[0]; // Fix

            return view('admin.pages.marketplace.edit', compact('item'));

        } catch (RequestException|GuzzleException|Exception $e) {

            $item = "";
            return view('admin.pages.marketplace.edit', compact('item'));
        }
    }

    // Show items by category
    public function weapons()
    {
        try {
            $items = $this->apiMarketplace->weapons()->original;

            // Convert data-info to string
            foreach ($items as $st) {
                $st->IsNew = ($st->IsNew) ? "Yes" : "No";
                $st->PriceP = number_format($st->PriceP, 0, ',', '.');
                $st->GPriceP = number_format($st->GPriceP, 0, ',', '.');
            }

            return view('admin.pages.marketplace.weapons', compact(
                "items"
            ));
        } catch (Exception $e) {

        }
    }

    public function meeles()
    {
        try {
            $items = $this->apiMarketplace->meeles()->original;

            // Convert data-info to string
            foreach ($items as $st) {
                $st->IsNew = ($st->IsNew) ? "Yes" : "No";
                $st->PriceP = number_format($st->PriceP, 0, ',', '.');
                $st->GPriceP = number_format($st->GPriceP, 0, ',', '.');
            }

            return view('admin.pages.marketplace.meeles', compact(
                "items"
            ));
        } catch (Exception $e) {

        }
    }

    public function medicals()
    {
        try {
            $items = $this->apiMarketplace->medicals()->original;

            // Convert data-info to string
            foreach ($items as $st) {
                $st->IsNew = ($st->IsNew) ? "Yes" : "No";
                $st->PriceP = number_format($st->PriceP, 0, ',', '.');
                $st->GPriceP = number_format($st->GPriceP, 0, ',', '.');
            }

            return view('admin.pages.marketplace.medicals', compact(
                "items"
            ));
        } catch (Exception $e) {

        }
    }

    public function eats()
    {
        try {
            $items = $this->apiMarketplace->eats()->original;

            // Convert data-info to string
            foreach ($items as $st) {
                $st->IsNew = ($st->IsNew) ? "Yes" : "No";
                $st->PriceP = number_format($st->PriceP, 0, ',', '.');
                $st->GPriceP = number_format($st->GPriceP, 0, ',', '.');
            }

            return view('admin.pages.marketplace.eats', compact(
                "items"
            ));
        } catch (Exception $e) {

        }
    }

    public function gears()
    {
        try {
            $items = $this->apiMarketplace->gears()->original;

            // Convert data-info to string
            foreach ($items as $st) {
                $st->IsNew = ($st->IsNew) ? "Yes" : "No";
                $st->PriceP = number_format($st->PriceP, 0, ',', '.');
                $st->GPriceP = number_format($st->GPriceP, 0, ',', '.');
            }

            return view('admin.pages.marketplace.gears', compact(
                "items"
            ));
        } catch (Exception $e) {

        }
    }

    public function attachments()
    {
        try {
            $items = $this->apiMarketplace->attachments()->original;

            // Convert data-info to string
            foreach ($items as $st) {
                $st->IsNew = ($st->IsNew) ? "Yes" : "No";
                $st->PriceP = number_format($st->PriceP, 0, ',', '.');
                $st->GPriceP = number_format($st->GPriceP, 0, ',', '.');
            }

            return view('admin.pages.marketplace.attachments', compact(
                "items"
            ));
        } catch (Exception $e) {

        }
    }

    public function ammo()
    {
        try {
            $items = $this->apiMarketplace->ammo()->original;

            // Convert data-info to string
            foreach ($items as $st) {
                $st->IsNew = ($st->IsNew) ? "Yes" : "No";
                $st->PriceP = number_format($st->PriceP, 0, ',', '.');
                $st->GPriceP = number_format($st->GPriceP, 0, ',', '.');
            }

            return view('admin.pages.marketplace.ammos', compact(
                "items"
            ));
        } catch (Exception $e) {

        }
    }
}
