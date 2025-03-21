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
            'phone' => '01021493036',
            'type' => 'admin', // Set the type as 'admin'
            'image'=> 'users/mypic.jpg',
            'active'=> 1,
            'username'=>'username',
            'com_code'=>'1',
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ]);
        $superadmin->addRole('admin');
        $user = User::create([
            'name' => 'Omar Ahmed',
            'email' => 'user@user.com',
            'password' => bcrypt('123456'),
            'phone' => '01004517035',
            'type' => 'user', // Set the type as 'admin'
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
