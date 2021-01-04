<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
       if($this->path() == 'index/add'){
           return true;
       } else {
           return false;
       }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'image' => 'file|required',
           'title' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'image.file' => '画像を選択してください。',
            'image.required' => '画像を選択してください。',
            'title.required' => 'タイトルは必ず入力してください。',
        ];
    }
}
