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
    </nav>
  </header>
  <main>
    @yield('content')
  </main>
  @yield('scripts')
</body>

</html>
