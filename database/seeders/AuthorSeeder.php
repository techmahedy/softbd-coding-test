<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::truncate();

        $data = [
            [
                'author_name' => 'Nazrul',
            ],
            [
                'author_name' => 'Rabindronath'
            ]
        ];

        foreach ($data as $value) {
            Author::create([
                'author_name' => $value['author_name']
            ]);
        }
    }
}
