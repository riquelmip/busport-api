<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $table = 'trip';
    protected $fillable = [
        'id_origin_city',
        'id_destination_city',
        'travel_time',
        'departure_time',
        'arrival_time',
        'price',
        'id_class_service',
        'id_ticket',
        'id_passenger_type',
    ];
}
