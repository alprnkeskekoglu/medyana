<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipmentRequest extends FormRequest
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
            'status' => 'required',
            'clinic_id' => 'required',
            'supply_date' => 'present',
            'stock' => 'required|numeric|gte:1',
            'name' => "required|unique:equipments,name,{$this->equipment},id,deleted_at,NULL",
            'unit_price' => 'required|numeric|gte:0.01',
            'rate' => 'required|numeric|between:0.00,100.0'
        ];
    }
}
