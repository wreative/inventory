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
                'role_id' => '1'
            ],
            [
                'id' => '2',
                'name' => 'Admin Alat Produksi',
                'username' => 'admin1',
                'password' => Hash::make('admin1'),
                'role_id' => '2'
            ],
            [
                'id' => '3',
                'name' => 'Admin Perlengkapan',
                'username' => 'admin2',
                'password' => Hash::make('admin2'),
                'role_id' => '3'
            ],
            [
                'id' => '4',
                'name' => 'Admin Persewaan Gedung',
                'username' => 'admin3',
                'password' => Hash::make('admin3'),
                'role_id' => '4'
            ],
            [
                'id' => '5',
                'name' => 'Admin Kendaraan',
                'username' => 'admin4',
                'password' => Hash::make('admin4'),
                'role_id' => '5'
            ],
            [
                'id' => '6',
                'name' => 'User Alat Produksi',
                'username' => 'user1',
                'password' => Hash::make('user1'),
                'role_id' => '6'
            ],
            [
                'id' => '7',
                'name' => 'User Perlengkapan',
                'username' => 'user2',
                'password' => Hash::make('user2'),
                'role_id' => '7'
            ],
            [
                'id' => '8',
                'name' => 'User Persewaan Gedung',
                'username' => 'user3',
                'password' => Hash::make('user3'),
                'role_id' => '8'
            ],
            [
                'id' => '9',
                'name' => 'User Kendaraan',
                'username' => 'user4',
                'password' => Hash::make('user4'),
                'role_id' => '9'
            ],
            [
                'id' => '10',
                'name' => 'User Website',
                'username' => 'user5',
                'password' => Hash::make('user5'),
                'role_id' => '10'
            ],
            [
                'id' => '11',
                'name' => 'Admin Website',
                'username' => 'admin5',
                'password' => Hash::make('admin5'),
                'role_id' => '11'
            ],
        ]);
    }
}
