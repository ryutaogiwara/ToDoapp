<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ToDo App</title>
  @yield('styles')
  <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
</head>

<body>
  <header>
    <nav class="my-navbar">
      <a class="my-navbar-brand" href="{{ route('home') }}">ToDo App</a>
      <div class="my-navbar-control">
        <!-- ログインしてるかt/fで返す -->
        @if(Auth::check())
        <!-- true処理 -->
        <span class="my-navbar-item">ようこそ, {{ Auth::user()->name }}さん</span>
        |
        <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        @else
        <!-- false処理 -->
        <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
        |
        <a class="my-navbar-item" href="{{ route('register') }}">会員登録</a>
        @endif
      </div>
    </nav>
  </header>
  <main>
    @yield('content')
  </main>
  <!-- ログアウト処理 -->
  @if(Auth::check())
  <script>
    document.getElementById('logout').addEventListener('click', function(event) {
      event.preventDefault();
      document.getElementById('logout-form').submit();
    });
  </script>
  @endif
  @yield('scripts')
</body>

</html>
