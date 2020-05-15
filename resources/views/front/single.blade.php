@extends('front.layouts.master')
@section('title',$article->title)
@section('content')
@section('bg',asset($article->image))

      <div class="col-md-12 mx-auto">

<div class="header text-center">
  <h1 class="mb-2">{{$article->title}}</h1>
<hr class="mb-4">
</div>
  <div class="row mb-5">
    <div class="col-md-6 text-center">
      <img  src="{{asset($article->image)}}" class="rounded img-fluid"/>
    </div>
    <div class="col-md-4">
      <h2 class="text-center">Bilgiler</h2>
      <div class="row">
        <div class="col-md-12">
          <?php $url = Request::url(); ?>
          <p class="post-meta">
            <div class="mb-4">
              Kategori: <a href="{{$url.'?kategori='.$article->getCategory->slug}}">{{$article->getCategory->name}}</a>
            </div>
            <div class="mb-4">
              Yaptıran :  <a href="{{$url.'?yaptiran='.$article->getMaker->slug}}"> {{$article->getMaker->name}}</a><br>

            </div>

            <div class="mb-4">
              Yüzyıl :  <a href="{{$url.'?yuzyil='.$article->getCentury->slug}}"> {{$article->getCentury->name.'  '.$article->year}}</a>

            </div>

            </p>


          <p class="post-meta">
            <div class="mb-4">
              Dönemin padişahı: <a href="{{$url.'?padisah='.$article->getPadisah->slug}}">{{$article->getPadisah->name}}</a><br>

            </div>
            <div class="mb-4">
              Dönemin şeyhülislamı :  <a href="{{$url.'?seyhulislam='.$article->getSeyhulislam->slug}}"> {{$article->getSeyhulislam->name}}</a><br>

            </div>
            <div class="mb-4">
              Bulunduğu şehir :  <a href="{{$url.'?sehir='.$article->getCity->slug}}"> {{$article->getCity->name}}</a>
            </div>
            <div class="mb-4">
              Adresi: <a href="#"> {{$article->fullAddress}}</a>
            </div>
            </p>
    </div>
      </div>

    </div>
  </div>
<br><hr><br>
<div class="row  d-flex justify-content-center" >
  @foreach($article->getImages as $key=>$image)
  <div class="col-md-3" data-toggle="modal" data-target="#exampleModal" data-target="#carouselExample" >
</a>
<a data-toggle="modal" data-target="#a{{$image->id}}" href="#"><img  class="w-75 gallery-img" width="100"  src="{{asset($image->name)}}">
    <div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="a{{$image->id}}" role="dialog" tabindex="-1">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-body mb-0 p-0">
                      <img  class="w-100" src="{{asset($image->name)}}">
                    </div>
                </div>
              </div>
            </div>
  </div>
  @endforeach

</div>
<article class="content">
<header class="mt-5 pt-2">
  <h2>{{$article->title}}</h2>
</header>
  <div class="container">
    <div class="row">
      <div class="col-md-9 mx-auto">
        <p class="">
          {!!$article->content!!}
        </p>
      </div>
    </div>
    <a href="{{route('article.printPDF',$article->slug)}}">
      <button type="button" class="btn btn-primary" name="button"> pdf olarak indir<i class="ml-2 fas fa-file-pdf"></i></button>
    </a>
<span class="text-red text-muted float-right">hit sayısı : <b>{{$article->hit}}</b></span>

</article>

  </div>
</div>
@endsection
