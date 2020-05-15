@if(count($articles)>0)
@foreach($articles as $article)
<div class="post-preview">
  <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}">

    <article class="">
<header>

</header>
<div class="row">
  <div class="col-md-3">
      <img src="{{asset($article->image)}}" class="rounded mx-auto d-block" width="300" />
  </div>
  <div class="col-md-8">

          <h3 class="post-subtitle mb-3">
              {{$article->title}}
          </h3>
        </a>
        <div class="row">
          <div class="col-md-6">
            <?php $url = Request::url(); ?>
            <p class="post-meta">
              Kategori: <a href="{{$url.'?kategori='.$article->getCategory->slug}}">{{$article->getCategory->name}}</a><br>
              Yaptıran :  <a href="{{$url.'?yaptiran='.$article->getMaker->slug}}"> {{$article->getMaker->name}}</a><br>
              Yüzyıl :  <a href="{{$url.'?yuzyil='.$article->getCentury->slug}}"> {{$article->getCentury->name.'  '.$article->year}}</a>
              </p>
          </div>
          <div class="col-md-6">
            <p class="post-meta">
              Dönemin padişahı: <a href="{{$url.'?padisah='.$article->getPadisah->slug}}">{{$article->getPadisah->name}}</a><br>
              Dönemin şeyhülislamı :  <a href="{{$url.'?seyhulislam='.$article->getSeyhulislam->slug}}"> {{$article->getSeyhulislam->name}}</a><br>
              Bulunduğu şehir :  <a href="{{$url.'?sehir='.$article->getCity->slug}}"> {{$article->getCity->name}}</a>
              </p>
          </div>
        </div>

      </div>

  </div>

</article>

<hr>

</div>
      @endforeach
<div class="w-100" style="display:flex;justify-content:center">
{{$articles->links()}}
</div>
@else
<div class="alert alert-danger">
<h2>Bu kategoriye kriterlere uygun yapı bulunamadı</h2>
</div>
@endif
