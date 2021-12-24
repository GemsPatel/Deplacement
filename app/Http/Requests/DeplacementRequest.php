<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeplacementRequest extends FormRequest
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
            'statut_id' => 'required|array',
            'depart' => 'required|array',
            'depart.*' => 'required|date_format:d-m-Y H:i',
            'arrivee' => 'required|array',
            'arrivee.*' => 'required|date_format:d-m-Y H:i',
        ];
    }
}
