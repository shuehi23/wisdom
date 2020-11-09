<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // テーブル目の設定
    protected $table = 'likes';

    // テーブルのカラム名を指定する
    protected $fillable = ['book_id', 'user_id'];
}
