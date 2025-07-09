<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    public function export(Request $request): StreamedResponse
    {
        $contacts = Contact::with('category')
            ->keyword($request->keyword)
            ->gender($request->gender)
            ->category($request->category)
            ->date($request->date)
            ->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ];

        $callback = function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            // ヘッダー行
            fputcsv($handle, ['名前', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容']);

            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->last_name . ' ' . $contact->first_name,
                    $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他'),
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->category->content ?? '未設定',
                    $contact->detail
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
