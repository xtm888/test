<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class NewConversationRequest extends FormRequest
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
            'username' => 'required|exists:users,username',
            'title' => 'required|max:255',
            'message' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'username.exists' => 'User under that username doesn\'t exists!',
            'title.max' => 'Max 255 char allowed.'
        ];
    }
}
