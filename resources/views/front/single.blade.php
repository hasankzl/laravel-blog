@extends('front.layouts.master')
@section('title',$article->title)
@section('content')
@section('bg',asset($article->image))

      <div class="col-md-12 mx-auto">

<div class="text-center">
  <h2 class="mb-4">{{$article->title}}</h2>
  <img  src="{{asset($article->image)}}" width="600"/> <br><hr><br>

</div>
    <p>
      {!!$article->content!!}
    </p>
<span class="text-red text-muted float-right">hit sayısı : <b>{{$article->hit}}</b></span>


      </div>


@endsection
