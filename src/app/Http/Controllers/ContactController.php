<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(Request $request)
    {
        $contact = [
            'name' => $request->input('first-name') . '　' . $request->input('last-name'), // 全角スペースで結合
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
            'tel' => $request->input('tel-1') . $request->input('tel-2') . $request->input('tel-3'),
            'address' => $request->input('address'),
            'bldg' => $request->input('bldg'),
            'content-select' => $request->input('content-select'),
            'content' => $request->input('content'),
        ];

        return view('confirm', compact('contact'));
    }
}
