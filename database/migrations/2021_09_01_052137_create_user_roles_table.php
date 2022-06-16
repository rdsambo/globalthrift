<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->Integer('user_id');
            $table->boolean('loan')->comment("1:active,0:deactive")->default(0);
            $table->boolean('banking')->comment("1:active,0:deactive")->default(0);
            $table->boolean('hr')->comment("1:active,0:deactive")->default(0);
            $table->boolean('house_keeping')->comment("1:active,0:deactive")->default(0);
            $table->boolean('reporting')->comment("1:active,0:deactive")->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
}
