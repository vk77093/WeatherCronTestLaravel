<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CityCodes;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data1=CityCodes::create([
            'cityname' => 'Jalandhar',
            // 'country'=>'India',
            'latitude' =>'31.32',
            'longitude' =>'75.57',
        ]);
        $data2=CityCodes::create([
            'cityname' => 'Ludhaina',
            // 'country'=>'India',
            'latitude' =>'30.90',
            'longitude' =>'75.85',
        ]);
        $data3=CityCodes::create([
            'cityname' => 'Tornoto',
            // 'country'=>'canada',
            'latitude' =>'43.65',
            'longitude' =>'79.38',
        ]);
        $data4=CityCodes::create([
            'cityname' => 'berlin ',
            // 'country'=>'Germany',
            'latitude' =>'52.52',
            'longitude' =>'13.40',
        ]);
    }
}
