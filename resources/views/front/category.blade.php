@extends('front.layouts.master')
@section('title',$category->name.' Katagorisi |'.count($articles).' Yapı Bulundu')
@section('bg',asset($category->image))
@section('content')


      <div class=" col-md-9 mx-auto">
      @include('front.widgets.articleList')
    </div>
@include('front.widgets.category')
@endsection
