<?php

namespace App\Http\Requests\Regent;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class RegentStoreRequest extends BaseRequest
{
    /**
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
        $rules = [
            'phone_number' => 'required|numeric',
            'sex' => 'required',

            'regent_vi.full_name' => 'required',
            'regent_vi.role' => 'required',
            'regent_vi.description' => 'required',

        ];

        $regent_en_full_name = $this->regent_en['full_name'];
        $regent_en_experience= @$this->regent_en['experience'] ?? null;
        if($regent_en_full_name || $regent_en_experience) {
            $rules['regent_en.full_name']  = 'required';
            $rules['regent_en.role']  = 'required';
            $rules['regent_en.description']  = 'required';
        }

        return $rules;
    }

}
