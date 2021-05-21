<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('room')->insert([
            [
                'id' => '1',
                'name' => 'Ruang 1 - Utama 1',
            ],
            [
                'id' => '2',
                'name' => 'Ruang 2 - Utama 2',
            ],
            [
                'id' => '3',
                'name' => 'Ruang 3 - Aplikator',
            ],
            [
                'id' => '4',
                'name' => 'Ruang 4 - IT',
            ],
            [
                'id' => '5',
                'name' => 'Ruang 5 - Supplier',
            ],
            [
                'id' => '6',
                'name' => 'Ruang 6 - Admin',
            ],
            [
                'id' => '7',
                'name' => 'Ruang 7 - Almaas',
            ],
            [
                'id' => '8',
                'name' => 'Ruang 8 - Utama 3',
            ],
            [
                'id' => '9',
                'name' => 'Ruang 9 - Produksi',
            ],
            [
                'id' => '10',
                'name' => 'Ruang 10 - Kenjeran',
            ],
            [
                'id' => '11',
                'name' => 'Ruang 11 - Merr',
            ],
        ]);
    }
}
