<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // ログインユーザーを取得する
        $user = Auth::user();

        // ユーザーに紐づくフォルダを一つ取得
        $folder = $user->folders()->first();

        // $folderがnull、つまりフォルダを持っていない場合はホームページをリクエストする
        if (is_null($folder)) {
            return view('home');
        }

        // フォルダがあればタスク一覧へリダイレクトする
        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}
