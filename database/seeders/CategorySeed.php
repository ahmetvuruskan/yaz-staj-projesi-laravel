<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'category_name'=>'Kıyafet'
            ],
             [
                'category_name'=>'Elektronik'
            ],
             [
                'category_name'=>'Ev&Yaşam'
            ],
             [
                'category_name'=>'Evcil Hayvan'
            ],
             [
                'category_name'=>'Araba'
            ],
        ]);
    }
}
