<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Uppercase;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        // Pastikan ini true agar form tidak diblokir
        return true; 
    }

    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:50', new Uppercase],
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi!',
            'name.min' => 'Nama minimal harus 3 karakter!',
            'name.max' => 'Nama maksimal 50 karakter!',
            
            'email.required' => 'Email tidak boleh kosong!',
            'email.email' => 'Format email harus valid (mengandung @)!',
            
            'password.required' => 'Password tidak boleh kosong!',
            'password.min' => 'Password minimal harus 6 karakter!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!'
        ];
    }
}