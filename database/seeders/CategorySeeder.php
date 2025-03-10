<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();

        $categories = [
            'Dresses',
            'Shorts',
            'Sweatshirts',
            'Swimwear',
            'Jackets',
            'Shirts & Tops',
            'Jeans',
            'Trousers',
            'Men',
            'Jumpers & Cardigans',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
                'image' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
