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
  <option value="1">
seçim yapınız
</option>
@foreach($categories as $category)
<option value="{{$category->id}}">{{$category->name}}</option>
@endforeach
    </select>
  </div>
  <div class="form-group">
    <label>Durum</label>
    <select class="form-control" name="status" required>
  <option value="1">
seçim yapınız
</option>
@foreach($statuses as $status)
<option value="{{$status->id}}">{{$status->name}}</option>
@endforeach
    </select>
  </div>
  <div class="form-group">
    <label>Yapan Kişi/Kurum</label>
    <select class="form-control" name="maker" required>
  <option value="1">
seçim yapınız
</option>
@foreach($makers as $maker)
<option value="{{$maker->id}}">{{$maker->name}}</option>
@endforeach
    </select>
  </div>

  <div class="form-group">
    <label>Padisah</label>
    <select class="form-control" name="padisah" required>
  <option value="1">
Padisah Seçiniz
</option>
@foreach($padisahs as $padisah)
<option value="{{$padisah->id}}">{{$padisah->name}}</option>
@endforeach
    </select>
  </div>
  <div class="form-group">
    <label>Şeyhülislam</label>
    <select class="form-control" name="seyhulislam" required>
  <option value="1">
şeyhülislam seçiniz
</option>
@foreach($seyhulislams as $seyhulislam)
<option value="{{$seyhulislam->id}}">{{$seyhulislam->name}}</option>
@endforeach
    </select>
  </div>

  <div class="form-group">
    <label>Mimar</label>
    <select class="form-control" name="architect" required>
  <option value="1">
mimar seçiniz
</option>
@foreach($architects as $architect)
<option value="{{$architect->id}}">{{$architect->name}}</option>
@endforeach
    </select>
  </div>


  <div class="form-group">
    <label>Yüzyıl</label>

    <div class="row">
      <div class="col-md-8">
        <select class="form-control" name="century" required>
      <option value="1"> yüzyıl seçiniz
    </option>
    @foreach($centuries as $century)
    <option value="{{$century->id}}">{{$century->name}}</option>
    @endforeach
        </select>
      </div>
      <div class="col-md-4">
            <input type="text" name="year" placeholder="yıl veya çeyrek giriniz" class="form-control" required/>
      </div>
    </div>
  </div>

  <div class="form-group">
      <label for="">Adres</label>
<div class="row">
  <div class="col-md-2">
      <label for="country"> Ülke</label>
    <select class="form-control" name="country" required>
      <option value="1">
    Ülke seçiniz
    </option>
    @foreach($countries as $country)
    <option value="{{$country->id}}">{{$country->name}}</option>
    @endforeach
    </select>
  </div>
<div class="col-md-2">
    <label for="city"> Şehir</label>
  <select class="form-control" name="city" required>
    <option value="1">
  sehir seçiniz
  </option>
  @foreach($cities as $city)
  <option value="{{$city->id}}">{{$city->name}}</option>
  @endforeach
  </select>
</div>
<div class="col-md-2">
    <label for="district"> İlçe</label>
  <select class="form-control" name="district" >
    <option value="1">
  ilçe seçiniz
  </option>
  @foreach($districts as $district)
  <option value="{{$district->id}}">{{$district->name}}</option>
  @endforeach
  </select>
</div>
<div class="col-md-2">
    <label for="semt"> Semt</label>
  <select class="form-control" name="semt" >
    <option value="1">
  semt seçiniz
  </option>
  @foreach($semts as $semt)
  <option value="{{$semt->id}}">{{$semt->name}}</option>
  @endforeach
  </select>
</div>
<div class="col-md-2">
  <label for="neighborhood"> Köy</label>
  <select class="form-control" name="village" >
    <option value="1">
  köy seçiniz
  </option>
  @foreach($villages as $village)
  <option value="{{$village->id}}">{{$village->name}}</option>
  @endforeach
  </select>
</div>
<div class="col-md-2">
  <label for="neighborhood"> Mahalle</label>
  <select class="form-control" name="neighborhood" >
    <option value="1">
  mahalle seçiniz
  </option>
  @foreach($neighborhoods as $neighborhood)
  <option value="{{$neighborhood->id}}">{{$neighborhood->name}}</option>
  @endforeach
  </select>
</div>
<div class="col-md-3 mt-3">
    <label for="avenue"> Cadde</label>
  <select class="form-control" name="avenue" >
    <option value="1">
  cadde seçiniz
  </option>
  @foreach($avenues as $avenue)
  <option value="{{$avenue->id}}">{{$avenue->name}}</option>
  @endforeach
  </select>
</div>
<div class="col-md-3 mt-3">
    <label for="street"> Sokak</label>
  <select class="form-control" name="street" >
    <option value="1">
  sokak seçiniz
  </option>
  @foreach($streets as $street)
  <option value="{{$street->id}}">{{$street->name}}</option>
  @endforeach
  </select>
</div>
<div class="col-md-6 mt-3">
    <label for="fullAddress"> Tam adresi</label>
<input type="text" name="fullAddress" class="form-control" value="" required placeholder="tam adresi giriniz"/>
</div>
</div>
  </div>
  <div class="form-group">
    <label>Makale Fotoğrafı</label>
    <input type="file" name="image" class="form-control" required />
  </div>
  <div class="form-group">
    <label>Galeri Fotoğrafları</label>
    <input type="file" name="file[]" class="form-control" multiple required />
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
