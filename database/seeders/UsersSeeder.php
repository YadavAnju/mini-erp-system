<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'), 
            ]
        );
        $admin->assignRole('admin');

         // Create Salesperson User
        $sales = User::firstOrCreate(
            ['email' => 'salesperson@example.com'],
            [
                'name' => 'Sales User',
                'password' => Hash::make('password'),
            ]
        );
        $sales->assignRole('salesperson');
    }
}
