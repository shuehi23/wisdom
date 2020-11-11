<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Up.Wisdom!!は自分がこれまで影響を受けた本をシェアできるサービスです">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
       <title>@yield('title') | {{ config('app.name', 'Wisdom!') }}</title>
    @else
       <title>{{ config('app.name', 'Wisdom!') }}</title>
    @endif

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ secure_asset('/img/favicon.ico') }}">

    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}" defer></script>
</head>
<body class="l-body l-flex">
    <div id="app" class="l-wrapper l-flex">
        
        <header class="l-header bg-white shadow-sm">
            <nav class="navbar navbar-expand-md c-navbar">
                <div class="container">

                    <div class="c-logo">
                        <a class="navbar-brand" href="{{ route('books') }}" >
                            <img src="{{ secure_asset('/img/icon-cutout.png') }}" alt="Wisdom" class="c-logo__img">
                        </a>
                    </div>

                    <ul class="navbar-nav ml-auto c-navbar__nav l-flex">
                        @guest
                           <li class="nav-item">
                               <a class="nav-link c-navbar__link" href="{{ route('login') }}">{{ __('Login') }}</a>
                           </li>
                           @if (Route::has('register'))
                           <li class="nav-item">
                               <a class="btn btn-primary c-btn--blue nav-link text-white" href="{{ route('register') }}">{{ __('User Register') }}</a>
                           </li>
                           @endif
                        @else
                        <!-- ログイン中のみ会員用のメニューを表示する -->
                        <li class="nav-item dropdown c-dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle c-navbar__link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                アカウント <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right c-dropdown__menu" aria-labelledby="navbarDropdown">
                                <!-- route内にはweb.phpのnameメソッドで定義したパスを指定する -->
                                <a class="dropdown-item" href="{{ route('books.mypage') }}">
                                    {{ __('Mypage') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" 
                                   onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                   {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                    @csrf
                                </form>
                            </div>
                        </li>

                        <li>
                            <a class="btn btn-primary c-btn--blue" href="{{ route('books.new') }}" style="color: white;">{{ __('Post') }}</a>
                        </li>
                     @endguest   
                    </ul>
                </div>
            </nav>

            <!-- 本一覧画面のみカテゴリーナビを表示する -->
            @if(Route::currentRouteName() == 'books' )
            <nav class="navbar navbar-expand-md c-navbar">
                <div class="container">

                <ul class="navbar-nav mr-auto c-navbar__nav c-navbar--category">

                    <li class="nav-item c-navbar--category__item @if(Route::currentRouteName() === 'books' && empty($tag_id)) active @endif">
                        <a class="nav-link c-navbar__link c-navbar--category__link @if(Route::currentRouteName() === 'books' && empty($tag_id)) active @endif"
                           href="{{ route('books', ['sort_id' => $sort_id]) }}">
                           ALL
                        </a>
                    </li>

                    @forelse($tag_list as $tag)
                       <li class="nav-item c-navbar--category__item @if($tag_id == $tag->id) active @endif">
                           <a class="nav-link c-navbar__link c-navbar--category__link @if($tag_id == $tag->id) active @endif"
                              href="{{ route('books', ['tag_id' => $tag->id, 'sort_id' => $sort_id]) }}">
                              {{ $tag->name }} 
                           </a>
                       </li>
                    @empty
                       <p>カテゴリーがありません</p>
                    @endforelse
                </ul>

                <!-- 並び替えナビ -->
                <ul class="navbar-nav ml-auto c-navbar__nav c-navbar--sort">

                    <li class="nav-item c-navbar--sort__item @if($sort_id === 'like') active @endif">
                        <a class="nav-link c-navbar__link c-navbar--sort__link @if($sort_id === 'like') active @endif"
                           href="{{ route('books', ['sort_id' => 'like', 'tag_id' => $tag_id]) }}">
                           いいね順
                        </a>
                    </li>

                    <li class="nav-item c-navbar--sort__item @if($sort_id === 'new' || empty($sort_id)) active @endif">
                        <a class="nav-link c-navbar__link c-navbar--sort__link @if($sort_id === 'new' || empty($sort_id)) active @endif"
                           href="{{ route('books', ['sort_id' => 'new', 'tag_id' => $tag_id]) }}">
                           最新順
                        </a>
                    </li>

                </ul>
            </div>
            </nav>
            @else
            @endif
        </header>

        <!-- フラッシュメッセージ -->
        @if (session('flash_message'))
            <flashmessage
            :flash-message="{{ json_encode(session('flash_message')) }}"
            ></flashmessage>
        @endif

        <!-- メイン部分 -->
         <main class="l-main">
             @yield('content')
         </main>


         <!-- フッター -->
         <footer class="l-footer p-footer l-flex">
             <div class="container footer-container">
                 <p class="text-muted">Copyright &copy;Wisdom_up!! All Rights Reserved.</p>
                 
             </div>
         </footer>
    </div>
   
</body>
</html>
