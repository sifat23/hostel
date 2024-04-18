<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::where('type', 1)->count() > 0) {
            return;
        }

        User::create([
            'name' => 'Admin',
            'email' => 'test@demo.com',
            'password' => Hash::make('1234567890'),
            'type' => 1,
            'status' => 1,
        ]);
    }
}
