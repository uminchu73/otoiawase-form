<!-- 共通レイアウトのHTML -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <!-- 文字コードやレスポンシブ対応 -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CSRFトークン -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ページタイトル -->
    <title>FashionablyLate</title>

    <!-- 共通CSSの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <!-- フォントの読み込み -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&family=Noto+Serif+JP:wght@900&display=swap" rel="stylesheet">

    <!-- 各ページごとの追加CSS -->
    @yield('css')
</head>

<body>
    <!-- ヘッダー -->
    <header class="header">
        <div class="header__inner">
                <a class="header__logo" href="/">
                FashionablyLate
                </a>

                {{-- ボタン用のセクション --}}
                @yield('header-button')

            </div>
        </div>
    </header>

    <!-- ページごとの中身を表示 -->
    <main>
        @yield('content')

        @yield('script')
    </main>
</body>

</html>
