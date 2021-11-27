<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'name' => 'System Admin',
            'email' => 'admin@system.com',
            'password' => bcrypt('admin'),
            ],

            [
                'id' => 2,
                'name' => 'Developer Admin',
                'email' => 'admin@developer.com',
                'password' => bcrypt('admin'),
            ],
        ];

        User::insert($seed);
    }
}
