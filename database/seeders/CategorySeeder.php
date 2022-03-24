<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        $data = [
            [
                'category_name' => 'Comics',
            ],
            [
                'category_name' => 'History'
            ]
        ];

        foreach ($data as $value) {
            Category::create([
                'category_name' => $value['category_name']
            ]);
        }
    }
}
