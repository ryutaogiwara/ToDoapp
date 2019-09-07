<?php
// ミドルウェア経由で処理前に任意のプログラム実装
// ここではAuthを参照してログインしていた場合のみ処理が行われる
route::group(['middleware' => 'auth'], function () {
  // ホーム画面
  Route::get('/', 'HomeController@index')->name('home');

  // フォルダ作成
  Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
  Route::post('/folders/create', 'FolderController@create');

  // タスク作成
  Route::get('folders/{folder}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
  Route::post('folders/{folder}/tasks/create', 'TaskController@create');
  // タスク編集
  Route::get('folders/{folder}/tasks/{task_id}/edit', 'TaskController@showEditForm')->name('tasks.edit');
  Route::post('folders/{folder}/tasks/{task_id}/edit', 'TaskController@edit');
});

route::group(['middleware' => 'can:view,folder'], function () {
  // タスク表示
  Route::get('/folders/{folder}/tasks', 'TaskController@index')->name('tasks.index');
});
// Authファサード
// ログインしていない場合はログインページへリダイレクトされる
Auth::routes();
