<?php

namespace App\Http\Controllers;
// モデルの読み込み
use App\Folder;
use App\Task;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(int $id)
    {
        // モデル内のFolderメソッドから全てのデータを配列で取得
        $folders = Folder::all();

        // 選択されたフォルダを取得する
        $current_folder = Folder::find($id);

        // 選択されたフォルダに紐づくタスクを全て取得する
        $tasks = $current_folder->tasks()->get();

        // データの入った変数はreturnで返り値を指定しviewに渡される
        // viewの引数は第一引数に読み込むテンプレートファイル名、第二引数に実際に送るデータが書かれている
        return view ('tasks/index',[
            'folders' => $folders,
            'current_folder_id' => $id,
            'tasks' => $tasks,
        ]);
    }
}
