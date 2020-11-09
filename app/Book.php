<?php

namespace App;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;


class Book extends Model
{
    // テーブル名の設定
    protected $table = 'books';

    // テーブルカラム名を指定する
     protected $fillable = ['user_id', 'title', 'title_img_path', 'phrase', 'impression', 'tag_ids[]'];

    // usersテーブルに対してのリレーション 
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // likesテーブルに対してのリレーション
    public function likes()
    {
        return $this->hasMany('App\Like');   
    }

    // tagsテーブルに対してのリレーション 
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
    
    // 投稿をカテゴリー別表示
    public function getBookList(int $num_per_page = 20, array $condition = [])
    {
        // 引数として渡ってきたtag_idとpage_idからtag_idだけ取り出す
        $tag_id = Arr::get($condition, 'tag_id');
        $sort_id = Arr::get($condition, 'sort_id');

        // Eagerロード設定を追加
        if($sort_id === 'like') {
            // ソート順を設定されている場合
            $query = $this->withCount('likes', 'tags')->orderBy('likes_count', 'desc');

        } else {
            $query = $this->with('tags');
        }

        // タグが選択された時のみ、bookをtagのidで検索をかける
        if($tag_id) {
            $query->whereHas('tags', function ($q) use ($tag_id) {
                $q->where('id', $tag_id);
            });
        }
        
        if($sort_id === 'like') {

        }elseif($sort_id === 'new') {

            $query->orderBy('created_at', 'desc');
        }
        // paginateメソッドを使うと、ページネーションに必要な全件数やオフセットの指定などは全部やってくれる
        return $query->paginate($num_per_page);
    }

    // 順番表示
    public function order($select)
    {
        if($select == 'asc'){
            return $this->orderBy('created_at', 'asc')->get();
        }elseif($select == 'desc'){
            return $this->orderBy('created_at', 'desc')->get();
        }else{
            return $this->all();
        }
    }

    // お気に入りリスト
    public function getLikeBookList(int $num_per_page = 20, array $condition = [])
    {
        // 引数として渡ってきたtag＿idとpage_idからtag_idだけを取り出す
        $tag_id = Arr::get($condition, 'tag_id');
        // Eager ロードの設定を追加
        $query = $this->with('tags'); 

        // カテゴリーIDの指定
        // タグが選択された時のみ、bookをtagのidで検索をかける
        if($tag_id){
            $query->whereHas('tags', function ($q) use ($tag_id) {
                $q->where('id', $tag_id);
            });
        }
        // paginateメソッドを使うと、ページネーションに必要な前件数やオフセットの指定などは全部やってくれる
        return $query->paginate($num_per_page);
    }
}
