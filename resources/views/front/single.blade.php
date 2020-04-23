@extends('front.layouts.master')
@section('title',$article->title)
@section('content')
@section('bg',asset($article->image))

      <div class="col-md-9 mx-auto">
        <h2>{{$article->title}}</h2>
    <img src="{{asset($article->image)}}" /> <br>
    <p>
      {!!$article->content!!}
    </p>
<span class="text-red text-muted float-right">hit sayısı : <b>{{$article->hit}}</b></span>


      </div>


@include('Front\Widgets\Category')
@endsection
