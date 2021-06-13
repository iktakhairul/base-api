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
            'type' => 'system',
            'weight' => 39.99,
            'role' => 'system',
            'domain' => 'system',
            'access' => 'C_R_E_D',
            'status' => true,
            'password' => bcrypt('admin'),
        ],
            [
                'id' => 2,
                'name' => 'Developer Admin',
                'email' => 'admin@developer.com',
                'type' => 'developer',
                'weight' => 34.99,
                'role' => 'developer',
                'domain' => 'system',
                'acl' => 'C_R_E_D',
                'status' => true,
                'password' => bcrypt('admin'),
            ],
            [
                'id' => 3,
                'name' => 'Admin Admin',
                'email' => 'admin@admin.com',
                'type' => 'admin',
                'weight' => 24.99,
                'role' => 'admin',
                'domain' => 'admin',
                'acl' => 'C_R_E_D',
                'status' => true,
                'password' => bcrypt('admin'),
            ],
            [
                'id' => 4,
                'name' => 'Auditor Admin',
                'email' => 'admin@auditor.com',
                'type' => 'auditor',
                'weight' => 32.99,
                'role' => 'auditor',
                'domain' => 'auditor',
                'acl' => 'C_R_E_D',
                'status' => false,
                'password' => bcrypt('admin'),
            ],
            [
                'id' => 5,
                'name' => 'Accountant Admin',
                'email' => 'admin@accountant.com',
                'type' => 'accountant',
                'weight' => 56.99,
                'role' => 'accountant',
                'domain' => 'dashboard',
                'acl' => 'C_R_E_D',
                'status' => true,
                'password' => bcrypt('admin'),
            ],
            [
                'id' => 6,
                'name' => 'Operator Admin',
                'email' => 'admin@operator.com',
                'type' => 'operator',
                'weight' => 56.99,
                'role' => 'operator',
                'domain' => 'dashboard',
                'acl' => 'C_R_E_D',
                'status' => true,
                'password' => bcrypt('admin'),
            ],
            [
                'id' => 7,
                'name' => 'Support Admin',
                'email' => 'admin@support.com',
                'type' => 'support',
                'weight' => 56.99,
                'role' => 'support',
                'domain' => 'support',
                'acl' => 'C_R_E_D',
                'status' => true,
                'password' => bcrypt('admin'),
            ],
            [
                'id' => 8,
                'name' => 'Merchant Admin',
                'email' => 'admin@merchant.com',
                'type' => 'merchant',
                'weight' => 56.99,
                'role' => 'merchant',
                'domain' => 'merchant',
                'acl' => 'C_R_E_D',
                'status' => true,
                'password' => bcrypt('admin'),
            ],
            [
                'id' => 9,
                'name' => 'Member Admin',
                'email' => 'admin@member.com',
                'type' => 'member',
                'weight' => 56.99,
                'role' => 'member',
                'domain' => 'dashboard',
                'acl' => 'C_R_E_D',
                'status' => true,
                'password' => bcrypt('admin'),
            ],
        ];

        User::insert($seed);
    }
}
