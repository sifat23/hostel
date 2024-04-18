<?php

namespace Database\Seeders;

use App\Models\Hostel;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HostelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Hostel::count() !== 0) {
            return;
        }

        $faker = Factory::create();


        for($i = 1; $i <= 10; $i++) {

            $address = $faker->streetAddress;

            Hostel::create([
                'name' => 'Hostel ' . $i,
                'location' => $address,
                'status' => 1,
            ]);
        }
    }
}
