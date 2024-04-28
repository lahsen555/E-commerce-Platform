<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Cloths',
            ],
            [
                'name' => 'Sports',
            ],
            [
                'name' => 'Men',
            ]
        ];

        DB::table('categories')->insert($categories);
    }
}
