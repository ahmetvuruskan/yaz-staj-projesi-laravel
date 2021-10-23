<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('user_photo')->nullable();
            $table->string('password')->nullable();
            $table->text('user_adress')->nullable();
            $table->string('user_city')->nullable();
            $table->string('user_town')->nullable();
            $table->string('user_phone')->nullable();

            $table->rememberToken();
            $table->enum('user_role', ['admin', 'user', 'staff'])->default('user');

        });
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
