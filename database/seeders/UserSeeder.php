<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'anonymouse',
            'email' => 'animus1@gmail.com',
            'password' => '12345678',
            'created_at' => '2026-08-20 17:49:17',
            'updated_at' => '2026-08-20 17:49:17'
        ]); 
    }
}
