<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::with('category')
            ->keyword($request->input('keyword'))
            ->gender($request->input('gender'))
            ->category($request->input('category'))
            ->date($request->input('date'))
            ->paginate(7);

        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }
}
