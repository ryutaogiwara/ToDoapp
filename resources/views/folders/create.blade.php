<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ToDo App</title>
  <link rel="stylesheet" href="/public/css/styles.css">
</head>

<body>
  <header>
    <nav class="my-navbar">
      <a class="my-navbar-brand" href="/">ToDo App</a>
    </nav>
  </header>
  <main>
    <div class="container">
      <div class="row">
        <div class="col col-md-ofset-3 col-md-6">
          <nav class="panel panel-default">
            <div class="panel-heading">フォルダを追加する</div>
            <div class="panel-body">
              <form action="{{ route('folders.create') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="title">フォルダ名</label>
                  <input type="text" class="form control" name="title" id="title" />
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-primary">送信</button>
                </div>
              </form>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </main>
</body>

</html>