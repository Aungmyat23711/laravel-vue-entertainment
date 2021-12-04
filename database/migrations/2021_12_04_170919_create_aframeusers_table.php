<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAframeusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aframeusers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('password', 100);
            $table->string('email', 100);
            $table->string('useravatar', 225);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aframeusers');
    }
}
