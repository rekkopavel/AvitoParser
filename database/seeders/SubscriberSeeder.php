<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscribers = [
            [

                'name' => 'Поиск по всем ноутам',
                'telegram_id' => 'Орел',
                'mail' => 'test@mail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];


        DB::table('subscribers')->truncate();


        DB::table('subscribers')->insert($subscribers);
    }
}
