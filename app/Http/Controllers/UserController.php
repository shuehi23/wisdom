<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\passEditRequest;

class UserController extends Controller
{
    //===================================
    //  コンストラクト
    //===================================
    function __construct(Guard $auth, User $user)
    {
        $this->auth = $auth;
        $this->user = $user;   
    }
    //===================================
    // プロフィール編集画面
    //===================================
    public function edit()
    {
        return view('users.userEdit', ['auth' => $this->auth->user()]);
    }

    //===================================
    // プロフィール編集アクション
    //===================================
    public function update(Request $request)
    {
        $userAuth = $this->auth->user();

        // フォームに入っているemailがDBのemailと同じだったらそのまま登録
        if(strcmp($request->get('email'),  $this->auth->user()->email) === 0) {
            $validated_data = $request->validate([
                'name' => 'required|string|max:20',
                'email' => 'required|string|email|max:255',
                'profile_img_path' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:1024',
            ]);
        }else{ // フォームに入力されているemailがDBのemailから変わっていたら、重複チェックも行う
            $request->validate([
                'name' => 'required|string|max:20',
                'email' => 'required|string|email|max:255|unique:users',
                'profile_img_path' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:1024',
            ]);
        }

        $userAuth->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ])->save();

        // 画像が選択された場合はCloudinaryにアップロード
        if(!empty($imgFile = $request->file('profile_img_path'))) {

            // Cloudinaryにアップロード後に生成されたURLを格納
            $imgUrl = uploadImg($imgFile);

            $userAuth->fill([
                'profile_img_path' => $imgUrl
            ])->save();
        }

        return redirect('profile_edit')->with('flash_message', __('Profile Edited.'));
    }

    // ======================================
    // パスワード変更画面表示
    // ======================================
    public function passEdit()
    {
        return view('users.passEdit',['auth' => $this->auth->user()]);
    }

    // ======================================
    // パスワード変更アクション
    // ======================================
    public function passUpdate(PassEditRequest $request)
    {
        $userAuth = $this->auth->user();

        // 現在のパスワードが正しいか、調べる
        if(!(Hash::check($request->get('old-password'), $userAuth->password))) {
            return redirect('password_edit')->with('flash_message', '現在のパスワードが間違っています。');
        }

        // 現在のパスワードと新しいパスワードが間違っているかを調べる
        if(strcmp($request->get('old-password'), $request->get('new-password')) == 0) {
            return redirect('password_edit')->with('flash_message', '新しいパスワードが現在のパスワードと同じです。違うパスワードを設定してください。');
        }

        // パスワード変更
        $userAuth->password = bcrypt($request->get('new-password'));
        $userAuth->save();

        return redirect('password_edit')->with('flash_message', 'パスワードを変更しました。');
    }

    
    // ======================================
    // アカウント削除の画面表示
    // ======================================
    public function delete()
    {
        return view('auth.delete');
    }

    // ======================================
    // アカウント削除アクション
    // ======================================
    public function destroy()
    {
        $this->auth->user()->delete();

        return redirect('/');
    }
}
