@isset($architects)
      <div class=" text-center mt-5">
        <div class="card w-100 ">
          <div class="card-header">
            Mimarlar
          </div>
          <div class="list-group list-group-flush">
        @foreach($architects as $architect)
        @if( isset($selected['selectedArchitect']) && $selected['selectedArchitect']->slug==$architect->slug)
        <li class="list-group-item selectedBadge ">
    {{$architect->name}}
    <span class="badge float-right badge-info ">{{$architect->articleCount()}}</span>
        </li>

        @else
  <a href="{{preg_match('/(mimar)/',URL::full()) ? preg_replace('/'.$selected['selectedArchitect']->slug.'/',$architect->slug,$_SERVER['REQUEST_URI'])
    :
    $_SERVER['REQUEST_URI'].'&mimar='.$architect->slug}}">
        <li class="list-group-item ">

    {{$architect->name}}
    <span class="badge float-right badge-info">{{$architect->articleCount()}}</span>
        </li>
        </a>
        @endif

        @endforeach
        </div>

      </div>
    </div>
@endisset
