@if(count($articles)>0)
@foreach($articles as $article)
<div class="post-preview">
  <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}">
    <h2 class="post-title mb-4">
      {{$article->title}}
    </h2>
    <img src="{{asset($article->image)}}" width="500" />
    <h3 class="post-subtitle">

    </h3>
  </a>
  <p class="post-meta">
  Yaptıran :  <a href="#"> {{$article->getMaker->name}}</a>
  ,    Kategori: <a href="#">{{$article->getCategory->name}}</a>
    <span class="float-right">{{$article->created_at->diffForHumans()}}</span></p>
</div>
@if(!$loop->last)
<hr>
@endif
      @endforeach
<div class="w-100 mx-auto">
{{$articles->links()}}
</div>
@else
<div class="alert alert-danger">
<h2>Bu kategoriye ait yapı bulunamadı</h2>
</div>
@endif
