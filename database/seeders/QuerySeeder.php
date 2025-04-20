<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $queries = [
            [

                'title' => 'Поиск по всем ноутам',
                'city' => 'Орел',
                'active' => true,
                'uri' => 'https://www.avito.ru/orlovskaya_oblast/noutbuki?f=ASgCAQECAUDwvA0UiNI0AUXGmgwYeyJmcm9tIjo3MDAwLCJ0byI6MjAwMDB9&s=104',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'title' => 'Поиск по всем ноутам',
                'city' => 'Брянск',
                'active' => true,
                'uri' => 'https://www.avito.ru/bryanskaya_oblast/noutbuki?f=ASgCAQECAUDwvA0UiNI0AUXGmgwYeyJmcm9tIjo3MDAwLCJ0byI6MjAwMDB9&s=104',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('queries')->truncate();

        DB::table('queries')->insert($queries);
    }
}
