<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => '1',
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'password' => Hash::make('superadmin'),
                'roles' => '1'
            ],
            [
                'id' => '2',
                'name' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'roles' => '2'
            ],
            [
                'id' => '3',
                'name' => 'User',
                'username' => 'user',
                'password' => Hash::make('user'),
                'roles' => '6'
            ]
        ]);
    }
}
