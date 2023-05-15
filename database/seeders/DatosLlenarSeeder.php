<?php

namespace Database\Seeders;

use App\Models\class_service;
use App\Models\Country;
use App\Models\PassangerType;
use App\Models\TicketType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatosLlenarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //CREAT TICKETS
        $tikets = [
            [
                'name' => 'Ida'
            ],
            [
                'name' => 'Vuelta'
            ],
            [
                'name' => 'Ida-Vuelta'
            ]
        ];

        foreach ($tikets as $t) {
            TicketType::create(['name' => $t['name']]);
        }


        //PASSENGER TYPE
        $passenger = [
            [
                'name' => 'Adultos'
            ],
            [
                'name' => 'Niños'
            ],
        ];

        foreach ($passenger as $t) {
            PassangerType::create(['name' => $t['name']]);
        }

        //CLASS SERVICE
        $class = [
            [
                'name' => 'Regular'
            ],
            [
                'name' => 'Turismo'
            ],
            [
                'name' => 'Primera Clase'
            ],
        ];

        foreach ($class as $t) {
            class_service::create(['name' => $t['name']]);
        }

        //Country
        $countries = [
            ['name' => 'Argentina'],
            ['name' => 'Brasil'],
            ['name' => 'Chile'],
            ['name' => 'Colombia'],
            ['name' => 'Ecuador'],
            ['name' => 'España'],
            ['name' => 'Estados Unidos'],
            ['name' => 'Francia'],
            ['name' => 'Italia'],
            ['name' => 'México'],
            ['name' => 'Perú'],
            ['name' => 'Uruguay']
        ];

        foreach ($countries as $t) {
            Country::create(['name' => $t['name']]);
        }
    }
}
