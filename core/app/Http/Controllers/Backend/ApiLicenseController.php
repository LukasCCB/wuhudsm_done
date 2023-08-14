<?php
/*
 * Copyright (c) 09-09/08/23, 18:59.
 * Created By WebZow Soluções Digitais.
 * Site: https://webzow.com
 * Discord: https://discord.gg/TgCccsKSYu
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PanelSetting;

class ApiLicenseController extends Controller
{
    public function check()
    {
        $settings = PanelSetting::first();

        $ipAddress = $_SERVER['HTTP_HOST']; // If localhost, 127.0.0.1, ::1 is ignored

        $lic = urlencode($settings->hash_lic_key);
        $serverLang = config("locale") ?? "en";

        $api = "https://webzow.com/api/license_software/check.php?key=";
        $mountPath = $api . $lic . '&newIP=' . $ipAddress . '&lang=' . $serverLang;

        $post = file_get_contents($mountPath);
        $getPost = json_decode($post, false);

        return response()->json($getPost);
    }

    public function reqRenew()
    {
        $apiUrl = 'https://webzow.com/api/license_software/renew.php?oldKey=' . urlencode($this->license) . '&newIp=' . urlencode($this->server_ip);
    }
}
