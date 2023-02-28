<?php

namespace App\Http\Requests\Business;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class BusinessStoreRequest extends BaseRequest
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
            'business_vi.title' => 'required',
            'image' => 'required|file|mimes:jpg,jpeg,png|max:3000',
        ];

        $project_en_title = $this->business_en['title'];
        if($project_en_title) {
            $rules['business_en.title']  = 'required';
        }

        return $rules;
    }

}
