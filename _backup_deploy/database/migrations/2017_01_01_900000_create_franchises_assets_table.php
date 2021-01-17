<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFranchisesAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franchises_assets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image')->nullable();
            $table->enum('position', array('logo', 'image_top', 'right_one', 'left_one', 'left_two', 'left_three'))->nullable();
            $table->integer('franchise_id')->unsigned()->nullable();
            $table->foreign('franchise_id')->references('id')->on('franchises');
            $table->integer('order')->default(9999)->index();
            $table->boolean('visible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('franchises_assets');
    }
}
