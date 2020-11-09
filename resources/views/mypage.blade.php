@extends('layouts.app')

@section('title', __('My Book List'))

@section('content')
    <div class="container">

        @include('registrant.mypageTabs')

        <div class="row">
            @forelse($books as $book)

            @include('registrant.bookCard')

            @empty
            <div class="p-articles__empty">
               <p class="p-articles__empty-text">投稿した記事はありません</p>
               <p class="p-articles__empty-text">これまでに出会った本をシェアしませんか？</p>
                  <a href="{{ route('books.new') }}" class="btn-primary c-btn--blue p-articles__empty-link">投稿してみる</a>
            </div>
            @endforelse
        </div>
    </div>
@endsection