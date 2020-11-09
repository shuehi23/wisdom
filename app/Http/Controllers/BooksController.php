<?php

namespace App\Http\Controllers;

use App\Tag;

use App\Book;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\CreateBookRequest;
use Illuminate\Contracts\Auth\Guard;

class BooksController extends Controller
{
    /**
     * @var Book
     */
    protected $book;
    /**
     * @var Tag
     */
    protected $tag;

    // ========================================
    // 定数
    // ========================================
    // １ページあたりの表示件数
    const NUM_PER_PAGE = 6;

    // ========================================
    // コンストラクタ
    // ========================================
    // インスタンス生成時に実行される関数
    // コンストラクタを決めていくことで、引数で値を受け渡し、プロパティにそのまま代入することができる
    function __construct(Guard $auth, Book $book, Tag $tag) 
    {
        $this->auth = $auth;
        $this->book = $book;
        $this->tag = $tag;
    }

    // =========================================
    // 本登録画面表示アクション
    // =========================================
    public function new()
    {
        // Categoryモデルのインスタンスを生成する
        $tag = $this->tag;

        return view('books.new', ['all_tags_list' => $tag->all()]);
    }

    // =========================================
    // 本を投稿するアクション
    // =========================================
    public function create(CreateBookRequest $request)
    {
        // post送信されたデータを格納する
        $inputs = $request->all();

        // 格納したデータの中からtag_idsだけを抽出して格納
        $tag_ids = $inputs['tag_ids'];

        // インスタンス生成
        $book = $this->book;

        // $path = $request->file('title_img_path') ? $request->file('title_img_path')->store('public/img') : '';

        // 画像が選択されていない場合
        if(empty($imgFile = $request->file('title_img_path'))){
            // 投稿記事をデータをDBに登録
            $id = $book::create([
                'user_id' => $request->user()->id,
                'title' => $request->input('title'),
                'phrase' => $request->input('phrase'),
                'impression' => $request->input('impression'),
                
            ])->id;
        }else{
            // Cloudinaryにアップロード後に生成されたURLを格納
            $imgUrl = uploadImg($imgFile);
            // カテゴリー
            // createメソッドでDBに保存する（テーブルのカラム名を指定する）
            $id = $book::create([
                'user_id' => $request->user()->id,
                'title' => $request->input('title'),
                // basenameメソッドでファイル名のみを保存する
                // 'title_img_path' => $path ? basename($path) : '',
                'title_img_path' => $imgUrl,
                'phrase' => $request->input('phrase'),
                'impression' => $request->input('impression'),
                
            ])->id;
        }

        // 送信された記事
        $book = $book->find($id);
        // 送信された記事にカテゴリーを紐づける
        $book->tags()->sync($tag_ids);

        return redirect('/')->with('flash_message', __('Registered.'));
    }

    // ==============================================
    // 記事投稿一覧を表示するアクション
    // ==============================================
    public function index(Request $request)
    {
        // カテゴリー別表示
        // パラメータ取得
        $input = $request->input();

        // タグのidを取得
        $tag_id = $request->tag_id;

        // 並び順のidを取得
        $sort_id = $request->sort_id;

        //  記事投稿一覧を取得
        $list = $this->book->getBookList(self::NUM_PER_PAGE, $input);

        // ページネーションリンクにクエリストリングを付け加える
        $list->appends($input);

        // カテゴリー一覧を取得(TagモデルのgetTagList()を呼び出す)
        $tag_list = $this->tag->getTagList();

        // いいね機能
        // そのユーザーがその投稿にいいねを押しているか
        if(!empty($this->auth->user())) {
            
            $userAuth = $this->auth->user();

            return view('index', [
                'userAuth' => $userAuth,
                'list' => $list,
                'tag_list' => $tag_list,
                'tag_id' => $tag_id,
                'sort_id' => $sort_id,
            ]);
        }else{
            return view('index', [
                'list' => $list,
                'tag_list' => $tag_list,
                'tag_id' => $tag_id,
                'sort_id' => $sort_id,
            ]);
        }
    }

    // ========================================
    // 記事詳細画面表示アクション
    // ========================================
    public function show(Book $book, $id) 
    {
        // URLに数字以外がURLに入力された場合はリダイレクト
        if(!ctype_digit($id)){
            return redirect('/')->with('flash_message', __('Invalid operation was performed.'));
        }

        // クリックされた記事のidを格納
        $book = $this->book->find($id);

        if(empty($book)) {
            return back()->with('flash_message', __('The URL does not exist.'));
        }

        // そのユーザがその投稿にいいねを押しているか
        // if(Auth::user()){}

        $book->load('likes');
        $book->load('user');
        // dd($book->user->name);
        $defaultCount = count($book->likes);
        if(!empty($this->auth->user())) {

            $userAuth = $this->auth->user();

            $defaultLiked = $book->likes->where('user_id', $userAuth->id)->first();

            if(isset($defaultLiked)) {
                $defaultLiked = true;
            } else{
                $defaultLiked = false;
            } 
            return view('books.show', [
                'book' => $book,
                'userAuth' => $userAuth,
                'defaultLiked' => $defaultLiked,
                'defaultCount' => $defaultCount
            ]);
        }else{
            return view('books.show', [
                'book' => $book,
                'defaultCount' => $defaultCount
            ]);
        }
    }

    // ==========================================
    // マイページ画面アクション
    // ==========================================
    public function mypage(Request $request) 
    {
        // dump(Route::currentRouteName());
        // 未ログイン状態で直接URLを打ち込むと、ここの処理で引っ掛かり意図しないエラーが発生する
        $books = $this->auth->user()->books()->get();

        // カテゴリ別表示
        // パラメータを取得
        $input = $request->input();

        // 記事一覧を取得
        $list = $this->book->getBookList(self::NUM_PER_PAGE, $input);

        // ページネーションリンクにクエリリストリングを付け加える
        $list->appends($input);

        // カテゴリー一覧を取得（TagモデルのgetTagList()を呼び出す)
        $tag_list = $this->tag->getTagList();

        // likes(現在その投稿についているいいね数)を読み込む
        // foreach ($books as $book) {
        //     dump($book);
        $books->load('likes');
        // dd($book->load('likes'));

        // そのユーザーがその投稿にいいねを押しているか
        if(!empty($this->auth->user())) {

            $userAuth = $this->auth->user();

            $defaultLiked = $this->book->likes->where('user_id', $userAuth->id)->first();

            if (isset($defaultLiked)) {
                $defaultLiked = true;
            } else {
                $defaultLiked = false;
            }
            return view('mypage', [
                'books' => $books,
                'userAuth' => $userAuth,
                'defaultLiked' => $defaultLiked,
                'list' => $list,
                'tag_list' => $tag_list
            ]);
        }else{
            return view('mypage', [
                // 格納したBookモデルのデータをビューに渡す
                'books' => $books,
                'list' => $list,
                'tag_list' => $tag_list,
            ]);
        }
        // mypageのビューに上記の＄booksを渡す。 ビューの方ではこれをforeachで回して表示させる
        return view('mypage', compact('books'));

    }

    // =======================================
    // いいね,画面アクション
    // =======================================
    public function like(Request $request)
    {
        // Bookモデルのデータを全て格納する
        $books = $this->auth->user()->likes();
        // dd(Auth::user()->likes()->get());
        $books = $books->paginate(20);

        // カテゴリー別表示
        // パラメータを取得
        $input = $request->input();
        // ブログ記事一覧を取得
        $list = $this->book->getBookList(self::NUM_PER_PAGE, $input);
        // ページネーションリンクにクエリリストリングを付け加える
        $list->appends($input);
        // カテゴリー一覧を取得(TagモデルのgetTagList()を呼び出す)
        $tag_list = $this->tag->getTagList();
        // いいね機能
        // そのユーザーがその投稿にいいねを押しているか
        // TODO いいね用
        $userAuth = $this->auth->user();
        $defaultLiked = [];
        foreach($list as $book){
            $defaultLiked[] = $book->likes->where('book_id', $book->id)->where('user_id', $userAuth->id)->first();
        }

        if (isset($defaultLiked)) {
            $defaultLiked = true;
        }else{
            $defaultLiked = false;
        }
        return view('books.likeBook',[
            'books' => $books,
            'userAuth' => $userAuth,
            'defaultLiked' => $defaultLiked,
            'list' => $list,
            'tag_list' => $tag_list
        ]);

    }

    // =======================================
    // 自分自身の投稿記事を削除するアクション
    // =======================================
    public function destroy($id) {
        // GETパラメータが数字かどうか
        if(!ctype_digit($id)){
            return redirect('mepage')->with('flash_message', __('Invalid operation was performed.'));
    };

    // 選択された記事のidを指定する
    // Book::find($id)->delete();
    // 万が一自分の投稿じゃない記事を削除しようとした場合にはマイページへ遷移させる
    if(!$this->auth->user()->books()->find($id)) {
        return redirect('mypage')->with('flash_message', __('You can delete only your own books'));
    };
    // 自分が投稿した記事のみ削除できる
    $this->auth->user()->books()->find($id)->delete();
    return redirect('mypage')->with('flash_message', __('Deleted.'));

    }
    
}