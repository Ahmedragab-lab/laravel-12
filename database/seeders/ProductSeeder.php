<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate(); // Correct model for products

        $products = [
            [
                'name' => 'Cropped Faux Leather Jacket',
                'description' => 'A stylish cropped faux leather jacket.',
                'price' => 29.00,
                'category_name' => 'Dresses', 
                'brand_name' => 'Adidas',    
            ]
        ];

        foreach ($products as $product) {
        
            $category = Category::where('name', $product['category_name'])->first();
            $brand = Brand::where('name', $product['brand_name'])->first();

            if ($category && $brand) {
                Product::create([
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'slug' => Str::slug($product['name']),
                    'category_id' => $category->id, 
                    'brand_id' => $brand->id,       
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
