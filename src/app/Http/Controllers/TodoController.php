<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Todo;


class TodoController extends Controller
{

    private $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
        // $todoというプロパティにTodoモデルのインスタンスを注入しています。
        // 注入されたTodoモデルは、他のメソッドで使用できるようになります。
    }

    public function create()
    {
        return view('todo.create');
        // 引数指定のルール
    }

    // TodoRequest $request: フォームから送信されたリクエストを受け取ります
    public function store(TodoRequest $request)
    {
        $inputs = $request->all();
        // フォームから送信されたすべての入力データを取得します。
        $this->todo->fill($inputs);
        // 複数のカラムを一度に登録や更新することができます。

        $this->todo->save();
        // データベースに保存している
        return redirect()->route('todo.index');
    }


    public function index()
    {
        $todos = $this->todo->all();
        // データベースから取得したtodoを全て代入している
        return view('todo.index', ['todos' => $todos]);
        // 'todos'は何を指しているか
    }

    public function show($id)
    {
        $todo = $this->todo->find($id);
        // 指定されたIDに対応するToDoレコードを取得
        return view('todo.show', ['todo' => $todo]);
    }


    public function edit($id)
    {
        $todo = $this->todo->find($id);
        // 指定されたIDに対応するToDoレコードを取得
        return view('todo.edit', ['todo' => $todo]);
    }


    public function update(TodoRequest $request, $id)
    {
        $inputs = $request->all();
        // リクエストに含まれるすべての入力データを取得
        $todo = $this->todo->find($id);
        // 指定されたIDに対応するToDoレコードを取得
        $todo->fill($inputs);
        // 配列の値で一括設定します。リクエストから受け取った入力値でToDoモデルの属性を更新します。
        $todo->save();
        // save メソッドは、モデルの変更をデータベースに保存します。
        return redirect()->route('todo.show', $todo->id);
    }

    public function delete($id)
    {
        $todo = $this->todo->find($id);
        $todo->delete();
        return redirect()->route('todo.index');
    }

    public function complete($id)
    {
        $todo = $this->todo->find($id);
        // complete()の引数で受け取った$idをもとに、対象のレコードを1件取得しています
        $todo->is_completed = !$todo->is_completed;
        // $todo->is_completedがtrue（完了状態）であれば、false（未完了状態）になり、
        // false（未完了状態）であれば、true（完了状態）になります。
        $todo->save();
        // save()を用いてUPDATE文を実行してレコードの内容を更新します。
        return response()->json(['is_completed' => $todo->is_completed]);
        // JSON 形式のレスポンスを返しています。
        // 具体的には、is_completed キーには $todo->is_completed の値が含まれます。
        // "is_completed": trueで返される
    }

}

