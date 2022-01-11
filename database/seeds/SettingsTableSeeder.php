<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(
            [
                [
                    'settings_description' => 'Basliq',
                    'settings_key' => 'title',
                    'settings_value' => 'Laravel CMS Learning',
                    'settings_type' => 'text',
                    'settings_must' => 1,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ],
                [
                    'settings_description' => 'Aciqlama',
                    'settings_key' => 'Description',
                    'settings_value' => 'Laravel CMS Learning Desc',
                    'settings_type' => 'text',
                    'settings_must' => 2,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ],
                [
                    'settings_description' => 'Logo',
                    'settings_key' => 'logo',
                    'settings_value' => 'logo.png',
                    'settings_type' => 'file',
                    'settings_must' => 3,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ],
                [
                    'settings_description' => 'Icon',
                    'settings_key' => 'icon',
                    'settings_value' => 'icon.ico',
                    'settings_type' => 'file',
                    'settings_must' => 4,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ],
                [
                    'settings_description' => 'Keywords',
                    'settings_key' => 'keywords',
                    'settings_value' => 'Laravel, CMS',
                    'settings_type' => 'text',
                    'settings_must' => 5,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ],
                [
                    'settings_description' => 'Telefon',
                    'settings_key' => 'phone_sabit',
                    'settings_value' => '0850 XXX XX XX',
                    'settings_type' => 'text',
                    'settings_must' => 6,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ],
                [
                    'settings_description' => 'Telefon GSM',
                    'settings_key' => 'phone_gsm',
                    'settings_value' => '0850 XXX XX XX',
                    'settings_type' => 'text',
                    'settings_must' => 7,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ],
                [
                    'settings_description' => 'Mail',
                    'settings_key' => 'mail',
                    'settings_value' => 'info@gmail.com',
                    'settings_type' => 'text',
                    'settings_must' => 8,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ],
                [
                    'settings_description' => 'Ilce',
                    'settings_key' => 'ilce',
                    'settings_value' => 'Topkapi',
                    'settings_type' => 'text',
                    'settings_must' => 9,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ],
                [
                    'settings_description' => 'Il',
                    'settings_key' => 'il',
                    'settings_value' => 'Istanbul',
                    'settings_type' => 'text',
                    'settings_must' => 10,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ],
                [
                    'settings_description' => 'Address',
                    'settings_key' => 'address',
                    'settings_value' => 'Rasulzade, Ilham Haciyev 39-A',
                    'settings_type' => 'text',
                    'settings_must' => 11,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ]
            ]
        );
    }
}
