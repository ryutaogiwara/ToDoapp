<?php

use App\Folder;

Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');
// フォルダ作成
Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
Route::post('/folders/create', 'FolderController@create');
// タスク作成
Route::get('folders/{id}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
Route::post('folders/{id}/tasks/create', 'TaskController@create');
