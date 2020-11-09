<ul class="nav nav-tabs p-mypage-tabs">
    <li class="nav-item @if(Route::currentRouteName() == 'books.mypage') active @endif">
        <a class="nav-link @if(Route::currentRouteName() == 'books.mypage') active @endif" href="{{ route('books.mypage') }}">{{ __('My Book List') }}</a>
    </li>
    <li class="nav-item @if(Route::currentRouteName() == 'books.like') active @endif">
        <a class="nav-link @if(Route::currentRouteName() == 'books.like') active @endif" href="{{ route('books.like') }}">{{ __('Favorite Books') }}</a>
    </li>
    <li class="nav-item @if(Route::currentRouteName() == 'profile.edit') active @endif">
        <a class="nav-link @if(Route::currentRouteName() == 'profile.edit') active @endif" href="{{ route('profile.edit') }}">{{ __('Edit Profile') }}</a>
    </li>
    <li class="nav-item @if(Route::currentRouteName() == 'pass.edit') active @endif">
        <a class="nav-link @if(Route::currentRouteName() == 'pass.edit') active @endif" href="{{ route('pass.edit') }}">{{ __('Edit Password') }}</a>
    </li>
    <li class="nav-item @if(Route::currentRouteName() == 'user.delete') active @endif">
        <a class="nav-link @if(Route::currentRouteName() == 'user.delete') active @endif" href="{{ route('user.delete') }}">{{ __('User Delete') }}</a>
    </li>
        
</ul>