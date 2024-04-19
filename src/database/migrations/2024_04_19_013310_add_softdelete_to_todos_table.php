<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftdeleteToTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->softDeletes(); 
            // softDeletes メソッドはdeleted_atカラムを生成（todostableにdeleted-atを生成している）
            // テーブルにカラムを追加する処理
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
            // テーブルからdeleted_atカラムを削除する処理
            // ロールバックできるようにするため
        });
    }
}
