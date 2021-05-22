<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id' => '1',
                'name' => 'Super Admin',
            ],
            [
                'id' => '2',
                'name' => 'Admin Alat Produksi',
            ],
            [
                'id' => '3',
                'name' => 'Admin Perlengkapan',
            ],
            [
                'id' => '4',
                'name' => 'Admin Persewaan Gedung',
            ],
            [
                'id' => '5',
                'name' => 'Admin Kendaraan',
            ],
            [
                'id' => '6',
                'name' => 'User Alat Produksi',
            ],
            [
                'id' => '7',
                'name' => 'User Perlengkapan',
            ],
            [
                'id' => '8',
                'name' => 'User Persewaan Gedung',
            ],
            [
                'id' => '9',
                'name' => 'User Kendaraan',
            ],
        ]);
    }
}
