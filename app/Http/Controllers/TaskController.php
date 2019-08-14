<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // モデル内のFolderメソッドから配列でデータを引き出し変数に入れる処理
        // データの入った変数はreturnで返り値を指定しviewに渡される
        // viewの引数は第一引数に読み込むテンプレートファイル名、第二引数に実際に送るデータが書かれている
        $folders = Folder::all();
        return view ('tasks/index',[
            'folders' => $folders,
        ]);
    }
}
