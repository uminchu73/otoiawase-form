{{-- レイアウトファイルの読み込み --}}
@extends('layouts/app')

    @section('css')
        {{-- index.cssの読み込み --}}
        <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />

        <!-- フォントの読み込み -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&family=Noto+Serif+JP:wght@900&display=swap" rel="stylesheet">
    @endsection

@section('content')

<div class="confirm">
        {{-- 見出し --}}
        <div class="confirm-title">
            <a>confirm</a>
        </div>
        <form action="/thanks" class="form" method="post">
            @csrf
            {{-- テーブル形式で確認内容を表示 --}}
            <div class="confirm-table">
                <table class="confirm-table__inner">
                    {{-- 名前の行 --}}
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">
                            お名前
                        </th>
                        <td class="confirm-table__text">
                            {{-- 表示用 --}}
                            <input type="text" value="{{ $contact['first_name'] }}　{{ $contact['last_name'] }}" readonly />
                            {{-- サーバーに送る用 --}}
                            <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                            <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                        </td>
                    </tr>
                    {{-- 性別の行 --}}
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">
                            性別
                        </th>
                        <td class="confirm-table__text">
                            <input type="text" value="{{ 
                            $contact['gender'] == 1 ? '男性' : (
                            $contact['gender'] == 2 ? '女性' : (
                            $contact['gender'] == 3 ? 'その他' : '')) }}" readonly />
                            <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                        </td>
                    </tr>
                    {{-- メールアドレスの行 --}}
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">
                            メールアドレス
                        </th>
                        <td class="confirm-table__text">
                            <input type="email" value="{{ $contact['email'] }}" readonly />
                            <input type="hidden" name="email" value="{{ $contact['email'] }}">
                        </td>
                    </tr>
                    {{-- 電話番号の行 --}}
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">
                            電話番号
                        </th>
                        <td class="confirm-table__text">
                            <input type="tel" value="{{ $contact['tel'] }}" readonly />
                            <input type="hidden" name="tel" value="{{ $contact['tel'] }}">
                        </td>
                    </tr>
                    {{-- 住所の行 --}}
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">
                            住所
                        </th>
                        <td class="confirm-table__text">
                            <input type="text" value="{{ $contact['address'] }}" readonly />
                            <input type="hidden" name="address" value="{{ $contact['address'] }}">
                        </td>
                    </tr>
                    {{-- 建物名の行 --}}
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">
                            建物名
                        </th>
                        <td class="confirm-table__text">
                            <input type="text" value="{{ $contact['building'] }}" readonly />
                            <input type="hidden" name="building" value="{{ $contact['building'] }}">
                        </td>
                    </tr>
                    {{-- お問い合わせの種類の行 --}}
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">
                            お問い合わせの種類
                        </th>
                        <td class="confirm-table__text">
                            <input type="text" value="{{ $contact['category_id'] }}" readonly />
                            <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                        </td>
                    </tr>
                    {{-- お問い合わせ内容の行 --}}
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">
                            お問い合わせ内容
                        </th>
                        <td class="confirm-table__text">
                            <input type="text" value="{{ $contact['detail'] }}" readonly />
                            <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
                        </td>
                    </tr>
                </table>
            </div>
            {{-- 送信ボタン --}}
            <div class="form-btn">
                <button class="form-btn__submit" type="submit">送信</button>
                <button formaction="/" formmethod="get" class="revise-btn__submit">修正</button>

            </div>
        </form>
    </div>
@endsection