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
            $table->increments('id');
            $table->string('firstName', '100')->nullable();
            $table->string('lastName', '50')->nullable();
            $table->string('fullName', '160')->nullable();
            $table->string('userName', '100')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('userDomain')->default('user')->nullable();
            $table->string('userType')->default('user')->nullable();
            $table->string('userWeight')->default('9.99')->nullable();
            $table->string('address')->nullable();
            $table->string('zipCode')->nullable();
            $table->string('phone')->nullable();
            $table->string('secondaryPhone')->nullable();
            $table->string('city', '100')->nullable();
            $table->string('state', '100')->nullable();
            $table->string('country', '100')->nullable();
            $table->tinyInteger('isActive')->default(0);
            $table->string('profileImage')->nullable();
            $table->integer('createdBy')->unsigned()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->rememberToken();
            $table->foreign('createdBy')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
