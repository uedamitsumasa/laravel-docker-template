@extends('layouts.base')
{{-- 親のファイルの継承 --}}
@section('content')
{{-- @yield部分に召喚されるトンネルの入り口 --}}
<div class="row justify-content-center">
  <div class="col-md-8">
    <p class="text-left">
      <a class="btn btn-success" href="/todo/create">ToDoを追加</a>
    </p>
    <div class="card">
      <div class="card-header">
        ToDo一覧
      </div>
      <div class="list-group list-group-flush">
      @foreach ($todos as $todo)
      <div class="d-flex">
        <form action="{{ route('todo.complete', $todo->id) }}" class="px-3 my-auto todo-status-form">
          <input type="checkbox" class="form-control todo-status-button" name="id" value={{ $todo->content }} @if ($todo->is_completed) checked @endif>
          {{-- checkedはチェックされた状態を表す属性 --}}
          {{-- $todo->is_completed は ToDo アイテムが完了しているかどうかを表すブール値を持っています。 --}}
          {{-- チェックされた項目にチェックを入れる記述 --}}
        </form>
        <a href="{{ route('todo.show', $todo->id) }}" class="list-group-item list-group-item-action">
          {{ $todo->content }}
        </a>
      </div>
      @endforeach
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('js/index.js') }}"></script>
@endsection
{{-- @yield部分に召喚されるトンネルの出口 --}}