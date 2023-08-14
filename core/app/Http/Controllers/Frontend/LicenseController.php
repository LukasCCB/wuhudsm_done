<?php
/*
 * Copyright (c) 09-09/08/23, 12:37.
 * Created By WebZow Soluções Digitais.
 * Site: https://webzow.com
 * Discord: https://discord.gg/TgCccsKSYu
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Backend\ApiLicenseController;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Redirect;

class LicenseController extends Controller
{
    private $apiLicense;

    public function __construct(ApiLicenseController $apiLicense)
    {
        $this->apiLicense = $apiLicense;
        $this->apiUrlPath = $this->getApiUrl();
    }

    public function check()
    {
        try {
            $lic = $this->apiLicense->check()->original;

            if ($lic->status !== "valid") return $lic->message; //return Redirect::away("https://webzow.com/");

            return view('admin.pages.panel.license.check', compact(
                "lic"
            ));
        } catch (Exception $e) {
            return Redirect::away("https://webzow.com/");
        }
    }
}
