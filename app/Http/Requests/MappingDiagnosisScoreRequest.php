<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MappingDiagnosisScoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(auth()->user()->role == 'admin') return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'result_desc'=> ['required'],
            'min_score' => ['required'],
            'max_score' =>['required']
        ];
    }
}
