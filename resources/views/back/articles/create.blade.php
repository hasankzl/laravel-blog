@extends('back.layouts.master')
@section('title','Makale Oluştur')
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
<form method="post" action="{{route('admin.makaleler.store')}}" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label>Makale Başlığı</label>
    <input type="text" name="title" class="form-control" required />
  </div>
  <div class="form-group">
    <label>Makale Kategori</label>
    <select class="form-control" name="category" required>
<option value="">
seçim yapınız
</option>
@foreach($categories as $category)
<option value="{{$category->id}}">{{$category->name}}</option>
@endforeach
    </select>
  </div>
  <div class="form-group">
    <label>Makale Fotoğrafı</label>
    <input type="file" name="image" class="form-control" required />
  </div>
  <div class="form-group">
    <label>Makale Başlığı</label>
    <textarea name="content" id="summernote" class="form-control" rows="4"></textarea>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary btn-block">Makaleyi Oluştur</button>
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
