<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fish extends Model
{
    use HasFactory;

    protected $fillable = ['aquarium_id', 'common_name', 'species', 'color', 'fins', 'weight', 'length', 'avg_aquarium_temperature', 'age', 'diet', 'min_aquarium_size', 'info_link'];

    protected $casts = [
        'aquarium_id' => 'integer',
    ];

    public function getAgeAttribute($value){
        //This may be undesired if front end is going to handle filtering for example but why not
        if($value/12 < 1){
            return $value." Months";
        }else if($value/12 == 1){
            return ($value/12)." Year";
        }else{
            return ($value/12)." Years";
        }
    }
}
