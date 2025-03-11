<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Carbon\Carbon;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('color_product')->truncate();
        DB::table('product_size')->truncate();
        Product::truncate();

        $product_names = [
            "Men's Wash Denim Pant - Ad003 - 7arnf",
            "CUSTOM MADE FASHION SNEAKERS",
            "Cotton Panjabi (Yellow)",
            "China Cotton Fabric Formal Shirt",
            "Karchupi One Piece",
            "Gold Plated Color Beats Locket Pendant",
            "Women's Fashionable Shirt",
            "Kids toys collection1",
            "Plastic Remote Control World Racing",
            "kodomo bath (gentle soft)",
            "Nokshipitha",
            "Teer sugar",
            "Radhuni biryani masala",
            "Shrimp shutki",
            "Pran Tomato Ketchup",
            "Black Seed",
            "Kheshari Dal",
            "Pran Mustard Oil",
            "Maggi Coconut Milk Powder",
            "Ruchi Mixed Fruit Jam",
        ];
        $colors = range(1, 10);
        $sizes = range(1, 5);
        foreach ($product_names as $name) {
            $product = new Product();
            $product->category_id = rand(1, Category::count());
            $product->brand_id = rand(1, Brand::count());
            $product->name = $name;
            $product->creator = 1;
            $product->stock = rand(700, 1000);
            $product->price = rand(200, 600);
            $product->discount = rand(0, 20);
            $product->sku = 'SKU' . rand(500, 5000);
            $product->expiration_date = Carbon::now()->format('Y-m-d');
            $product->image = "products/" . rand(1, 20) . ".jpg";
            $product->description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab, molestias!";
            $product->created_at = Carbon::now();
            $product->slug = Str::slug($product->name) . '-' . $product->id;
            $product->code = 'PRO-' . Carbon::now()->format('Ym') . $product->id;
            $product->save();
            
            $randomColors = array_rand($colors, rand(1, 3));
            foreach ((array)$randomColors as $color) {
                DB::table('color_product')->insert([
                    'color_id' => $colors[$color],
                    'product_id' => $product->id
                ]);
            }
            $randomSizes = array_rand($sizes, rand(1, 3));
            foreach ((array)$randomSizes as $size) {
                DB::table('product_size')->insert([
                    'size_id' => $sizes[$size],
                    'product_id' => $product->id
                ]);
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
