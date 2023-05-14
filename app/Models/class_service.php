<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class class_service extends Model
{
    
    use HasFactory;

    protected $table = 'class_service';
    protected $fillable =['name'
];
}
