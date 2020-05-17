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
<div class="home">




  <div class="demo-gallery">
    <ul id="lightgallery" class="list-unstyled row  d-flex justify-content-center">
          @foreach($article->getImages as $key=>$image)
                <li class="col-md-2" data-responsive="img/1-375.jpg 375, img/1-480.jpg 480, img/1.jpg 800"  data-src="{{asset($image->name)}}" data-sub-html="<h4>Yön tuşları ile resimler arasında geçiş yapabilirsiniz</h4>">
                    <a href="">
                      <img src="{{asset($image->name)}}"  class="img-responsive" style="height:150px" />
                    </a>
                </li>
                @endforeach

            </ul>
  </div>

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
@section('css')
<link href="{{asset('front/')}}/css/lightgallery.css" rel="stylesheet"/>
<link href="{{asset('front/')}}/css/single.css" rel="stylesheet"/>
@endsection
@section('js')
<script type="text/javascript">
       $(document).ready(function(){
           $('#lightgallery').lightGallery();
       });
       </script>
<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"> </script>
<script src="{{asset('front/')}}/js/jquery.mousewheel.min.js"></script>
   <script src="{{asset('front/')}}/js/lightgallery-all.min.js"></script>
@endsection
