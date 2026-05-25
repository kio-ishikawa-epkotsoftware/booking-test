<!doctype html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>予約テスト</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <!-- ナビゲーションバー -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="{{ auth()->check() ? route('dashboard') : route('login') }}">
        テスト作成
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav ms-auto">
          @auth
            {{-- ダッシュボード --}}
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('dashboard') }}">
                ダッシュボード
              </a>
            </li>

            {{-- 予約登録 --}}
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('booking.register') }}">
                予約登録
              </a>
            </li>

            {{-- 予約一覧 --}}
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('booking.index') }}">
                予約一覧
              </a>
            </li>

            {{-- 管理者のみ「ユーザー管理」--}}
            @if(auth()->user()->is_admin)
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">管理メニュー</a>
            </li>
            @endif


            {{-- ログアウト --}}
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('logout') }}">
                ログアウト
              </a>
            </li>
          @else
            {{-- 未ログイン時 --}}
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('login') }}">
                ログイン
              </a>
            </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>

  <!-- メインコンテンツ -->
  <main class="container py-5">
    @yield('content')
  </main>

  <!-- フッター -->
  <footer class="bg-white border-top mt-auto py-3 text-center small text-muted">
    © 2026 試作
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>