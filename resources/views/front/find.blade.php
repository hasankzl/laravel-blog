@extends('front.layouts.master')
@section('title','Arama')
@section('content')
@include('front.widgets.category')
      <div class=" col-md-9 mx-auto">
      @include('front.widgets.articleList')
    </div>
@endsection
