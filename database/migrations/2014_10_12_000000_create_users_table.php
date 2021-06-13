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
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('contact_no',14)->nullable();
            $table->string('type')->nullable()->default('user');
            $table->string('domain')->nullable()->default('member');
            $table->string('role')->nullable();
            $table->float('weight',5,2)->nullable()->default('0');
            $table->string('access')->nullable()->default('C_R_E_D');
            $table->boolean('status')->default(true);
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->integer('createdBy')->unsigned()->nullable();
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
