@extends('layouts/app')

    @section('css')
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @endsection

    @section('header-button')
        <form action="/logout" class="form" method="post">
            @csrf
            <button class="header__button">Logout</button>
        </form>
    @endsection

@section('content')
    <div class="admin-container">
        {{-- タイトル表示 --}}
        <a class="admin-title">Admin</a>
        {{-- お問い合わせ一覧を検索するフォーム --}}
        <form class="admin-search-form" method="GET" action="/admin">
            {{-- キーワード入力欄 --}}
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">
            {{-- 性別選択 --}}
            <select name="gender">
                <option value="" disabled {{ request('gender') === null ? 'selected' : '' }}>性別</option>
                <option value="" {{ request('gender') === '' ? 'selected' : '' }}>全て</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>

            {{-- お問い合わせの種類選択 --}}
            <select name="category">
                <option value="">お問い合わせの種類</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>

            {{-- 日付選択 --}}
            <input type="date" name="date" value="{{ request('date') }}">

            {{-- 検索ボタン --}}
            <button type="submit" class="btn-search">検索</button>

            {{-- リセットボタン --}}
            <a href="/admin" class="btn-reset">リセット</a>
        </form>

        {{-- エクスポートボタン --}}
        <form method="POST" action="{{ route('admin.export') }}">
            @csrf
            <input type="hidden" name="keyword" value="{{ request('keyword') }}">
            <input type="hidden" name="gender" value="{{ request('gender') }}">
            <input type="hidden" name="category" value="{{ request('category') }}">
            <input type="hidden" name="date" value="{{ request('date') }}">
            <button type="submit" class="btn-export">エクスポート</button>
        </form>
        {{-- ページネーション --}}
            {{ $contacts->links() }}

        <div class="admin-table">
            <table class="admin-table__inner">
                {{-- テーブルのヘッダー --}}
                <thead>
                    <tr class="admin-table__header-row">
                        <th>お名前</th>
                        <th>性別</th>
                        <th>メールアドレス</th>
                        <th>お問い合わせの種類</th>
                        <th></th>
                    </tr>
                </thead>

                {{-- テーブルのデータ --}}
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr class="admin-table__data-row">
                            <td>
                                {{ $contact->last_name }}　{{ $contact->first_name }}
                            </td>
                            <td>
                                @if ($contact->gender == 1)
                                    男性
                                @elseif ($contact->gender == 2)
                                    女性
                                @else
                                    その他
                                @endif
                            </td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->category->content ?? '未設定' }}
                            </td>
                            <td>
                                <a href="#" class="btn-detail" data-id="{{ $contact->id }}">詳細</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- モーダルウィンドウ --}}
    <div id="modal" class="modal" style="display:none;">
        <div class="modal-content">
            <span id="modal-close" class="modal-close">&times;</span>
            <div id="modal-body">
                {{-- 各項目の詳細表示エリア（JSで値をセット） --}}
                <p><strong>お名前：</strong><span id="modal-name"></span></p>
                <p><strong>性別：</strong><span id="modal-gender"></span></p>
                <p><strong>メールアドレス：</strong><span id="modal-email"></span></p>
                <p><strong>電話番号：</strong><span id="modal-tel"></span></p>
                <p><strong>住所：</strong><span id="modal-address"></span></p>
                <p><strong>建物名：</strong><span id="modal-building"></span></p>
                <p><strong>お問い合わせの種類：</strong><span id="modal-category"></span></p>
                <p><strong>お問い合わせ内容：</strong><span id="modal-detail"></span></p>
            </div>
            {{-- 削除用フォーム（詳細を表示中のデータを削除） --}}
            <form id="delete-form" method="POST" style="margin-top:1rem;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">削除</button>
            </form>
        </div>
    </div>


    {{-- モーダル制御スクリプト --}}
    @section('script')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const modal = document.getElementById('modal');
                const closeBtn = document.getElementById('modal-close');
                const deleteForm = document.getElementById('delete-form');

                // 詳細ボタンを全部取得してクリックイベント設定
                document.querySelectorAll('.btn-detail').forEach(button =>{
                    button.addEventListener('click', e => {
                        e.preventDefault();
                        const contactId = button.dataset.id;

                        // Ajaxで詳細データを取得
                        fetch(`/admin/contacts/${contactId}`)
                            .then(response => response.json())
                            .then(data => {
                                // モーダル内にデータセット
                                document.getElementById('modal-name').textContent = data.last_name + '　' + data.first_name;
                                document.getElementById('modal-gender').textContent = (data.gender == 1 ? '男性' : (data.gender == 2 ? '女性' : 'その他'));
                                document.getElementById('modal-email').textContent = data.email;
                                document.getElementById('modal-tel').textContent = data.tel;
                                document.getElementById('modal-address').textContent = data.address;
                                document.getElementById('modal-building').textContent = data.building;
                                document.getElementById('modal-category').textContent = data.category?.content ?? '未設定';
                                document.getElementById('modal-detail').textContent = data.detail;

                                // 削除フォームのアクションセット
                                deleteForm.action = `/admin/contacts/${contactId}`;
                                // モーダル表示
                                modal.style.display = 'flex';
                            })
                            .catch(err => {
                                alert('詳細情報の取得に失敗しました');
                                console.error(err);
                            });
                        });
                    });

                    // モーダル閉じるボタン
                    closeBtn.addEventListener('click', () => {
                        modal.style.display = 'none';
                    });

                    // モーダル背景クリックで閉じる
                    modal.addEventListener('click', e => {
                        if (e.target === modal) {
                            modal.style.display = 'none';
                        }
                    });
                });
        </script>
    @endsection

@endsection
