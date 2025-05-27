<?php

namespace Database\Seeders;

use App\Models\EventParticipant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EventParticipant::factory()->count(500)->create();
    }
}
