<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'settings_description' => 'Başlık',
                'settings_key' => 'title',
                'settings_value' => 'E ticaret',
                'settings_type' => 'text',
                'settings_must' => 0,
                'settings_delete' => '0',
                'settings_status' => '1'
            ],
            [
                'settings_description' => 'Açıklama',
                'settings_key' => 'description',
                'settings_value' => 'E ticaret',
                'settings_type' => 'text',
                'settings_must' => 1,
                'settings_delete' => '0',
                'settings_status' => '1'
            ],[
                'settings_description' => 'Logo',
                'settings_key' => 'logo',
                'settings_value' => 'logo.png',
                'settings_type' => 'file',
                'settings_must' => 2,
                'settings_delete' => '0',
                'settings_status' => '1'
            ],
            [
                'settings_description' => 'Icon',
                'settings_key' => 'icon',
                'settings_value' => 'icon.ico',
                'settings_type' => 'file',
                'settings_must' => 3,
                'settings_delete' => '0',
                'settings_status' => '1'
            ],
            [
                'settings_description' => 'Anahtar Kelimeler',
                'settings_key' => 'keywords',
                'settings_value' => 'Eticaret,trendyol,hepsiburada',
                'settings_type' => 'tag',
                'settings_must' => 4,
                'settings_delete' => '0',
                'settings_status' => '1'
            ],
            [
                'settings_description' => 'Sabit Telefon',
                'settings_key' => 'phone_sabit',
                'settings_value' => '0850 XXX XX XX',
                'settings_type' => 'text',
                'settings_must' => 5,
                'settings_delete' => '0',
                'settings_status' => '1'
            ],
            [
                'settings_description' => 'GSM',
                'settings_key' => 'phone_gsm',
                'settings_value' => '0850 XXX XX XX',
                'settings_type' => 'text',
                'settings_must' => 6,
                'settings_delete' => '0',
                'settings_status' => '1'
            ],
            [
                'settings_description' => 'Mail',
                'settings_key' => 'mail',
                'settings_value' => 'ahmetfatih0702@gmail.com',
                'settings_type' => 'text',
                'settings_must' => 7,
                'settings_delete' => '0',
                'settings_status' => '1'
            ],
            [
                'settings_description' => 'İlçe',
                'settings_key' => 'ilce',
                'settings_value' => 'Alanya',
                'settings_type' => 'text',
                'settings_must' => 8,
                'settings_delete' => '0',
                'settings_status' => '1'
            ],
            [
                'settings_description' => 'il',
                'settings_key' => 'il',
                'settings_value' => 'Antalya',
                'settings_type' => 'text',
                'settings_must' => 9,
                'settings_delete' => '0',
                'settings_status' => '1'
            ],
            [
                'settings_description' => 'Adres',
                'settings_key' => 'adres',
                'settings_value' => 'fidanlık caddesi',
                'settings_type' => 'text',
                'settings_must' => 10,
                'settings_delete' => '0',
                'settings_status' => '1'
            ],
            [
                'settings_description' => 'Kargo',
                'settings_key' => 'shipment',
                'settings_value' => '12',
                'settings_type' => 'text',
                'settings_must' => 11,
                'settings_delete' => '0',
                'settings_status' => '1'
            ]
        ]);
    }
}
