<?php

// フォルダ作成
Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
Route::post('/folders/create', 'FolderController@create');

// タスク表示
Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');
// タスク作成
Route::get('folders/{id}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
Route::post('folders/{id}/tasks/create', 'TaskController@create');
// タスク編集
Route::get('folders/{id}/tasks/{task_id}/edit', 'TaskController@showEditForm')->name('tasks.edit');
Route::post('folders/{id}/tasks/{task_id}/edit', 'TaskController@edit');

// ホーム画面
Route::get('/', 'HomeController@index')->name('home');

// Authファサード
Auth::routes();
