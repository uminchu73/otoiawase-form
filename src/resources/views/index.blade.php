{{-- レイアウトファイルの読み込み --}}
@extends('layouts/app')

    @section('css')
        {{-- index.cssの読み込み --}}
        <link rel="stylesheet" href="{{ asset('css/index.css') }}" />

        <!-- フォントの読み込み -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&family=Noto+Serif+JP:wght@900&display=swap" rel="stylesheet">
    @endsection

@section('content')

{{-- 見出し --}}
    <div class="contact-box">
        <div class="contact-title">
            <a>Contact</a>
        </div>
        {{-- お問い合わせフォーム --}}
        <form class="contact-form" action="/confirm" method="post">
            @csrf
            {{-- 名前の入力欄 --}}
            <div class="contact-form__item">
                <div class="contact-form__item--label-box">
                    <span class="contact-form__item--label">お名前</span>
                    <span class="contact-form__item--label-required">※</span>
                </div>
                <div class="contact-form__item--input-box">
                    {{-- 入力欄 --}}
                    <input type="text" name="first_name" class="contact-form__item--input" value="{{ old('first_name') }}" placeholder="例：山田" />
                    <input type="text" name="last_name" class="contact-form__item--input" value="{{ old('last_name') }}" placeholder="例：太朗" />
                    {{-- エラー表示 --}}
                    <div class="error">
                        @error('first_name')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="error">
                        @error('last_name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            {{-- 性別の入力欄 --}}
            <div class="contact-form__item">
                <div class="contact-form__item--label-box">
                    <span class="contact-form__item--label">性別</span>
                    <span class="contact-form__item--label-required">※</span>
                </div>
                <div class="contact-form__item--input-box">
                    {{-- ラジオボタン --}}
                    <label><input type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}>男性</label>
                    <label><input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>女性</label>
                    <label><input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>その他</label>
                    {{-- エラー表示 --}}
                    <div class="error">
                        @error('gender')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            {{-- メールアドレス入力欄 --}}
            <div class="contact-form__item">
                <div class="contact-form__item--label-box">
                    <span class="contact-form__item--label">メールアドレス</span>
                    <span class="contact-form__item--label-required">※</span>
                </div>
                <div class="contact-form__item--input-box">
                    {{-- 入力欄 --}}
                    <input type="email" name="email" class="contact-form__item--input" value="{{ old('email') }}" placeholder="例：test@example.com" />
                    {{-- エラー表示 --}}
                    <div class="error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            {{-- 電話番号入力欄 --}}
            <div class="contact-form__item">
            <div class="contact-form__item--label-box">
                    <span class="contact-form__item--label">電話番号</span>
                    <span class="contact-form__item--label-required">※</span>
                </div>
                <div class="contact-form__item--input-box">
                    {{-- 入力欄 --}}
                    <input type="tel" name="tel_1" class="contact-form__item--input" value="{{ old('tel_1') }}" placeholder="080" />
                    <span class="contact-form__item--label">-</span>
                    <input type="tel" name="tel_2" class="contact-form__item--input" value="{{ old('tel_2') }}" placeholder="1234" />
                    <span class="contact-form__item--label">-</span>
                    <input type="tel" name="tel_3" class="contact-form__item--input" value="{{ old('tel_3') }}" placeholder="5678" />
                    {{-- エラー表示 --}}
                    <div class="error">
                        @error('tel_1')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="error">
                        @error('tel_2')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="error">
                        @error('tel_3')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            {{-- 住所の入力欄 --}}
            <div class="contact-form__item">
                <div class="contact-form__item--label-box">
                    <span class="contact-form__item--label">住所</span>
                    <span class="contact-form__item--label-required">※</span>
                </div>
                <div class="contact-form__item--input-box">
                    {{-- 入力欄 --}}
                    <input type="text" name="address" class="contact-form__item--input" value="{{ old('address') }}" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" />
                    {{-- エラー表示 --}}
                    <div class="error">
                        @error('address')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            {{-- 建物名の入力欄 --}}
            <div class="contact-form__item">
                <div class="contact-form__item--label-box">
                    <span class="contact-form__item--label">建物名</span>
                </div>
                <div class="contact-form__item--input-box">
                    {{-- 入力欄 --}}
                    <input type="text" name="building" class="contact-form__item--input" value="{{ old('building') }}" placeholder="例：千駄ヶ谷マンション101" />
                </div>
            </div>
            {{-- お問い合わせの種類選択欄 --}}
            <div class="contact-form__item">
                <div class="contact-form__item--label-box">
                    <span class="contact-form__item--label">お問い合わせの種類</span>
                    <span class="contact-form__item--label-required">※</span>
                </div>
                <div class="contact-form__item--input-box">
                    {{-- 選択欄 --}}
                    <select name="content_select" id="" class="contact-form__item--input">
                    <option value="">選択してください</option>
                    </select>
                    {{-- エラー表示 --}}
                    <div class="error">
                        @error('content_select')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            {{-- お問い合わせ内容入力欄 --}}
            <div class="contact-form__item">
                <div class="contact-form__item--label-box">
                    <span class="contact-form__item--label">お問合せ内容</span>
                    <span class="contact-form__item--label-required">※</span>
                </div>
                <div class="contact-form__item--input-box">
                    {{-- 入力欄 --}}
                    <textarea name="detail" class="contact-form__item--textarea" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                    {{-- エラー表示 --}}
                    <div class="error">
                        @error('detail')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            {{-- 送信ボタン --}}
            <div class="contact-form__btn">
                <button class="contact-form__btn-submit" type="submit">確認画面</button>
            </div>
        </form>
    </div>
@endsection