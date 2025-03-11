<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Brand::truncate();
        $brands=[
            [
                'name' => 'Adidas',
                'logo' => 'brands/brand1.png',
            ],
            [
                'name' => 'Balmain',
                'logo' => 'brands/brand2.png',
            ],
            [
                'name' => 'Balenciaga',
                'logo' => 'brands/brand3.jpg',
            ],
            [
                'name' => 'Burberry',
                'logo' => 'brands/brand4.jpg',
            ],
            [
                'name' => 'Kenzo',
                'logo' => 'brands/brand5.jpg',
            ],
            [
                'name' => 'Givenchy',
                'logo' => 'brands/brand6.jpg',
            ],
            [
                'name' => 'Zara',
                'logo' => 'brands/brand7.jpg',
            ],
        ];


        foreach ($brands as $brand) {
            DB::table('brands')->insert([
                'name' => $brand['name'],
                'slug' => Str::slug($brand['name']),
                'logo' => $brand['logo'],
                'is_active' => true,
                'creator' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
