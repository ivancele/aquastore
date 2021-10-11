<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFishRequest;
use App\Http\Requests\UpdateFishRequest;
use App\Models\Aquariums;
use App\Models\Fish;
use Illuminate\Database\QueryException;

class FishController extends Controller
{

    public function index()
    {
        return response()->json([
            'error' => null,
            'message' => 'Here is a list of all the fish we have in the AquaStore',
            'data' => Fish::all(),
        ]);
    }

    public function findByAquarium($aquariumID)
    {
        $Aquarium = Aquariums::find($aquariumID);

        if ($Aquarium) {
            return response()->json([
                'error' => null,
                'message' => 'Here is a list of all fish in the specified aquarium',
                'data' => $Aquarium->fish,
            ]);
        } else {
            return response()->json([
                'error' => 'The specified aquarium does not exist',
                'message' => 'Please pass a valid aquarium ID',
            ]);
        }
    }

    public function create(CreateFishRequest $request)
    {
        $data = $request->validated();

        if (isset($data['common_name']) && $data['common_name'] == 'Goldfish') {
            if (isset($data['aquarium_id'])) {
                $aquarium = Aquariums::findOrFail($data['aquarium_id']);
                if ($aquarium->hasGuppies()) {
                    return response()->json([
                        'error' => 'Guppies!!',
                        'message' => 'You cannot put Goldfish and Guppies together, please select another Aquarium',
                        'available_aquariums' => Aquariums::where('has_water', true)->whereDoesntHave('fish', function (Builder $query) {$query->where('common_name', 'Guppy');})->get(),
                    ]);
                }
            } else {
                //Select a random aquarium that has water and doesn't have Guppies
                $data['aquarium_id'] = Aquariums::where('has_water', true)->whereDoesntHave('fish', function (Builder $query) {$query->where('common_name', 'Guppy');})->inRandomOrder()->first()->id;
            }
        }

        if (isset($data['common_name']) && $data['common_name'] == 'Guppy') {
            if (isset($data['aquarium_id'])) {
                $aquarium = Aquariums::findOrFail($data['aquarium_id']);
                if ($aquarium->hasGoldfish()) {
                    return response()->json([
                        'error' => 'Goldfish!!',
                        'message' => 'You cannot put Guppies and Goldfish together, please select another Aquarium',
                        'available_aquariums' => Aquariums::where('has_water', true)->whereDoesntHave('fish', function (Builder $query) {$query->where('common_name', 'Goldfish');})->get(),
                    ]);
                }
            } else {
                $data['aquarium_id'] = Aquariums::where('has_water', true)->whereDoesntHave('fish', function (Builder $query) {$query->where('common_name', 'Goldfish');})->inRandomOrder()->first()->id;
            }
        }

        //if fish isn't goldgish or guppy and doesn't have aquarium select one now randomly
        if (!isset($data['aquarium_id'])) {
            $data['aquarium_id'] = Aquariums::where('has_water', true)->inRandomOrder()->first()->id;
        }

        try {
            $fish = Fish::create($data);

            return response()->json([
                'error' => null,
                'message' => 'Fish ' . $fish->common_name . ' successfully created',
                'data' => $fish,
            ]);
        } catch (QueryException $exception) {
            return response()->json([
                'error' => 'failure',
                'message' => $exception->getMessage(),
            ]);
        }

    }

    public function update(Fish $fish, UpdateFishRequest $request)
    {
        $data = $request->validated();

        //This will return if the user passed an empty aquarium_id and fish prev had an aquarium_id (this will always be the case as we pick a random one on create)
        if (!$data['aquarium_id'] && $fish->aquarium_id) {
            return response()->json([
                'error' => 'No Aquarium',
                'message' => 'Sorry, the fish needs to be in an aquarium you cannot leave aquarium_id blank',
            ]);
        }

        if (((isset($data['common_name']) && $data['common_name'] == 'Goldfish') || $fish->common_name == 'Goldfish') && $data['aquarium_id']) {
            $aquarium = Aquariums::find($data['aquarium_id']); //Used find instead of find or fail so we can return a custom response without hijacking the default 404, this is unnecessary maybe
            if ($aquarium) {
                if ($aquarium->hasGuppies()) {
                    return response()->json([
                        'error' => 'Guppies!!',
                        'message' => 'You cannot put Goldfish and Guppies together, please select another Aquarium',
                        'available_aquariums' => Aquariums::where('has_water', true)->whereDoesntHave('fish', function (Builder $query) {$query->where('common_name', 'Guppy');})->get(),
                        'hasGuppies' => $aquarium->hasGuppies(),
                    ]);
                }
            } else {
                return response()->json([
                    'error' => 'Aquarium not found',
                    'message' => 'The selected Aquarium was not found',
                ]);
            }
        }

        if (((isset($data['common_name']) && $data['common_name'] == 'Guppy') || $fish->common_name == 'Guppy') && $data['aquarium_id']) {
            $aquarium = Aquariums::find($data['aquarium_id']);

            if ($aquarium) {
                if ($aquarium->hasGoldfish()) {
                    return response()->json([
                        'error' => 'Goldfish!!',
                        'message' => 'You cannot put Guppies and Goldfish together, please select another Aquarium',
                        'available_aquariums' => Aquariums::where('has_water', true)->whereDoesntHave('fish', function (Builder $query) {$query->where('common_name', 'Goldfish');})->get(),
                        'hasGuppies' => $aquarium->hasGoldfish(),
                    ]);
                }
            } else {
                return response()->json([
                    'error' => 'Aquarium not found',
                    'message' => 'The selected Aquarium was not found',
                ]);
            }
        }

        try {
            $fish->update($data);

            return response()->json([
                'error' => null,
                'message' => 'Fish ' . $fish->common_name . ' successfully updated',
                'data' => $fish,
            ]);
        } catch (QueryException $exception) {
            return response()->json([
                'error' => 'failure',
                'message' => $exception->getMessage(),
            ]);
        }
    }
}
