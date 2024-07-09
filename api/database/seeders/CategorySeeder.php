<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Appetizers'],
            ['name' => 'Main Courses'],
            ['name' => 'Desserts'],
            ['name' => 'Beverages'],
            ['name' => 'Salads'],
            ['name' => 'Soups'],
            ['name' => 'Snacks'],
            ['name' => 'Breakfast'],
            ['name' => 'Lunch'],
            ['name' => 'Dinner'],
        ];

        DB::table('categories')->insert($categories);
    }
}
