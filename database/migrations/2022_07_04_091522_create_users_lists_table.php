<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->uniqid();
            $table->string('password');
            $table->string('mobile')->nullable();
            $table->string('login_otp')->nullable();
            $table->integer('user_type')->nullable();
            $table->string('platform_type')->nullable();
            $table->string('platform_id')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('avatar')->nullable();
            $table->string('bank_acc')->nullable();
            $table->string('bank_holder')->nullable();
            $table->string('bank_ifsc')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users_lists');
    }
}
