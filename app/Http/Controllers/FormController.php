<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;

class FormController extends Controller
{
    public function index()
    {
        return view('formulir'); 
    }

    public function submitForm(UserRequest $request)
    {
        return back()->with('success', 'Nahh sips data berhasil divalidasi dan ga eror!');
    }
}