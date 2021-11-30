<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimedatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animedatas', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('admin_id');
            $table->string('name', 100);
            $table->string('tag', 100);
            $table->string('total', 100);
            $table->string('photo', 225);
            $table->string('date', 100);
            $table->string('total_episode', 100);
            $table->text('story');
            $table->string('type1', 20)->nullable();
            $table->string('type2', 20)->nullable();
            $table->string('type3', 20)->nullable();
            $table->string('type4', 20)->nullable();
            $table->string('type5', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animedatas');
    }
}
