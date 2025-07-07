<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;


class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'name' => $request->input('first_name') . '　' . $request->input('last_name'), // 全角スペースで結合
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
            'tel' => $request->input('tel_1') . $request->input('tel_2') . $request->input('tel_3'),
            'address' => $request->input('address'),
            'building' => $request->input('building'),
            'category_id' => $request->input('category_id'),
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
            'category_id' => $request->input('category_id'),
            'detail' => $request->input('detail'),
        ];

        Contact::create($contact);

        return view('thanks');
    }
}
