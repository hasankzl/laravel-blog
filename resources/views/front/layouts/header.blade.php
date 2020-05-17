<!DOCTYPE html>
<html lang="tr">

<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>@yield('title','Devletimiz') - {{$config->title}}</title>
  <link rel="shortcut icon" type="image/png" href="{{asset($config->favicon)}}"/>
  <!-- Bootstrap core CSS -->
  <link href="{{asset('front/')}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="{{asset('front/')}}/css/style.css" rel="stylesheet"/>
  <!-- Custom fonts for this template -->
  <link href="{{asset('front/')}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css' />
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

  <!-- Custom styles for this template -->
  <link href="{{asset('front/')}}/css/clean-blog.min.css" rel="stylesheet" />
  @yield('css')
</head>

<body>
  <nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="{{route('homepage')}}">
      @if($config->logo!=null)
      <img src="{{asset($config->logo)}}" width="100px"/>
      @else
      {{$config->title}}
      @endif
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Kategoriler
          </a>
          <div class="dropdown-menu"  aria-labelledby="navbarDropdown">

              <div class="row drop-link" >
              @foreach($categories as $category)
              <div class="col-md-4 text-center " >
                <a class="dropdown-item drop-link-item" href="/arama/?kategori={{$category->slug}}">{{$category->name}}</a>

              </div>
              @endforeach

          </div>

          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Padisahlar
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <div class="row drop-link" >
            @foreach($padisahs as $link)
            <div class="col-md-4 text-center">
              <a class="dropdown-item drop-link-item" href="/arama/?padisah={{$link->slug}}">{{$link->name}}</a>
            </div>
            @endforeach
          </div>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           Mimarlar
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <div class="row drop-link">
              @foreach($architects as $link)

              <div class="col-md-4 text-center">
                <a class="dropdown-item drop-link-item"href="/arama/?mimar={{$link->slug}}">{{$link->name}}</a>
              </div>
              @endforeach
            </div>

          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Yüzyıllar
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <div class="row drop-link">
              @foreach($centuries as $link)
              <div class="col-md-4 text-center">
                <a class="dropdown-item drop-link-item" href="/arama/?yuzyil={{$link->slug}}">{{$link->name}}</a>
              </div>
              @endforeach
            </div>

          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Şehirler
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <div class="row drop-link">
              @foreach($cities as $link)
              <div class="col-md-4 text-center">
                <a class="dropdown-item drop-link-item"href="/arama/?sehir={{$link->slug}}">{{$link->name}}</a>

              </div>
              @endforeach
            </div>

          </div>
        </li>
        @foreach($pages as $page)
        <li class="nav-item">
          <a class="nav-link" href="{{route('page',$page->slug)}}">{{$page->title}}</a>
        </li>
                @endforeach
        <li class="nav-item">
          <a class="nav-link" href="{{route('contact')}}">İletişim</a>
        </li>
      </ul>
      <form class="" method="get" action="/arama/">
        <div class="input-group">
      <input type="text" class="form-control" placeholder="isime göre arama" name="ad">
      <div class="input-group-btn">
        <button class="btn btn-default" type="submit">
        <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
        </form>
    </div>
  </nav>
  <!-- Page Header -->

  <!-- Main Content -->
  <div class="m-4">
    <div class="">
