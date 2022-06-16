<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollectedByToTempDeposites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('temp_deposites', function (Blueprint $table) {
            //
            $table->integer('collected_by')->nullable(false)->after('lo_id');
            $table->integer('collected_date')->nullable(false)->after('collected_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('temp_deposites', function (Blueprint $table) {
            //
            $table->dropColumn('collected_by');
            $table->dropColumn('collected_date');
        });
    }
}
