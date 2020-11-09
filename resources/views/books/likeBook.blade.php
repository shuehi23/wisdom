   @extends('layouts.app')

   @section('title', __('Favorite Books'))

   @section('content')
      <div class="container">

      @include('registrant.mypageTabs')

         <div class="row">
            @forelse($books as $book)

            @include('registrant.bookCard')

            @empty
            <div class="p-articles__empty">
               <p class="p-articles__empty-text">いいねした記事はありません</p>
                  <a href="{{ route('books') }}" class="btn-primary c-btn--blue p-articles__empty-link">記事を探す</a>
            </div>
               
            @endforelse
         </div>
         
      </div>
      @endsection