<?php

namespace App\Http\Controllers;
// モデルの読み込み
use App\Folder;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    //   タスク一覧
    //   ＊@param Folder $folder
    //   ＊@return \Illuminate\View\View
    public function index(Folder $folder)
    {
        // ユーザーのフォルダを取得
        $folders = Auth::user()->folders()->get();

        // 選択されたフォルダに紐づくタスクを全て取得する
        $tasks = $folder->tasks()->get();

        // データの入った変数はreturnで返り値を指定しviewに渡される
        // viewの引数は第一引数に読み込むテンプレートファイル名、第二引数に実際に送るデータが書かれている
        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $folder->id,
            'tasks' => $tasks,
        ]);
    }

    // タスク作成フォーム
    //  * @param Folder $folder
    //  * @return \Illuminate\View\View
    public function showCreateForm(Folder $folder)
    {
        return view('tasks/create', [
            'folder_id' => $folder->id,
        ]);
    }

    // タスク作成
    //  * @param Folder $folder
    //  * @param CreateTask $request
    //  * @return \Illuminate\Http\RedirectResponse
    public function create(Folder $folder, CreateTask $request)
    {
        $task = new Task();
        // $taskインスタンスのタイトル/期限に$requestインスタンスの各プロパティを代入
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        // 設定したリレーションを基にフォルダに紐づいたタスクとして保存
        $folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }

    // タスク編集フォーム
    //  * @param Folder $folder
    //  * @param Task $task
    //  * @return \Illuminate\View\View
    public function showEditForm(Folder $folder, Task $task)
    {
        $this->checkRelation($folder, $task);

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }

    // タスク編集
    //  * @param Folder $folder
    //  * @param Task $task
    //  * @param EditTask $request
    //  * @return \Illuminate\Http\RedirectResponse
    public function edit(Folder $folder, Task $task, EditTask $request)
    {
        $this->checkRelation($folder, $task);

        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }

    // フォルダとタスクの関連性があるか調べる
    //  * @param Folder $folder
    //  * @param Task $task
    public function checkRelation(Folder $folder, Task $task)
    {
        if ($folder->id !== $task->folder_id) {
            abort(404);
        }
    }
}
