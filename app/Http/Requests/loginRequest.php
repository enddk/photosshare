<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class loginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->path() == 'index/signin'){
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
            'name' => 'required|',
            'mail' => 'email|unique:users,email',
            'password' => 'required|min:8',
        ];
    }

    public function messages(){
        return [
            'name.required' => '名前は必ず入力してください。',
            'mail.email' => 'メールを入力してください。',
            'mail.unique' => 'このメールアドレスは使われています。',
            'password.required' => 'パスワードを入力してください。',
            'password.min' => '８文字以上で入力してください。',
        ];
    }
}
