<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassangerType extends Model
{
    use HasFactory;
    protected $table='passenger_type';
    protected $fillable=[
        'name',
    ];
}
