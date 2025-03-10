<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        User::truncate();
        $superadmin = User::create([
            'name' => 'Ahmed Ragab',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            // 'phone' => '01021493036',
            // 'type' => 'super_admin',
            // 'image'=> 'no-image.jpg',
            'active'=> 1,
            'username'=>'username',
            'com_code'=>'1',
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ]);
        // $superadmin->addRole('admin');

    }
}
