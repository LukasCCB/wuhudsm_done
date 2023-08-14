<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsvisibleToItemsGenericTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Items_Generic', function (Blueprint $table) {
            $table->integer('IsVisible')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Items_Generic', function (Blueprint $table) {
            $table->dropColumn('IsVisible');
        });
    }
}
