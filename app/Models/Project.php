<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $fillable = [
        'name', 
        'description',
        'url',
        'code',
        'showVideo',
        'explanationVideo',
        'video',
        'active',
        'technologies'
    ];

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}
