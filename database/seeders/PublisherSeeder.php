<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Publisher::truncate();

        $data = [
            [
                'publisher_name' => 'Lorem',
            ],
            [
                'publisher_name' => 'Ipsum'
            ]
        ];

        foreach ($data as $value) {
            Publisher::create([
                'publisher_name' => $value['publisher_name']
            ]);
        }
    }
}
