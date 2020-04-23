@extends('back.layouts.master')
@section('title',$page->title.' sayfasını güncelle')
@section('content')


<div class="card shadow mb-4">
  <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold float-left text-primary">@yield('title')</h6>
  </div>
  <div class="card-body">
    @if($errors->any())
    @foreach($errors->all() as $error)
    <div class="alert alert-danger">
      {{$error}}
</div>
    @endforeach
    @endif
<form method="post" action="{{route('admin.page.update',$page->id)}}"  enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label>sayfa Başlığı</label>
    <input type="text" name="title" class="form-control" value="{{$page->title}}" required />
  </div>
  <div class="form-group">
    <label>sayfa Fotoğrafı</label><br/>
        <img src="{{asset($page->image)}}"  width="300" class="img-thumbnail rounded mb-2"/>
    <input type="file" name="image" class="form-control"  />
  </div>
  <div class="form-group">
    <label>sayfa Başlığı</label>
    <textarea name="content" id="summernote"  class="form-control" rows="4">{!!$page->content!!}</textarea>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary btn-block">Sayfayı Güncelle</button>
  </div>
</form>
  </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script>
$(document).ready(function(){
  $('#summernote').summernote(
    {'height':300}

  );
});
</script>
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@endsection
