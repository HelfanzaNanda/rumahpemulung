<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'fullname'              => 'required',
            'username'              => 'required|unique:client,username',
            'phone'                 => 'required|unique:client,phone_client|numeric',
            'address'               => 'required',
            'email'                 => 'required|unique:client,email_client|email',
            'password'              => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            "photo"                 => 'mimes:jpeg,jpg,png',
            "address_google"        => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required'  => ':attribute tidak boleh kosong',
            'unique'    => ':attribute sudah digunakan',
            'min'       => ':attribute minimal :min karakter',
            'same'      => ':attribute tidak sama dengan :other',
            'email'     => ':attribute tidak valid',
            'numeric'   => ':attribute harus menggunakan angka'
        ];
    }
}
