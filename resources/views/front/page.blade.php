@extends('front.layouts.master')
@section('title',$page->title)
@section('content')
@section('bg',$page->image)

      <div class="col-md-9 mx-auto">
  <p>
    {!! $page->content !!}
  </p>

      </div>


@endsection
