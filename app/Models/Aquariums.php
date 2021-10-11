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

    public function hasGuppies(){
        $guppiesCount = Fish::where('aquarium_id', '=', $this->id)->where('common_name', 'Guppy')->count();
        return $guppiesCount > 0 ? true: false;
    }

    public function hasGoldfish(){
        $guppiesCount = Fish::where('aquarium_id', '=', $this->id)->where('common_name', 'Goldfish')->count();
        return $guppiesCount > 0 ? true: false;
    }

}
