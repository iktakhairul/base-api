<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $seed = [[
                'id' => 1,
                'firstName'      => 'System',
                'lastName'       => 'Admin',
                'fullName'       => 'System Admin',
                'userName'       => 'system_admin',
                'email'          => 'system@admin.com',
                'password'       => bcrypt('789456123'),
                'userDomains'    => 'system,admin,operator,accounts,user',
                'userType'       => 'system',
                'userWeight'     => 99.99,
                'address'        => '32/B, Sukhrabnad, Dhanmondi',
                'zipCode'        => 1209,
                'phone'          => '01683201359',
                'secondaryPhone' => '01683201360',
                'city'           => 'Dhaka',
                'state'          => 'Dhaka',
                'country'        => 'Bangladesh',
                'isActive'       => 1,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],

            [
                'id' => 2,
                'firstName'      => 'General',
                'lastName'       => 'Admin',
                'fullName'       => 'General Admin',
                'userName'       => 'general_admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('789456123'),
                'userDomains'    => 'admin,operator,accounts,user',
                'userType'       => 'admin',
                'userWeight'     => 79.99,
                'address'        => '32/B, Sukhrabnad, Dhanmondi',
                'zipCode'        => 1209,
                'phone'          => '01683201361',
                'secondaryPhone' => '01683201362',
                'city'           => 'Dhaka',
                'state'          => 'Dhaka',
                'country'        => 'Bangladesh',
                'isActive'       => 1,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ];

        User::insert($seed);

        $now = date('Y-m-d H:i:s');
        DB::table('roles')->insert([
            [
                'type'         => 'system',
                'description' => 'role for app\'s system admin user',
                'created_at'   => $now,
                'updated_at'   => $now
            ],
            [
                'type'         => 'admin',
                'description' => 'role for app\'s general admin user',
                'created_at'   => $now,
                'updated_at'   => $now
            ],
            [
                'type'         => 'operator',
                'description' => 'role for app\'s operator user',
                'created_at'   => $now,
                'updated_at'   => $now
            ],
            [
                'type'         => 'accounts',
                'description' => 'role for app\'s accounts user',
                'created_at'   => $now,
                'updated_at'   => $now
            ],
            [
                'type'         => 'support',
                'description' => 'role for app\'s master support user',
                'created_at'   => $now,
                'updated_at'   => $now
            ],
            [
                'type'         => 'developer',
                'description' => 'role for app\'s developer user',
                'created_at'   => $now,
                'updated_at'   => $now
            ],
            [
                'type'         => 'user',
                'description' => 'role for brand basic user',
                'created_at'   => $now,
                'updated_at'   => $now
            ]
        ]);

        DB::table('users_roles')->insert([
            [
                'id'         => 1,
                'userId'     => 1,
                'roleId'     => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id'         => 2,
                'userId'     => 2,
                'roleId'     => 2,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
