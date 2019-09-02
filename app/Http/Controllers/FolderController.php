<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    // コントローラーメソッドが呼び出されるときに Laravel がリクエストの情報を Request クラスのインスタンス $request に詰めて引数として渡す
    public function create(Request $request)
    {
        // フォルダモデルの新規インスタンスを作成
        $folder = new Folder();
        // $folderインスタンスのタイトルに$requestインスタンスのタイトル入力値を代入
        $folder->title = $request->title;
        // インスタンスの情報をDBに保存
        $folder->save();

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}
