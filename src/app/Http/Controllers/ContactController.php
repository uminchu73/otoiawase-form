<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(Request $request)
    {
        $contact = [
            'name' => $request->input('first_name') . '　' . $request->input('last_name'), // 全角スペースで結合
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
            'tel' => $request->input('tel-1') . $request->input('tel-2') . $request->input('tel-3'),
            'address' => $request->input('address'),
            'building' => $request->input('building'),
            'content_select' => $request->input('content_select'),
            'detail' => $request->input('detail'),
        ];

        // 入力情報をセッションに保存しておく
        $request->flash();

        return view('confirm', compact('contact'));
    }

    public function store(Request $request)
    {
        $contact = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
            'tel' => $request->input('tel'),
            'address' => $request->input('address'),
            'building' => $request->input('building'),
            'content_select' => $request->input('content_select'),
            'detail' => $request->input('detail'),
        ];

        Contact::create($contact);

        return view('thanks');
    }
}
