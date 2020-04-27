@extends('back.layouts.master')
@section('title',$article->title.' makalesini güncelle')
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
<form method="post" action="{{route('admin.makaleler.update',$article->id)}}" enctype="multipart/form-data">
  @method('PUT')
  @csrf
  <div class="form-group">
    <label>Makale Başlığı</label>
    <input type="text" name="title" class="form-control" value="{{$article->title}}" required />
  </div>
  <div class="form-group">
    <label>Makale Kategori</label>
    <select class="form-control" name="category"
    required>
<option value="">
seçim yapınız
</option>
@foreach($categories as $category)
<option @if($category->id ==$article->category_id) selected  @endif value="{{$category->id}}">{{$category->name}}</option>
@endforeach
    </select>
  </div>
  <div class="form-group">
    <label>Yaptıran Kisi/Kurum</label>
    <select class="form-control" name="maker"
    required>
<option value="">
seçim yapınız
</option>
@foreach($makers as $maker)
<option @if($maker->id ==$article->maker_id) selected  @endif value="{{$maker->id}}">{{$maker->name}}</option>
@endforeach
    </select>
  </div>
  <div class="form-group">
    <label>Adres</label>
    <div class="row">
<div class="col-md-6">
  <select class="form-control" name="city"
  required>
<option value="">
seçim yapınız
</option>
@foreach($cities as $city)
<option @if($city->id ==$article->city_id) selected  @endif value="{{$city->id}}">{{$city->name}}</option>
@endforeach
  </select>
</div>
<div class="col-md-6">
  <input type="text" class="form-control"  name="fullAddress"  required  placeholder="tam adresi giriniz" value="{{$article->fullAddress}}"/>
</div>
    </div>
  </div>
  <div class="form-group">
    <label>Makale Fotoğrafı</label><br/>
    <img src="{{asset($article->image)}}"  width="300" class="img-thumbnail rounded mb-2"/>
    <input type="file" name="image" class="form-control" />
  </div>
  <div class="form-group">
    <label>Makale Başlığı</label>
    <textarea name="content" id="summernote" class="form-control" rows="4">{!!$article->content !!}</textarea>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary btn-block">Makaleyi Güncelle</button>
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
