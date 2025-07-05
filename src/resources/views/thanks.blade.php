{{-- レイアウトファイルの読み込み --}}
@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&family=Noto+Serif+JP:wght@900&display=swap" rel="stylesheet">
@endsection

@section('content')
<div class="thanks">
    <div class="thanks__back">Thank you</div>
    <div class="thanks__message-box">
        <p class="thanks__message">お問い合わせありがとうございました</p>
        <a href="/" class="thanks__btn">HOME</a>
    </div>
</div>
@endsection
