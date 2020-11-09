<div class="c-card p-book-card @if(Route::currentRouteName() == 'books.show') detailPage col-lg-8 @else col-lg-6 @endif">

    <div class="card card-body c-card__body @if(Route::currentRouteName() === 'books.show') detailPage @endif">

        @if(Route::currentRouteName() === 'books.show')

        @else
           <!--  パネル全体をリンクする -->
           <a href="{{ route('books.show', $book->id) }}" class="c-card__link-large" title="記事の詳細"></a>
        @endif

        <div class="l-flex c-card__main">

            <div class="c-card__phraseArea">
                <i class="fas fa-book-open c-icon--book"><span class="c-card__subject">心に残ったフレーズ</span></i>
                <p class="card-title c-card__phrase">“ {{ $book->phrase }} ”</p>
            </div>

            <div class="c-card__img-book ml-auto">
                <img class="c-card__img"
                     src="@if(empty($book->title_img_path)){{ asset('/img/noimg.png') }} @else {{ $book->title_img_path }} @endif"
                     alt="@if(empty($book->title_img_path)) bookの画像 @else {{ $book->title }} @endif">
            </div>
        </div>

        <p class="c-card__title">「 {{ $book->title }} 」</p>

        <div class="c-card__menu l-flex">
            <div class="c-card__left-menu mr-auto">
                @forelse($book->tags as $tag)
                   <a href="{{ route('books', ['tag_id' => $tag->id]) }}" class="c-card__link category">
                       {{ $tag->name }}
                   </a>
                @empty
                   <p class="c-card__link-none">カテゴリーがありません</p>
                @endforelse
            </div>

            <div class="c-card__right-menu">
                <!-- いいねボタン -->
                @guest
                     <like
                        :book-id="{{ json_encode($book->id) }}"
                        :default-count="{{ json_encode(count($book->likes)) }}"
                        :login-route="{{ json_encode(route('login')) }}"
                      >
                      </like>
                @else 

                     <like
                        :book-id="{{ json_encode($book->id) }}"
                        :user-id="{{ json_encode($userAuth->id) }}"
                        :default-liked="{{ json_encode($book->likes->where('user_id', $userAuth->id)->first()) }}"
                        :default-count="{{ json_encode(count($book->likes)) }}"
                    >
                    </like>
                
                @endguest
                
                <!-- マイページ用のゴミ箱ボタン -->
                @if(Route::currentRouteName() == 'books.mypage')
                   <form action="{{ route('books.delete', $book->id) }}" method="post" class="d-inline">
                       @csrf

                       <button class="c-btn--delete c-card__btn" onclick="return confirm('この投稿を削除してよろしいですか')">
                        <i class="far fa-trash-alt"></i>
                       </button>
                   </form>
                @endif
          </div>
        </div>

        <!-- 詳細ページでは投稿者の情報を表示する -->
        @if(Route::currentRouteName() == 'books.show')
           <div class="p-book-profile">

            <div class="p-book-profile__img">
                @if(empty($book->user->profile_img_path))
                    <img src="{{ asset('/img/noimg.png') }}" alt="{{ $book->user->name }}">
                @else
                    <img src="{{ $book->user->profile_img_path }}" alt="{{ $book->user->name }}">
                @endif
            </div>

            <p class="p-book-profile__name">{{ $book->user->name }}</p>
            <p class="p-book-profile__date">{{ $book->updated_at->format('Y/m/d') }}</p>
            <span> 投稿</span>
           </div>
        @endif

        @if(Route::currentRouteName() == 'books.show')
        <div class="c-card__phraseArea p-book-profile__wrap">
            <span class="c-card__impression">【感想】</span>
            <p class="c-card__impression-letter">{{ $book->impression }}</p>            
        </div>
        @endif

        
    </div>
</div>