<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\class_service;
use App\Models\Country;
use App\Models\FirstPlaceTypeModel;
use App\Models\PassangerType;
use App\Models\TicketType;
use App\Models\TripHasFirstPlace;
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
            ['name' => 'El Salvador'],
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

       
        $cities = [
            ['name' => 'San Vicente'],
            ['name' => 'Ahuachapan'],
            ['name' => 'Santa Ana'],
            ['name' => 'La Union'],
            ['name' => 'San Miguel'],
            ['name' => 'Chalatenango'],
            ['name' => 'Ilobasco'],
            ['name' => 'Apastepeque'],
            ['name' => 'Cojutepeque'],
            ['name' => 'Usulutan'],
            ['name' => 'Morazan'],
            ['name' => 'San Est Catarina']
        ];

        foreach ($cities as $t) {
            City::create(['name' => $t['name'], 'id_country' => 1]);
        }

       
        $first_places_types = [
            [
                'name' => 'Hotel'
            ],
            [
                'name' => 'Restaurante'
            ],
            [
                'name' => 'Gasolinera'
            ],
        ];

        foreach ($first_places_types as $t) {
            FirstPlaceTypeModel::create(['name' => $t['name']]);
        }

        
        $first_places = [
            [
                'name' => 'Hotel Ven Acá', 'id_first_place_type' => 1
            ],
            [
                'name' => 'Restaurante Amanecer', 'id_first_place_type' => 2
            ],
            [
                'name' => 'Gasolinera Texaco San Vicente', 'id_first_place_type' => 3
            ],
        ];

        foreach ($first_places_types as $t) {
            TripHasFirstPlace::create(['name' => $t['name'], 'id_first_place_type' =>$t['id_first_place_type'] ]);
        }
    }
}
