<?php

namespace Database\Seeders;

use App\Models\Color;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Color::truncate();

        $data = [
            [
                'name' => strtolower('red'),
                'creator' => 1,
                'slug' => Str::slug('red'),
                'color_code' => '#FF0000',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('sayan'),
                'creator' => 1,
                'slug' => Str::slug('sayan'),
                'color_code' => '#0FF0FF',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('pink'),
                'creator' => 1,
                'slug' => Str::slug('pink'),
                'color_code' => '#FFC0CB',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('green'),
                'creator' => 1,
                'slug' => Str::slug('green'),
                'color_code' => '#008000',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('skyblue'),
                'creator' => 1,
                'slug' => Str::slug('skyblue'),
                'color_code' => '#87CEEB',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('gray'),
                'creator' => 1,
                'slug' => Str::slug('gray'),
                'color_code' => '#808080',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('white'),
                'creator' => 1,
                'slug' => Str::slug('white'),
                'color_code' => '#FFFFFF',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('black'),
                'creator' => 1,
                'slug' => Str::slug('black'),
                'color_code' => '#000000',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('yellow'),
                'creator' => 1,
                'slug' => Str::slug('yellow'),
                'color_code' => '#FFFF00',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
        ];

        Color::insert($data);
    }
}
