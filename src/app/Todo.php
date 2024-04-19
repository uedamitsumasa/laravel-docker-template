<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todos';
    protected $fillable = [
        'content'
    ];
}

// Eloquentモデルを定義しています。
//指定したカラムのみがfillで一括設定されるようにする為