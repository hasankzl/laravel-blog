@extends('front.layouts.master')
@section(count($articles).' Yapı Bulundu')
@section('content')

        <div class="col-md-3 search">
  @include('front.widgets.category')
  @include('front.widgets.padisah')
  @include('front.widgets.seyhulislam')
  @include('front.widgets.architect')
  @include('front.widgets.century')
  @include('front.widgets.maker')
  @include('front.widgets.city')
        </div>
        <div class=" col-md-9 mx-auto">
          <div class="row">

          @if(isset($selected))

          @foreach ($selected as $data)
          <a class="badge-link mx-3" href="{{preg_replace('/'.$data->fullSlug.'/','',URL::full())}}"><span class="badge badge-secondary">
            <i class="fas fa-times"></i></span> {{$data->name}} </a>
          @endforeach
          @endif
          </div>
        @include('front.widgets.articleList')
      </div>
@endsection
