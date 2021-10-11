<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateFishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'common_name' => 'required|string',
            'aquarium_id' => 'nullable|numeric', //if null, pick a random aquarium, //REVIEW: in MongoDB for example this might need to change as id is not numeric in MongoDB
            'species' => 'required|string',
            'color' => 'required|string',
            'fins' => 'required|numeric',
            'weight' => 'nullable|numeric',
            'length' => 'nullable|numeric',
            'avg_aquarium_temperature' => 'nullable|numeric',
            'age' => 'nullable|numeric',
            'diet' => 'nullable|string',
            'min_aquarium_size' => 'nullable|numeric',
            'info_link' => 'nullable|url',
        ];
    }

    /**
     * Return validation errors as json response
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $response = [
            'error' => 'failure',
            'message' => 'Bad Request',
            'errors' => $validator->errors(),
        ];

        throw new HttpResponseException(response()->json($response, 400));
    }
}
