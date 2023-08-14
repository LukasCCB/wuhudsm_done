<?php
/*
 * Copyright (c) 09-09/08/23, 17:38.
 * Created By WebZow Soluções Digitais.
 * Site: https://webzow.com
 * Discord: https://discord.gg/TgCccsKSYu
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColunnsDataSkillPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('DataSkillPrice', function (Blueprint $table) {
            $table->string('Category')->nullable();
            $table->string('Name')->nullable();
            $table->string('Description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('DataSkillPrice', function (Blueprint $table) {
            $table->dropColumn('Category');
            $table->dropColumn('Name');
            $table->dropColumn('Description');
        });
    }
}
