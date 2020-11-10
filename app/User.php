<?php

namespace App;

use App\Notifications\CustomPasswordReset;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_img_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Bookモデルとのリレーション
    public function books()
    {
        return $this->hasMany('App\Book');
    }

    // このユーザーが押したいいね
    // https://qiita.com/Hiroyuki-Hiroyuki/items/e5cb3b6595a7e476b73d
    // Userクラスがlikesテーブルを通して、Bookクラスと繋がっている
    public function likes() {
        return $this->belongsToMany(
            'App\Book', 'likes', 'user_id', 'book_id'
        )->withTimestamps();
    }
    // 既にいいねをしているか
    public function like($bookId) {
        $exist = $this->is_like($bookId);
        if($exist){
            return false;
        }else{
            $this->likes()->attach($bookId);
            return true;
        }
    }
    // いいねを外す
    public function dislike($bookId) {
        $exist = $this->is_like($bookId);

        if($exist){
            $this->likes()->detach($bookId);
            return true;
        }else{
            return false;
        }
    }
    // いいねをつける
    public function is_like($bookId) {
        return $this->likes()->where('book_id', $bookId)->exists();
    }

    /**
     * パスワードリセット通知の送信
     * 
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomPasswordReset($token));
    }
}
