@extends('layouts.app')

@section('title', __('Edit Profile'))

@section('content')
   <div class="container">

    @include('registrant.mypageTabs')

     <div class="row justify-content-center">
         <div class="col-md-8">
             <div class="card">
                 <div class="card-header">{{ __('Edit Profile') }}</div>

                 <div class="card-body">
                     <form method="POST" action="{{ route('profile.edit') }}" enctype="multipart/form-data">
                     @csrf

                     <!-- ユーザー名 -->
                     <div class="form-group row">
                         <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                         <div class="col-md-6">
                             <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="@if(!empty(old('name'))){{ old('name') }}@elseif(!empty($auth)){{ $auth->name }}@endif"
                                    required autocomplete="name" autofocus>
                             @error('name')
                             <span class="text-danger" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                             @enderror
                         </div>
                     </div>

                     <!-- ユーザーEメール -->
                     <div class="form-group row">
                         <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                         <div class="col-md-6">
                             <input type="text" id="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="@if(!empty(old('email'))){{ old('email') }}@elseif(!empty($auth)){{ $auth->email }}@endif"
                                    required autocomplete="email">

                             @error('email')
                             <span class="text-danger" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                             @enderror
                         </div>
                     </div>

                     <!-- ユーザー画像 -->
                     <div class="form-group row">
                         <label for="profile_img_path" class="col-md-4 col-form-label text-md-right">{{ __('Profile Image') }}</label>

                         <div class="col-md-6">
                             <Profileimagepreview
                             :auth="{{ $auth }}"
                             ></Profileimagepreview>

                         @error('profile_img_path')
                         <span class="text-danger" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                         @enderror
                         </div>
                     </div>

                     <div class="form-group row mb-0">
                         <div class="col-md-6 offset-md-4">
                             <button type="submit" class="btn btn-primary c-btn--blue">
                                 {{ __('Edit') }}
                             </button>
                         </div>
                     </div>
                    </form>

                 </div>
             </div>
         </div>
     </div>
    </div>
 @endsection