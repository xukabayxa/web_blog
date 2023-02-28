<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ProjectStoreRequest extends BaseRequest
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
            'category_id' => 'required',
            'project_vi.title' => 'required',
            'project_vi.des' => 'required',
            'project_vi.short_des' => 'required',
        ];

        $project_en_title = $this->project_en['title'];
        if($project_en_title) {
            $rules['project_en.des']  = 'required';
            $rules['project_en.short_des']  = 'required';
        }

        return $rules;
    }

}
