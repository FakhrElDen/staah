<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\Room;
use App\Models\Rate;
use App\Models\PushData;
use Illuminate\Support\Str;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        // Create 2 fake properties
        $properties = Property::factory()->count(2)->create();

        foreach ($properties as $property) {
            // Create 3 rooms per property
            $rooms = Room::factory()->count(3)->create([
                'property_id' => $property->id,
            ]);

            foreach ($rooms as $room) {
                // Create 2 rates per room
                $rates = Rate::factory()->count(2)->create([
                    'room_id' => $room->id,
                ]);

                foreach ($rates as $rate) {
                    // Create a push_data entry for this room+rate
                    $push = PushData::create([
                        'property_id' => $property->id,
                        'room_id'     => $room->id,
                        'rate_id'     => $rate->id,
                        'trackingId'  => Str::uuid(),
                        'version'     => '2',
                    ]);

                    // Create 5 daily push items
                    for ($i = 0; $i < 5; $i++) {
                        $date = now()->addDays($i)->toDateString();

                        $push->items()->create([
                            'from_date'        => $date,
                            'to_date'          => $date,
                            'inventory'        => rand(1, 10),
                            'min_stay'          => rand(1, 3),
                            'max_stay'          => rand(5, 10),
                            'min_stay_through'  => rand(1, 2),
                            'max_stay_through'  => rand(5, 12),
                            'cta'              => rand(0, 1) ? 'Y' : 'N',
                            'ctd'              => rand(0, 1) ? 'Y' : 'N',
                            'stop_sell'         => rand(0, 1) ? 'Y' : 'N',
                            'amount_before_tax'  => [
                                'Rate'       => rand(3000, 6000),
                                'extra_adult' => rand(500, 1000),
                                'extra_child' => rand(300, 700),
                                'obp' => [
                                    'person1' => rand(3000, 4000),
                                    'person2' => rand(4000, 5000),
                                    'person3' => rand(5000, 6000),
                                ]
                            ],
                            'amount_after_tax'  => [
                                'Rate'       => rand(3500, 6500),
                                'extra_adult' => rand(600, 1100),
                                'extra_child' => rand(400, 800),
                                'obp' => [
                                    'person1' => rand(3500, 4500),
                                    'person2' => rand(4500, 5500),
                                    'person3' => rand(5500, 6500),
                                ]
                            ]
                        ]);
                    }
                }
            }
        }
    }
}
