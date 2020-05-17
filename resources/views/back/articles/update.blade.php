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
    <label>Durum</label>
    <select class="form-control" name="status" required>
<option value="">
seçim yapınız
</option>
@foreach($statuses as $status)
<option @if($status->id ==$article->status_id) selected  @endif value="{{$status->id}}">{{$status->name}}</option>
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
      <label>Padisah</label>
      <select class="form-control" name="padisah" required>
  <option value="">
  Padisah Seçiniz
  </option>
  @foreach($padisahs as $padisah)
  <option  @if($padisah->id ==$article->padisah_id) selected  @endif value="{{$padisah->id}}">{{$padisah->name}}</option>
  @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Şeyhülislam</label>
      <select class="form-control" name="seyhulislam" required>
  <option value="">
  şeyhülislam seçiniz
  </option>
  @foreach($seyhulislams as $seyhulislam)
  <option  @if($seyhulislam->id ==$article->seyhulislam_id) selected  @endif value="{{$seyhulislam->id}}">{{$seyhulislam->name}}</option>
  @endforeach
      </select>
    </div>

    <div class="form-group">
      <label>Mimar</label>
      <select class="form-control" name="architect" required>
  <option value="">
  mimar seçiniz
  </option>
  @foreach($architects as $architect)
  <option  @if($architect->id ==$article->architect_id) selected  @endif value="{{$architect->id}}">{{$architect->name}}</option>
  @endforeach
      </select>
    </div>


    <div class="form-group">
      <label>Yüzyıl</label>

      <div class="row">
        <div class="col-md-8">
          <select class="form-control" name="century" required>
      <option value=""> yüzyıl seçiniz
      </option>
      @foreach($centuries as $century)
      <option  @if($century->id ==$article->century_id) selected  @endif value="{{$century->id}}">{{$century->name}}</option>
      @endforeach
          </select>
        </div>
        <div class="col-md-4">
              <input type="text" name="year" value="{{$article->year}}" placeholder="yıl veya çeyrek giriniz" class="form-control" required/>
        </div>
      </div>
    </div>

  <div class="form-group">
    <label>Adres</label>
    <div class="row">
      <div class="col-md-2">
        <label for="country"> Ülke</label>
        <select class="form-control" name="country" required>
        <option value="">
        Ülke seçiniz seçiniz
        </option>
        @foreach($countries as $country)
        <option @if($country->id ==$article->country_id) selected  @endif value="{{$country->id}}">{{$country->name}}</option>
        @endforeach
        </select>
      </div>
<div class="col-md-2">
  <label for="city"> Şehir</label>

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
<div class="col-md-2">
  <label for="district"> İlçe</label>
  <select class="form-control" name="district" required>
  <option value="">
  ilçe seçiniz
  </option>
  @foreach($districts as $district)
  <option @if($district->id ==$article->district_id) selected  @endif value="{{$district->id}}">{{$district->name}}</option>
  @endforeach
  </select>
</div>
<div class="col-md-2">
  <label for="semt"> Semt</label>
  <select class="form-control" name="semt" required>
  <option value="">
  semt seçiniz
  </option>
  @foreach($semts as $semt)
  <option @if($semt->id ==$article->semt_id) selected  @endif value="{{$semt->id}}">{{$semt->name}}</option>
  @endforeach
  </select>
</div>
<div class="col-md-2">
  <label for="village"> Köy</label>
  <select class="form-control" name="village" required>
  <option value="">
  köy seçiniz
  </option>
  @foreach($villages as $village)
  <option @if($village->id ==$article->village_id) selected  @endif value="{{$village->id}}">{{$village->name}}</option>
  @endforeach
  </select>
</div>
<div class="col-md-2">
  <label for="neighborhood"> Mahalle</label>
  <select class="form-control" name="neighborhood" required>
  <option value="">
  mahalle seçiniz
  </option>
  @foreach($neighborhoods as $neighborhood)
  <option @if($neighborhood->id ==$article->neighborhood_id) selected  @endif value="{{$neighborhood->id}}">{{$neighborhood->name}}</option>
  @endforeach
  </select>
</div>
<div class="col-md-3 mt-3">
  <label for="avenue"> Cadde</label>
  <select class="form-control" name="avenue" required>
  <option value="">
  cadde seçiniz
  </option>
  @foreach($avenues as $avenue)
  <option @if($avenue->id ==$article->avenue_id) selected  @endif value="{{$avenue->id}}">{{$avenue->name}}</option>
  @endforeach
  </select>
</div>
<div class="col-md-3 mt-3">
  <label for="street"> Sokak</label>
  <select class="form-control" name="street" required>
  <option value="">
  sokak seçiniz
  </option>
  @foreach($streets as $street)
  <option @if($street->id ==$article->street_id) selected  @endif value="{{$street->id}}">{{$street->name}}</option>
  @endforeach
  </select>
</div>
<div class="col-md-6 mt-3">
  <label for="fullAddress"> Tam Adres</label>
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
    <label>Galeri Fotoğrafları</label>
    <input type="file" name="file[]" class="form-control" multiple />
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

  jQuery('select[name="country"]').on('change',function(){
    var countryID = jQuery(this).val();
    if(countryID){
      jQuery.ajax({
        url:"{{route('address.cities','')}}"+"/"+countryID,
        type:"GET",
        dataType:"json",
        success:function(data)
        {
          jQuery('select[name="city"]').empty();
$('select[name="city"]').append('<option value="1">Belirtilmedi</option>');
          jQuery.each(data,function(key,value){
            $('select[name="city"]').append('<option value="'+key+'">'+value+'</option>')
          })
        }
      })
    }
    else{
      $('select[name="city"]').empty();
$('select[name="city"]').append('<option value="1">Belirtilmedi</option>');
    }
  })


  jQuery('select[name="city"]').on('change',function(){
    var countryID = jQuery(this).val();
    if(countryID){
      jQuery.ajax({
        url:"{{route('address.semts','')}}"+"/"+countryID,
        type:"GET",
        dataType:"json",
        success:function(data)
        {
          jQuery('select[name="semt"]').empty();
  $('select[name="semt"]').append('<option value="1">Belirtilmedi</option>');
          jQuery.each(data,function(key,value){
            $('select[name="semt"]').append('<option value="'+key+'">'+value+'</option>')
          })
        }
      })

      jQuery.ajax({
        url:"{{route('address.districts','')}}"+"/"+countryID,
        type:"GET",
        dataType:"json",
        success:function(data)
        {
          jQuery('select[name="district"]').empty();
  $('select[name="district"]').append('<option value="1">Belirtilmedi</option>');
          jQuery.each(data,function(key,value){
            $('select[name="district"]').append('<option value="'+key+'">'+value+'</option>')
          })
        }
      })

    }
    else{
      $('select[name="semt"]').empty();
  $('select[name="semt"]').append('<option value="1">Belirtilmedi</option>');
  $('select[name="district"]').empty();
$('select[name="district"]').append('<option value="1">Belirtilmedi</option>');

    }
  })

      jQuery('select[name="district"]').on('change',function(){
        var countryID = jQuery(this).val();
        if(countryID){
          jQuery.ajax({
            url:"{{route('address.neighborhoods','')}}"+"/"+countryID,
            type:"GET",
            dataType:"json",
            success:function(data)
            {
              jQuery('select[name="neighborhood"]').empty();
              $('select[name="neighborhood"]').append('<option value="1">Belirtilmedi</option>');
              jQuery.each(data,function(key,value){
                $('select[name="neighborhood"]').append('<option value="'+key+'">'+value+'</option>')
              })
            }
          })

          jQuery.ajax({
            url:"{{route('address.villages','')}}"+"/"+countryID,
            type:"GET",
            dataType:"json",
            success:function(data)
            {
              jQuery('select[name="village"]').empty();
              $('select[name="village"]').append('<option value="1">Belirtilmedi</option>');
              jQuery.each(data,function(key,value){
                $('select[name="village"]').append('<option value="'+key+'">'+value+'</option>')
              })
            }
          })
    }
    else{
      $('select[name="neighborhood"]').empty();
$('select[name="neighborhood"]').append('<option value="1">Belirtilmedi</option>');
$('select[name="village"]').empty();
$('select[name="village"]').append('<option value="1">Belirtilmedi</option>');
    }
  })


  jQuery('select[name="neighborhood"]').on('change',function(){
    var countryID = jQuery(this).val();
    if(countryID){
      jQuery.ajax({
        url:"{{route('address.avenues','')}}"+"/"+countryID,
        type:"GET",
        dataType:"json",
        success:function(data)
        {
          jQuery('select[name="avenue"]').empty();
  $('select[name="avenue"]').append('<option value="1">Belirtilmedi</option>');
          jQuery.each(data,function(key,value){
            $('select[name="avenue"]').append('<option value="'+key+'">'+value+'</option>')
          })
        }
      })
    }
    else{
      $('select[name="avenue"]').empty();
  $('select[name="avenue"]').append('<option value="1">Belirtilmedi</option>');
    }
  })


  jQuery('select[name="avenue"]').on('change',function(){
    var countryID = jQuery(this).val();
    if(countryID){
      jQuery.ajax({
        url:"{{route('address.streets','')}}"+"/"+countryID,
        type:"GET",
        dataType:"json",
        success:function(data)
        {
          jQuery('select[name="street"]').empty();
  $('select[name="street"]').append('<option value="1">Belirtilmedi</option>');
          jQuery.each(data,function(key,value){
            $('select[name="street"]').append('<option value="'+key+'">'+value+'</option>')
          })
        }
      })
    }
    else{
      $('select[name="street"]').empty();
  $('select[name="street"]').append('<option value="1">Belirtilmedi</option>');
    }
  })
});
</script>
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@endsection
