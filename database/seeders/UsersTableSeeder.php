<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'type' => 1,
                'name' => 'Admin User',
                'phone' => '1234567890',
                'photo' => null,
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin_password'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 1,
                'name' => 'Toyota',
                'phone' => '0987654321',
                'photo' => null,
                'email' => 'admin@toyota.com',
                'password' => Hash::make('toyota_password'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more users as needed
        ]);
    }
}
