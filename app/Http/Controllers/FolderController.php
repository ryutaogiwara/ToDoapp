<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFolder;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    // コントローラーメソッドが呼び出されるときに Laravel がリクエストの情報を Request クラスのインスタンス $request に詰めて引数として渡す
    public function create(CreateFolder $request)
    {
        // フォルダモデルの新規インスタンスを作成
        $folder = new Folder();
        // $folderインスタンスのタイトルに$requestインスタンスのタイトル入力値を代入
        $folder->title = $request->title;

        // ユーザーに紐づけて保存
        Auth::user()->folders()->save($folder);

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}
