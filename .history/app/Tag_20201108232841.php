<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // テーブル名の設定
    protected $table = 'tags';
    
    protected $fillable = ['id', 'name'];

    // booksテーブルに対するリレーション （互いに複数）
    public function books()
    {
        return $this->belongsToMany('App\Book');
    }

    /**
     * // カテゴリーリストを取得
     * 
     * @param int    $num_per_page 1ページ辺の表示件数
     * @param string $order        並び順の基準となるカラム
     * @param string $direction    並び順の向き asc or desc
     * @return mixed
     */
    public function getTagList(int $num_per_page = 0)
    {
        $query = $this;
        if($num_per_page) {
            return $query->paginate($num_per_page);
        }
        return $query->get();
    }
}
