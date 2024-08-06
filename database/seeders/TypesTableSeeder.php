<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['title' => 'photo'],
            ['title' => 'video'],
            ['title' => 'text'],
            ['title' => 'quote'],
            ['title' => 'link'],
        ];

        DB::table('types')->insert($types);
    }
}
