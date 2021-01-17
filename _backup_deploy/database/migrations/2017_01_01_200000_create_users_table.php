<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name')->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->boolean('visible')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert(array('user_name' => 'root', 'first_name' => 'root', 'email' => 'root@admin.com', 'password' => Hash::make('root'), 'role_id' => 1));
        DB::table('users')->insert(array('user_name' => 'admin', 'first_name' => 'admin', 'email' => 'admin@admin.com', 'password' => Hash::make('admin'), 'role_id' => 2));
        DB::table('users')->insert(array('user_name' => 'content', 'first_name' => 'content', 'email' => 'content@admin.com', 'password' => Hash::make('content'), 'role_id' => 3));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
