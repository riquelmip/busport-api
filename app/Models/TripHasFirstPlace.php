<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripHasFirstPlace extends Model
{
    use HasFactory;

    protected $table = 'trip_has_first_places';
    protected $fillable = [
        'id_trip',
        'id_first_place'
    ];
}
