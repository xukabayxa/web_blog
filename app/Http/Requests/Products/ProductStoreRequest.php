<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends BaseRequest
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
            'name' => 'required|unique:products,name',
            'cate_id' => 'required|exists:categories,id',
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'origin_id' => 'required|exists:origins,id',
            'intro' => 'nullable',
            'short_des' => 'nullable',
            'body' => 'nullable',
            'base_price' => 'nullable|integer',
            'price' => 'required|integer',
            'status' =>'required|in:0,1',
            'image' => 'required|file|mimes:jpg,jpeg,png|max:3000',
            'galleries' => 'required|array|min:1|max:20',
            'galleries.*.image' => 'required|file|mimes:png,jpg,jpeg|max:10000',
            'post_ids' => 'nullable|array|max:5',
            'attributes' => 'nullable|array',
            'videos' => 'nullable|array',
            'url_custom' => [
                Rule::requiredIf($this->use_url_custom == 'true' || $this->use_url_custom == 1),
            ],
        ];

        $url_custom = $this->get('url_custom');
        if($url_custom) {
            $rules['url_custom']  = 'unique:products,url_custom';
        }

        $attributeInput = $this->get('attributes');
        $videoInput = $this->get('videos');

        if(($attributeInput)) {
            foreach ($attributeInput as $key => $attribute) {
                $rules['attributes.'.$key.'.'.'attribute_id']   = 'required';
                $rules['attributes.'.$key.'.'.'value']   = 'required';
            }
        }

        if(($videoInput)) {
            foreach ($videoInput as $key => $video) {
                $rules['videos.'.$key.'.'.'link']   = 'required';
                $rules['videos.'.$key.'.'.'video']   = 'required';
            }
        }

        return $rules;
    }

}
