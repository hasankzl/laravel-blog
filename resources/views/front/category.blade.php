@extends('front.layouts.master')
@section('title',$category->name.' Katagorisi |'.count($articles).' Yazı bulundu')
@section('content')


      <div class=" col-md-9 mx-auto">
      @include('front.Widgets.ArticleList')
    </div>
@include('Front\Widgets\Category')
@endsection
