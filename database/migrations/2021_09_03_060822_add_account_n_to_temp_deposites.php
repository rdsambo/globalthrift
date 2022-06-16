<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccountNToTempDeposites extends Migration
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
            $table->integer('account_no')->nullable(false)->after('id');
            $table->integer('amount_collected')->nullable(false)->after('account_no');
            $table->string('collection_type')->nullable(false)->after('amount_collected');
            $table->integer('deposite_amount')->nullable(false)->after('collection_type');
            $table->string('member_name')->nullable(false)->after('deposite_amount');
            $table->integer('lo_id')->nullable(false)->after('member_name');
            $table->integer('accountmaster_id')->nullable(false)->after('lo_id');
            $table->integer('status')->nullable(false)->after('accountmaster_id');
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
            $table->dropColumn('account_no');
            $table->dropColumn('amount_collected');
            $table->dropColumn('collection_type');
            $table->dropColumn('deposite_amount');
            $table->dropColumn('member_name');
            $table->dropColumn('lo_id');
            $table->dropColumn('accountmaster_id');
            $table->dropColumn('status');
        });
    }
}
