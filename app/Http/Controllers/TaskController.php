<?php

namespace App\Http\Controllers;
// モデルの読み込み
use App\Folder;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;

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
        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $id,
            'tasks' => $tasks,
        ]);
    }

    public function showCreateForm(int $id)
    {
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }

    // コントローラーメソッドが呼び出されるときに Laravel がリクエストの情報を Request クラスのインスタンス $request に詰めて引数として渡す
    public function create(int $id, CreateTask $request)
    {
        // idを基に紐づいたフォルダを特定
        $current_folder = Folder::find($id);

        // 新しいタスクインスタンス作成
        $task = new Task();
        // $taskインスタンスのタイトル/期限にに$requestインスタンスの各プロパティを代入
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        // 設定したリレーションを基にフォルダに紐づいたタスクとして保存
        $current_folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }

    public function showEditForm(int $id, int $task_id)
    {
        $task = Task::find($task_id);

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }
}
