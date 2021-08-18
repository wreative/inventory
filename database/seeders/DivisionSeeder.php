<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('division')->insert([
            [
                'id' => '1',
                'name' => 'IT Cyber'
            ],
            [
                'id' => '2',
                'name' => 'Supplier'
            ],
            [
                'id' => '3',
                'name' => 'Aplikator'
            ],
            [
                'id' => '4',
                'name' => 'PON10'
            ],
            [
                'id' => '5',
                'name' => 'Admin'
            ],
            [
                'id' => '6',
                'name' => 'Food'
            ],
            [
                'id' => '7',
                'name' => 'Almaas'
            ]
        ]);
    }
}
