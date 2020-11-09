<?php
namespace App\Http\ViewComposers;

use App\Tag;
use Illuminate\Contracts\View\View;


class TagComposer {

    protected $auth;

    public function __construct(Tag $tag) 
    {
        $this->tag = $tag;
    }

    // 既存のcomposerメソッドを使用する
    public function compose(View $view){
        
        $view->with('tagList', $this->tag->getTagList());
    }
}