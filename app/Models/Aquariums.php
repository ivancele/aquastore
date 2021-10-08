<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aquariums extends Model
{
    use HasFactory;
    protected $fillable = ['glass_type', 'size', 'shape', 'has_water', 'max_capacity'];

    protected $casts = [
        'has_water' => 'boolean',
    ];

    public function fish()
    {
        return $this->hasMany(Fish::class, 'aquarium_id', 'id');
    }
}
