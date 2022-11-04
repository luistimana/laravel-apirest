<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('files')->insert([
            'name' => "Fichero 1 - iPhone",
            'description' => "Iphone 14 Pro Max",
            'amount' => 50000,
        ]);
        DB::table('files')->insert([
            'name' => "Fichero 2 - Audifonos",
            'description' => "Audifonos Sony",
            'amount' => 100,
        ]);
        DB::table('files')->insert([
            'name' => "Fichero 3 - Laptop",
            'description' => "Laptop Dell",
            'amount' => 2000,
        ]);
        DB::table('files')->insert([
            'name' => "Fichero 4 - Tablet",
            'description' => "Tablet Samsung",
            'amount' => 750,
        ]);
        DB::table('files')->insert([
            'name' => "Fichero 5 - Smartwatch",
            'description' => "Smartwatch Apple",
            'amount' => 2000,
        ]);
    }
}
