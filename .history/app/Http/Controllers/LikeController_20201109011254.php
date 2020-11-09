<?php

namespace App\Http\Controllers;

use App\Book;
use App\Like;
use Illuminate\Contracts\Auth\Guard;

class LikeController extends Controller
{
    // =============================
    // コンストラクタ
    // =============================
    function __construct(Guard $auth, Book $book, Like $like)
    {
        $this->auth = $auth;
        $this->book = $book;
        $this->like = $like;
    }

    // =============================
    // いいねをつける
    // =============================
    public function like($id) 
    {
        if(!ctype_digit($id)){
            return back()->with('flash_message',__('Invalid operation was performed.'));
        }
        // ユーザーのidを格納
        $userId = $this->auth->user()->id;

        // likeテーブルにuser_idとbook_idを保存する
        if(!$this->like->where('book_id', $id)->where('user_id', $userId)->first()){
            $like = $this->like->create([
                'user_id' => $userId,
                'book_id' => $id,
            ]);
        }

        $likeCount = count(Like::where('book_id', $id)->get());

        return response()->json(['likeCount' => $likeCount]);
    }

    // =============================
    //  いいね取り消し
    // =============================
    public function unlike($id) 
    {
        if(!ctype_digit($id)){
            return back()->with('flash_message',__('Invalid operation was performed.'));
        }
        // DBで検索するためにユーザーのidを格納
        $userId = $this->auth->user()->id;

        // likeテーブルから指定の記事を削除する
        $like = $this->like->where('user_id', $userId)->where('book_id', $id)->delete();

        $likeCount = count(Like::where('book_id', $id)->get());

        return response()->json(['likeCount' => $likeCount]);
    }
}

    // https://qiita.com/ma7ma7pipipi/items/50a77cd392e9f27915d7

    // https://qiita.com/Hiroyuki-Hiroyuki/items/e5cb3b6595a7e476b73d
//    public function store(Request $request, $id)
//    {
//        Auth::user()->favorite($id);
//        return back();
//    }
//
//    public function destroy($id)
//    {
//        Auth::user()->unfavorite($id);
//        return back();
//    }