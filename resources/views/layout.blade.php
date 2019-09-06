<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ToDo App</title>
  @yield('styles')
  <link rel="stylesheet" href="/public/css/styles.css">
</head>

<body>
  <header>
    <nav class="my-navbar">
      <a class="my-navbar-brand" href="/public/">ToDo App</a>
      <div class="my-navbar-control">
        <!-- ログインしてるかt/fで返す -->
        @if(Auth::check())
        <!-- true処理 -->
        <span class="my-navbar-item">ようこそ, {{ Auth::user()->name }}さん</span>
        |
        <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
        <form id="logut-form" action="{{ route('logout') }}" method="post" style="display: none;">
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
  @yield('scripts')
  <!-- ログアウト処理 -->
  @if(Auth::check())
  <script>
    document.getElementById('logout').addEventListener('click', function(event) {
      event.priventDefault();
      document.getElementById('logout-form').submit();
    });
  </script>
  @endif
</body>

</html>
