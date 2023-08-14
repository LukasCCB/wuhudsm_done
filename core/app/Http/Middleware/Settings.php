<?php

namespace App\Http\Middleware;

use App\Models\PanelSetting;
use Carbon\Carbon;
use Closure;

class Settings
{
    use \RachidLaasri\LaravelInstaller\Helpers\MigrationsHelper;

    protected $settings;
    public $footer_site_vtxt = ' - v1.5.1-final';

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Carbon::setLocale('en_US');

        $this->settings = PanelSetting::first();
        if ($this->settings) {
            $this->settings->isInstalled = $this->alreadyInstalled();
            $this->settings->isUpdated = $this->alreadyUpdated();
            $this->settings->checkForUpdate = $this->checkForUpdate();

            view()->share('settings', $this->settings);
            view()->share('site_version', $this->footer_site_vtxt);
        }

        return $next($request);
    }

    /**
     * System for check if have new commit on GitHub.
     * Used for notify about new changes to this project.
     *
     * @return bool
     */
    public function checkForUpdate()
    {
        $filePath = __DIR__ . '/Backend/github_update.json';
        $oldFilePath = __DIR__ . '/Backend/old_github_update.json';

        if (file_exists($oldFilePath)) {

            $content = file_get_contents($filePath);
            $oldContent = file_get_contents($oldFilePath);

            $new = explode(',', $content)[0];
            $old = explode(',', $oldContent)[0];
            $commit = explode(',', $content)[1];

            if ($new !== $old) {
                //$this->git_last_commit = $commit ?? "https://github.com/LukasCCB/wuhudsm_final";
                $this->settings->git_last_commit = $commit ?? "https://github.com/LukasCCB/wuhudsm_final";

                $this->settings->update_available = 1;
                $this->settings->save();

                return true;
            }
        }

        return false;
    }

    /**
     * If application is already installed.
     *
     * @return bool
     */
    public function alreadyInstalled()
    {
        return file_exists(storage_path('installed'));
    }

    /**
     * If application is already updated.
     *
     * @return bool
     */
    public function alreadyUpdated()
    {
        $migrations = $this->getMigrations();
        $dbMigrations = $this->getExecutedMigrations();

        // If the count of migrations and dbMigrations is equal,
        // then the update as already been updated.
        if (count($migrations) == count($dbMigrations)) {
            return true;
        }

        // Continue, the app needs an update
        return false;
    }
}
