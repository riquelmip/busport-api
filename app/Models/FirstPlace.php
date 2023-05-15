<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirstPlace extends Model
{
    use HasFactory;

    protected $table = 'first_place';
    protected $fillable = [
        'name',
        'id_first_place_type'
    ];
}
