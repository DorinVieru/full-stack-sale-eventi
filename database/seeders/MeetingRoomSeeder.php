<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\MeetingRoom;

use Faker\Generator as Faker;

class MeetingRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 25; $i++) {
            $meeting_room = new MeetingRoom();
            $meeting_room->name = $faker->words(3, true);
            $meeting_room->description = $faker->text(100);
            $meeting_room->slug = Str::slug($meeting_room->name, '-');
            $meeting_room->num_of_places_available = $faker->numberBetween(0, 5000);

            $meeting_room->save();
        }
    }
}
