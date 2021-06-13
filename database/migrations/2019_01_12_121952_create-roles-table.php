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
            $table->string('type')->unique();
            $table->text('descriptions')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->integer('createdBy')->unsigned()->nullable();
            $table->foreign('createdBy')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });


        $now = date('Y-m-d H:i:s');
        DB::table('roles')->insert([
            ['type'         => 'system',
             'descriptions' => 'role for system administrator',
             'created_at'   => $now,
             'updated_at'   => $now
            ],
            ['type'         => 'developer',
             'descriptions' => 'role for developer',
             'created_at'   => $now,
             'updated_at'   => $now
            ],
            ['type'         => 'admin',
             'descriptions' => 'role for admin',
             'created_at'   => $now,
             'updated_at'   => $now
            ],
            ['type'         => 'auditor',
             'descriptions' => 'role for auditor',
             'created_at'   => $now,
             'updated_at'   => $now
            ],
            ['type'         => 'accountant',
             'descriptions' => 'role for accountant',
             'created_at'   => $now,
             'updated_at'   => $now
            ],
            ['type'         => 'operator',
             'descriptions' => 'role for operator',
             'created_at'   => $now,
             'updated_at'   => $now
            ],
            ['type'         => 'support',
             'descriptions' => 'role for support team member',
             'created_at'   => $now,
             'updated_at'   => $now
            ],
            ['type'         => 'merchant',
                'descriptions' => 'role for merchant',
                'created_at'   => $now,
                'updated_at'   => $now
            ],
            ['type'         => 'member',
                'descriptions' => 'role for general member',
                'created_at'   => $now,
                'updated_at'   => $now
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
