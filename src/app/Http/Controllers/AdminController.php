<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// お問い合わせモデル
use App\Models\Contact;
// カテゴリーモデル
use App\Models\Category;
// CSV出力のためのレスポンスクラス
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    //管理画面 表示処理
    public function index(Request $request)
    {
        //カテゴリを関連付けた状態でお問い合わせデータを取得
        //以下のスコープで絞り込み：キーワード、性別、カテゴリ、日付
        $contacts = Contact::with('category')
            ->keyword($request->input('keyword'))
            ->gender($request->input('gender'))
            ->category($request->input('category'))
            ->date($request->input('date'))
            ->paginate(7);//1ページ7件でページネーション

        //カテゴリー一覧を取得（セレクトボックス用）
        $categories = Category::all();
        //admin.blade.php を表示し、取得データを渡す
        return view('admin', compact('contacts', 'categories'));
    }

    //エクスポート処理（CSV出力）
    public function export(Request $request): StreamedResponse
    {
        //フィルターをかけたお問い合わせデータを全件取得（ページネーションなし）
        $contacts = Contact::with('category')
            ->keyword($request->keyword)
            ->gender($request->gender)
            ->category($request->category)
            ->date($request->date)
            ->get();

        //レスポンスヘッダーの設定（CSVとしてダウンロード）
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ];

        //ストリームでCSV出力するコールバック関数
        $callback = function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            // ヘッダー行
            fputcsv($handle, ['名前', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容']);

            //各レコードをCSV行に変換して出力
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

            fclose($handle);//ストリームを閉じる
        };

        return response()->stream($callback, 200, $headers);
    }
}
