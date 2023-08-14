<?php
/*
 * Copyright (c) 05-09/08/23, 19:22.
 * Created By WebZow Soluções Digitais.
 * Site: https://webzow.com
 * Discord: https://discord.gg/TgCccsKSYu
 */


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PanelSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

//use App\Http\Middleware\Settings;

class WebhookController extends Controller
{
    /**
     * POST by Github Webooh
     * * http://localhost/api/v1/github/new
     *
     * @param Request $request
     * @return void
     */
    public function handleGitHubWebhook(Request $request)
    {
        // payload JSON GitHub
        $payload = $request->json()->all();

        // Extrair os valores específicos do payload
        $before = $payload['before'];
        $after = $payload['after'];
        $commit = $payload['commits'][0]['url'];
        $pushed_at = $payload['repository']['pushed_at'];

        // Criar a string a ser salva no arquivo github_update.txt
        $content = "$before,$commit,$after,$pushed_at";

        $filePath = __DIR__ . '/github_update.json';
        $oldFilePath = __DIR__ . '/old_github_update.json';

        // Verificar se o arquivo github_update.json existe
        if (file_exists($filePath)) {
            // Ler o conteúdo do arquivo github_update.json
            $oldContent = file_get_contents($filePath);

            // Salvar o conteúdo atual do github_update.json em old_github_update.json
            file_put_contents($oldFilePath, $oldContent);
        }

        // Salvar a string no arquivo github_update.json
        file_put_contents($filePath, $content);

        $settings = PanelSetting::first();
        $settings->update_available = "1";
        $settings->git_last_commit = $commit;
        $settings->save();

        //return response()->json(['message' => 'New Update Available!'], 200);
    }

    /**
     * Check if have new commit.
     *
     * @param $update
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function verifyUpdate($update)
    {
        $settings = PanelSetting::first();

        // Caminho do arquivo github_update.json
        $filePath = __DIR__ . '/github_update.json';

        // Verificar se o arquivo existe
        if (file_exists($filePath)) {
            // Ler o conteúdo do arquivo
            $content = file_get_contents($filePath);

            // Separar os valores usando a vírgula como delimitador
            $values = explode(',', $content);

            // Atribuir os valores separados a variáveis
            $before = trim($values[0]);
            $after = trim($values[1]);
            $pushed_at = trim($values[2]);
            $pushed_at_human = Carbon::createFromTimestamp($pushed_at)->toDateTimeString();

            // Verificar se o valor de $before é diferente do git anterior
            if ($update !== $before || $settings->isUpdated == 0) {

                $settings->update_available = "1";
                $settings->save();

                // Notify frontend about new update
                return true;
                /*return response()->json([
                    'old' => $before,
                    'new' => $after,
                    'pushed_at' => $pushed_at_human,
                ], 200);*/
            } else {

                $settings->update_available = "0";
                $settings->save();

                return false;
                //return response()->json(['message' => 'No update available at moment!'], 200);
            }
        } else {
            // Arquivo não encontrado
            return response()->json(['message' => 'File github_update.json not found!'], 404);
        }

    }

    /**
     * User has clicked on GitHub notification.
     * Delete the old git registry to hide to notify and wait for a new.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clicked()
    {
        /*$settings = PanelSetting::first();

        $oldFilePath = __DIR__ . '/old_github_update.json';

        if (file_exists($oldFilePath)) {

            if (unlink($oldFilePath)) {

                $settings->update_available = "0";
                $settings->save();

                return response()->json(["success" => "true", "msg" => "File deleted!"]);
            } else {
                return response()->json(["success" => "false", "msg" => "Failed to delete file!"]);
            }
        } else {
            return response()->json(["success" => "false", "msg" => "File not found!"]);
        }

        return response()->json(["success" => "true", "msg" => "File deleted!"]);*/
        return response()->json(["success" => "true", "msg" => "Only developer can update the system."]);
    }

}
