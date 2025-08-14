<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderVehicleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'driver' => 'required',
            'vehicle' => 'required',
            'vehicle_company' => 'required',
            'start' => 'required',
            'end' => 'required'
        ];
    }
}
