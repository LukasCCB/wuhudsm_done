<?php
/*
 * Copyright (c) 09-09/08/23, 17:36.
 * Created By WebZow Soluções Digitais.
 * Site: https://webzow.com
 * Discord: https://discord.gg/TgCccsKSYu
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTablePanelSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panel_settings', function (Blueprint $table) {
            $table->integer('id')->default('1');
            $table->string('default_language')->default('en');
            $table->string('hash_lic_key')->nullable();
            $table->string('update_available')->nullable()->default('0');
            $table->string('isInstalled')->nullable()->default('0');
            $table->string('isUpdated')->nullable()->default('0');
            $table->string('git_last_commit')->nullable()->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('panel_settings');
    }
}
