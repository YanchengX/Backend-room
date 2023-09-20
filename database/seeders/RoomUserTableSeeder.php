<?php

namespace Database\Seeders;

use App\Models\RoomUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('room_users')->truncate(); //table('msg','room'
        RoomUser::factory(30)->create();
    }
}
