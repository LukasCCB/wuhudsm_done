<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

// Third controllers
use App\Http\Controllers\Backend\ApiSkilltreeController;

class SkilltreeController extends Controller
{
    private $apiSkilltree;

    public function __construct(ApiSkilltreeController $apiSkillTree)
    {
        $this->apiSkilltree = $apiSkillTree;
        $this->apiUrlPath = $this->getApiUrl();
    }

    public function index()
    {
        try {

            $skilltree = $this->apiSkilltree->index()->original;

            // Convert data-info to string
            foreach ($skilltree as $st) {
                $st->Lv1 = number_format($st->Lv1, 0, ',', '.');
            }

            return view('admin.pages.skilltree.all', compact(
                "skilltree"
            ));
        } catch (Exception $e) {

        }
    }

    public function edit(int $id)
    {
        try {
            $client = new Client();
            $response = $client->get($this->apiUrlPath.'/skilltree/show/' . $id);
            $skilltree = json_decode($response->getBody(), false);

            return view('admin.pages.skilltree.edit', compact('skilltree'));

        } catch (RequestException|GuzzleException|Exception $e) {

            $skilltree = "";
            return view('admin.pages.skilltree.edit', compact('skilltree'));
        }
    }
}
