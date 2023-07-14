<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVendorProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->isVendor();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'about' => 'nullable|max:255',
        ];
    }

    public function messages()
    {
        return [
            'about.max' => 'Description cannot be longer than 255 characters'
        ];
    }

    public function persist()
    {

//        $pofile_bgs = config('vendor.profile_bgs');
//        $bg = $this->profilebg;
//        if ($bg == null) {
//            $bg = array_rand($pofile_bgs);
//        } else {
//            $bg = $pofile_bgs[$bg];
//        }
//        $vendor = $this->user()->vendor;
//        $vendor->about = $this->description;
//        $vendor->profilebg = $bg;
//        $vendor->save();
//
//        session()->flash('success', 'Vendor profile updated successfully');

        $vendor = $this->user()->vendor;
        $vendor->about = $this->about;
        $vendor->save();

        session()->flash('success', 'Market Info Has Been Updated!');


    }
}
