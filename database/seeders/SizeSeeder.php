<?php

namespace Database\Seeders;


use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Size::truncate();
        // size
        $data = [
           [
               'name' => strtolower('XS'),
               'creator' => 1,
               'slug' => str::slug(strtolower('XS')),
               'created_at' => Carbon::now()->toDateTimeString()
           ],
           [
               'name' => strtolower('S'),
               'creator' => 1,
               'slug' => str::slug(strtolower('s')),
               'created_at' => Carbon::now()->toDateTimeString()
           ],
           [
               'name' => strtolower('M'),
               'creator' => 1,
               'slug' => str::slug(strtolower('m')),
               'created_at' => Carbon::now()->toDateTimeString()
           ],
           [
               'name' => strtolower('L'),
               'creator' => 1,
               'slug' => str::slug(strtolower('l')),
               'created_at' => Carbon::now()->toDateTimeString()
           ],
           [
               'name' => strtolower('XL'),
               'creator' => 1,
               'slug' => str::slug(strtolower('XL')),
               'created_at' => Carbon::now()->toDateTimeString()
           ],
           [
               'name' => strtolower('XXL'),
               'creator' => 1,
               'slug' => str::slug(strtolower('XXL')),
               'created_at' => Carbon::now()->toDateTimeString()
           ],
           [
               'name' => strtolower('XXXL'),
               'creator' => 1,
               'slug' => str::slug(strtolower('XXXL')),
               'created_at' => Carbon::now()->toDateTimeString()
           ],

       ];
       Size::insert($data);
    }
}
