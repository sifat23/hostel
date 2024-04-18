<?php

namespace Database\Seeders;

use App\Models\Hostel;
use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HostelRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Room::count() !== 0) {
            return;
        }

        $getAllHostels = Hostel::all();

        if ($getAllHostels->isNotEmpty()) {
            foreach ($getAllHostels as $hostel) {
                for($i = 1; $i <= 4; $i++) {
                    $range = range(101, 909);
                    $random = collect($range)->shuffle()->slice(0, 1);

                    Room::create([
                        'type' => ($i % 2 === 0) ? 1 : 2,
                        'name' => 'Room ' . $random->pop(),
                        'hostel_id' => $hostel->id,
                        'status' => 1,
                    ]);
                }
            }
        }
    }
}
