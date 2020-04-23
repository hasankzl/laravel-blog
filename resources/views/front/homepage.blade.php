@extends('front.layouts.master')
@section('title','Anasayfa')
@section('content')


      <div class=" col-md-9 mx-auto">
        @include('front.Widgets.ArticleList')
        <!-- Pager -->
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div>
      </div>
@include('Front\Widgets\Category')
@endsection
