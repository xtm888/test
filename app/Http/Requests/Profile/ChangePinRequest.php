<?php

namespace App\Http\Requests\Profile;

use App\Exceptions\RequestException;
use Illuminate\Foundation\Http\FormRequest;

class ChangePinRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'old_pin' => 'required|digits:6',
            'new_pin' => 'required|confirmed|digits:6'
        ];
    }

    public function messages()
    {
        return [
            'old_pin.required' => 'You didn\'t enter your current PIN!',
            'old_pin.digits' => 'PIN must be 6 digits!',
            'new_pin.digits' => 'PIN must be 6 digits!',
            'new_pin.confirmed' => 'You didn\'t confirm PIN correctly!',
        ];
    }

    public function persist()
    {
        $user = auth()->user();
        if ($user->pin == null) {
            $user->pin = $this->new_pin;
            $user->save();
            session()->flash('success', 'You have successfully changed your PIN!');
        }

        if ($user->pin == $this->old_pin) {
            $user->pin = $this->new_pin;
            $user->save();
            session()->flash('success', 'You have successfully changed your PIN!');
        } else
            throw new RequestException("Old PIN is not valid");

    }
}

