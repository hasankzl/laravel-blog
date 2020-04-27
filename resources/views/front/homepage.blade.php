@extends('front.layouts.master')
@section('title','Anasayfa')
@section('content')


      <div class=" col-md-9 mx-auto">
        @include('front.widgets.articleList')
        <!-- Pager -->
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div>
      </div>
@include('front.widgets.category')
@endsection
