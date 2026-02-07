<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $passwordDefault = Hash::make('password123');

        User::factory()->create([
            'name' => 'Kasir',
            'email' => 'kasir@example.com',
            'role' => 'kasir',
            'password' => $passwordDefault,
        ]);
        User::factory()->create(
            [
                'name' => 'marketing',
                'email' => 'marketing@example.com',
                'role' => 'marketing',
                'password' => $passwordDefault
            ]
        );
    }
}
