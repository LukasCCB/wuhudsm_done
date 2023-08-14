<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

// Third controllers
use App\Http\Controllers\Backend\ApiCharacterController;

class CharacterController extends Controller
{
    private $apiUsersChars;

    public function __construct(ApiCharacterController $apiUsersChars)
    {
        $this->apiUsersChars = $apiUsersChars;
        $this->apiUrlPath = $this->getApiUrl();
    }

    public function index()
    {
        try {
            $chars = $this->apiUsersChars->index()->original;

            // Convert data-info to string
            foreach ($chars as $st) {
                $st->IsNew = ($st->IsNew) ? "Yes" : "No";
                $st->PriceP = number_format($st->PriceP, 0, ',', '.');
                $st->GPriceP = number_format($st->GPriceP, 0, ',', '.');
            }

            return view('admin.pages.characters.all', compact(
                "chars"
            ));
        } catch (Exception $e) {

        }
    }

    public function edit(int $id)
    {
        try {
            $client = new Client();
            $response = $client->get($this->apiUrlPath.'/characters/show/' . $id);
            $character = json_decode($response->getBody(), false);

            return view('admin.pages.characters.edit', compact('character'));

        } catch (RequestException|GuzzleException|Exception $e) {

            $character = "";
            return view('admin.pages.characters.edit', compact('character'));
        }
    }
}
