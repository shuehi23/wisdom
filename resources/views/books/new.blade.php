<!-- 本の新規登録画面 -->
@extends('layouts.app')

@section('title', __('Book Register'))

@section('content')
   <div class="container">
       <div class="row justify-content-center">
           <div class="col-md-8">

               <div class="card">

                   <div class="card-header">{{ __('Book Register') }}</div>

                   <div class="card-body">
                       <form action="{{ route('books.create') }}" method="post" enctype="multipart/form-data">
                       @csrf

                       <!-- クオートのタイトル -->
                       <div class="form-group row">
                           <label for="title" class="col-md-4 col-form-label text-md-right">
                               {{ __('Title') }}
                           </label>
                           <div class="col-md-6">
                               <input class="form-control @error('title') is-invalid @enderror" id="title"
                                      name="title" value="{{ old('title') }}"
                                      required autocomplete="title" autofocus type="text"
                                      placeholder="50文字以内" maxlength="50">
                               @error('title')
                               <span class="text-danger" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                               @enderror
                           </div>
                       </div>

                       <!--  クオートの画像 -->
                       <div class="form-group row">
                           <label for="title_img_path" class="col-md-4 col-form-label text-md-right">
                               {{ __('Title Image') }}
                           </label>

                           <div class="col-md-6">
                               <articleimagepreview>
                               </articleimagepreview>

                               @error('title_img_path')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                               @enderror
                           </div>
                       </div>

                       <!-- 引用フレーズ -->
                       <div class="form-group row">
                           <label for="phrase" class="col-md-4 col-form-label text-md-right">
                               {{ __('Book Phrase') }}
                           </label>

                           <div class="col-md-6">
                               <articlephraseform
                                   :text-phrase="{{ json_encode(old('phrase')) }}"
                                   @error('phrase')
                                   :error="{{ json_encode(true) }}"
                                   @enderror
                                ></articlephraseform>
                                
                               @error('phrase')
                               <span class="text-danger c-invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                               @enderror
                           </div>
                       </div>

                       <!-- 紹介文 -->
                       <div class="form-group row">
                        <label for="impression" class="col-md-4 col-form-label text-md-right">
                            {{ __('Book Impression') }}
                        </label>

                        <div class="col-md-6">
                            <articleimpressionform
                                 :text-impression="{{ json_encode(old('impression')) }}"
                                 @error('impression')
                                 :error="{{ json_encode(true) }}"
                                 @enderror
                            ></articleimpressionform>

                            @error('impression')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                       <!-- カテゴリー -->
                       <div class="form-group row">
                           <label for="category" class="col-md-4 col-form-label text-md-right">
                               {{ __('Category') }}
                           </label>
                           <div class="col-md-6">
                               @foreach($all_tags_list as $all_tags)
                               <label for="tags_{{ $all_tags->id }}" class="l-flexbox">
                                   <input id="tags_{{ $all_tags->id }}" type="checkbox" class="p-form-card__category @error('tag_ids') is-invalid @enderror"
                                          name="tag_ids[{{ $all_tags->id }}]" value="{{$all_tags->id}}"
                                          @if(@inputs['tag_ids'] === $all_tags->name)
                                          checked="checked"
                                          @endif>
                                    {{ $all_tags->name }}
                               </label>

                               @endforeach
                               
                               @error('tag_ids')
                               <span class="text-danger c-invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                               @enderror
                           </div>
                       </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary c-btn--blue">
                                    {{ __('Post') }}
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