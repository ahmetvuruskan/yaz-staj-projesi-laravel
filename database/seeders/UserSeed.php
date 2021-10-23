<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'Ahmet Vuruşkan',
            'email'=>'ahmetfatih0702@gmail.com',
            'password'=>bcrypt('ahmetfatih00'),
            'user_role'=>'admin',

        ]);
    }
}
