<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'español', 
        'ingles',
    ];
}
