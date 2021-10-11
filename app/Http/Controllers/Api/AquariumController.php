<?php

namespace App\Http\Controllers\Api;

use App\Models\Aquariums;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AquariumController extends Controller
{
    public function index()
    {
        return response()->json([
            'error' => null,
            'message' => 'All aquariums found in the AquaStore',
            'data' => Aquariums::withCount('fish')->get(), //Also show how many fish are in each aquarium for convinience sake maybe
        ]);
    }
}
