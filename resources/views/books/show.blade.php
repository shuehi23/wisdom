@extends('layouts.app')

@section('title', '詳細')

@section('content')
    <div class="container">

        @include('registrant.bookCard')

        <div class="col-lg-8 pr-0 pl-0 back-btn-area">
            <button type="button" onclick="history.back()" class="btn back-btn">< Back</button>
        </div>
    </div>
 @endsection