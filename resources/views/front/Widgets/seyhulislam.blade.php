@isset($seyhulislams)
      <div class=" text-center mt-5">
        <div class="card w-100 ">
          <div class="card-header">
            Şeyhülislamlar
          </div>
          <div class="list-group list-group-flush">
        @foreach($seyhulislams as $seyhulislam)
        @if(isset($selected['selectedSeyhulislam']) && $selected['selectedSeyhulislam']->slug==$seyhulislam->slug)
        <li class="list-group-item selectedBadge ">
    {{$seyhulislam->name}}
    <span class="badge float-right badge-info">{{$seyhulislam->articleCount()}}</span>
        </li>

        @else
  <a href="{{preg_match('/(seyhulislam)/',URL::full()) ? preg_replace('/'.$selected['selectedSeyhulislam']->slug.'/',$seyhulislam->slug,$_SERVER['REQUEST_URI'])
    :
    $_SERVER['REQUEST_URI'].'&seyhulislam='.$seyhulislam->slug}}">
        <li class="list-group-item ">

    {{$seyhulislam->name}}
    <span class="badge float-right badge-info">{{$seyhulislam->articleCount()}}</span>
        </li>
        </a>
        @endif

        @endforeach
        </div>

      </div>
    </div>
@endisset
