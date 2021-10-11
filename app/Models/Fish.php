<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fish extends Model
{
    use HasFactory;

    protected $fillable = ['aquarium_id', 'common_name', 'species', 'color', 'fins', 'weight', 'length', 'avg_aquarium_temperature', 'age', 'diet', 'min_aquarium_size', 'info_link'];
}
