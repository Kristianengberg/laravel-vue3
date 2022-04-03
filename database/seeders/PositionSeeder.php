<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::create(["position_name" => "Funktionær"]);
        Position::create(["position_name" => "Timelønnet"]);
    }
}
