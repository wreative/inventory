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
                'name' => 'Admin Alat Produksi',
                'username' => 'admin1',
                'password' => Hash::make('admin1'),
                'roles' => '2'
            ],
            [
                'id' => '3',
                'name' => 'Admin Perlengkapan',
                'username' => 'admin2',
                'password' => Hash::make('admin2'),
                'roles' => '3'
            ],
            [
                'id' => '4',
                'name' => 'Admin Persewaan Gedung',
                'username' => 'admin3',
                'password' => Hash::make('admin3'),
                'roles' => '4'
            ],
            [
                'id' => '5',
                'name' => 'Admin Kendaraan',
                'username' => 'admin4',
                'password' => Hash::make('admin4'),
                'roles' => '5'
            ],
            [
                'id' => '6',
                'name' => 'User Alat Produksi',
                'username' => 'user1',
                'password' => Hash::make('user1'),
                'roles' => '6'
            ],
            [
                'id' => '7',
                'name' => 'User Perlengkapan',
                'username' => 'user2',
                'password' => Hash::make('user2'),
                'roles' => '7'
            ],
            [
                'id' => '8',
                'name' => 'User Persewaan Gedung',
                'username' => 'user3',
                'password' => Hash::make('user3'),
                'roles' => '8'
            ],
            [
                'id' => '9',
                'name' => 'User Kendaraan',
                'username' => 'user4',
                'password' => Hash::make('user4'),
                'roles' => '9'
            ],
        ]);
    }
}
