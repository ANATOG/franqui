<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40);
            $table->string('description', 255);
            $table->timestamps();
        });
        DB::table('roles')->insert(array('name' => 'root', 'description' => 'Root'));
        DB::table('roles')->insert(array('name' => 'admin', 'description' => 'Admin'));
        DB::table('roles')->insert(array('name' => 'content_manager', 'description' => 'Usuario Franquicia'));
        DB::table('roles')->insert(array('name' => 'investor_user', 'description' => 'Investor User'));
        DB::table('roles')->insert(array('name' => 'user', 'description' => 'user'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roles');
    }
}
