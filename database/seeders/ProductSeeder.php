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
        Product::truncate();

        $products = [
            [
                'name' => 'Cropped Faux Leather Jacket',
                'description' => 'A stylish cropped faux leather jacket perfect for casual outings.',
                'price' => 29.00,
                'category_name' => 'Jackets', 
                'brand_name' => 'Adidas',
                'images' => [
                    'images/home/demo3/product-1.jpg',
                    'images/home/demo3/product-1-1.jpg'
                ],
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => false
            ],
            [
                'name' => 'Calvin Shorts',
                'description' => 'Comfortable and versatile shorts for everyday wear.',
                'price' => 62.00,
                'category_name' => 'Shorts', 
                'brand_name' => 'Balenciaga',
                'images' => [
                    'images/home/demo3/product-2.jpg',
                    'images/home/demo3/product-2-1.jpg'
                ],
                'is_featured' => false,
                'in_stock' => true,
                'on_sale' => false    
            ],
            [
                'name' => 'Kirby T-Shirt',
                'description' => 'A trendy and soft t-shirt for a casual look.',
                'price' => 62.00,
                'category_name' => 'Shirts & Tops', 
                'brand_name' => 'Burberry',
                'images' => [
                    'images/home/demo3/product-3.jpg',
                    'images/home/demo3/product-3-1.jpg'
                ],
                'is_featured' => false,
                'in_stock' => true,
                'on_sale' => false    
            ],
            [
                'name' => 'Cableknit Shawl',
                'description' => 'Cozy and elegant cableknit shawl for added warmth and style.',
                'price' => 99.00,
                'category_name' => 'Jumpers & Cardigans', 
                'brand_name' => 'Zara',
                'images' => [
                    'images/home/demo3/product-4.jpg',
                    'images/home/demo3/product-4-1.jpg'
                ],
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => true    
            ],
            [
                'name' => 'Colorful Jacket',
                'description' => 'Stylish and vibrant colorful jacket perfect for casual outings.',
                'price' => 29.00,
                'category_name' => 'Dresses',
                'brand_name' => 'Balmain', 
                'images' => [
                    'assets/images/products/product_5.jpg',
                    'assets/images/products/product_5-1.jpg'
                ],
                'is_featured' => false,
                'in_stock' => true,
                'on_sale' => false
            ],
            [
                'name' => 'Shirt In Botanical Cheetah Print',
                'description' => 'Stylish shirt featuring a bold botanical cheetah print design.',
                'price' => 62.00,
                'category_name' => 'Shirts & Tops',
                'brand_name' => 'Zara',
                'images' => [
                    'assets/images/products/product_6.jpg',
                    'assets/images/products/product_6-1.jpg'
                ],
                'is_featured' => false,
                'in_stock' => true,
                'on_sale' => false
            ],
            [
                'name' => 'Cotton Jersey T-Shirt',
                'description' => 'Comfortable and casual cotton jersey T-shirt.',
                'price' => 17.00,
                'category_name' => 'Dresses',
                'brand_name' => 'Adidas',
                'images' => [
                    'assets/images/products/product_7.jpg',
                    'assets/images/products/product_7-1.jpg'
                ],
                'is_featured' => false,
                'in_stock' => true,
                'on_sale' => false
            ],
            [
                'name' => 'Zessi Dresses',
                'description' => 'Elegant and stylish Zessi dress, perfect for special occasions.',
                'price' => 99.00,
                'category_name' => 'Dresses',
                'brand_name' => 'Balmain',
                'images' => [
                    'assets/images/products/product_8.jpg',
                    'assets/images/products/product_8-1.jpg'
                ],
                'is_featured' => false,
                'in_stock' => true,
                'on_sale' => true // Original price is $129, but now it's $99.
            ],
            [
                'name' => 'Cropped Faux Leather Jacketk',
                'description' => 'Trendy cropped faux leather jacket, versatile and fashionable.',
                'price' => 29.00,
                'category_name' => 'Dresses',
                'brand_name' => 'Burberry',
                'images' => [
                    'assets/images/products/product_9.jpg',
                    'assets/images/products/product_9-1.jpg'
                ],
                'is_featured' => false,
                'in_stock' => true,
                'on_sale' => false
            ],

        ];

        foreach ($products as $product) {
            $category = Category::where('name', $product['category_name'])->first();
            $brand = Brand::where('name', $product['brand_name'])->first();

            if ($category && $brand) {
                $productData = [
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'slug' => Str::slug($product['name']),
                    'category_id' => $category->id, 
                    'brand_id' => $brand->id,
                    'images' => json_encode($product['images']),
                    'is_active' => true,
                    'is_featured' => $product['is_featured'],
                    'in_stock' => $product['in_stock'],
                    'on_sale' => $product['on_sale'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                
                Product::create($productData);
            } else {
                // Log if a category or brand wasn't found
                if (!$category) {
                    \Log::warning("Category '{$product['category_name']}' not found for product '{$product['name']}'");
                }
                if (!$brand) {
                    \Log::warning("Brand '{$product['brand_name']}' not found for product '{$product['name']}'");
                }
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}