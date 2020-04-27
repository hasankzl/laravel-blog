@extends('front.layouts.master')
@section('title','İletişim')
@section('content')
@section('bg','https://p0.pxfuel.com/preview/1013/721/141/contact-details-smartphone-business-contact-us-royalty-free-thumbnail.jpg')

<div class=" col-md-12 ">
  @if(session('success'))
  <div class="alert alert-success">
    {{session('success')}}
  </div>
  @endif
  @if($errors->any())
  <div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)

<li>{{$error}}</li>
@endforeach
</ul>
  </div>
  @endif
  <form name="sentMessage" id="contactForm" method="post" action="{{route('contact.post')}}" >
    @csrf
    <div class="control-group">
      <div class="form-group  controls">
        <label>Ad Soyad</label>
        <input type="text" class="form-control" value="{{old('name')}}" placeholder="Ad Soyadınız"name="name" required >
        <p class="help-block text-danger"></p>
      </div>
    </div>
    <div class="control-group">
      <div class="form-group  controls">
        <label>Email</label>
        <input type="email" class="form-control" placeholder="Email adresiniz" value="{{old('email')}}" name="email" required >
        <p class="help-block text-danger"></p>
      </div>
    </div>
    <div class="control-group">
      <div class="form-group col-xs-12 controls">
        <label>Konu</label>
        <select class="form-control" name="topic">
          <option @if(old('topic')=="Bilgi") selected @endif>  Bilgi  </option>
          <option @if(old('topic')=="Destek") selected @endif>  Destek  </option>
          <option @if(old('topic')=="Genel") selected @endif>  Genel  </option>
        </select>
          <p class="help-block text-danger"></p>
      </div>
    </div>
    <div class="control-group">
      <div class="form-group  controls">
        <label>Mesajınız</label>
        <textarea rows="5" class="form-control" placeholder="Message" name="message" required data-validation-required-message="Mesajınızı Giriniz">
          {{old('message')}}
        </textarea>
        <p class="help-block text-danger"></p>
      </div>
    </div>
    <br>
    <div id="success"></div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary" id="sendMessageButton">Gönder</button>
    </div>
  </form>
</div>

@endsection
