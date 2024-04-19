<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// 優先順位１位はそのクラスに記述されている文
// 優先順位２位はトレイト
// 優先順位３位はクラスの継承

class Todo extends Model
{
    use SoftDeletes;
    // これを追加するだけで、削除処理では deleted_at に日付を入れるUPDATE文が発行されるようになり、
    // すべての取得処理で deleted_at IS NULL が追加されるようになります。
    protected $table = 'todos';
    protected $fillable = [
        'content'
    ];
}

// Eloquentモデルを定義しています。
//指定したカラムのみがfillで一括設定されるようにする為