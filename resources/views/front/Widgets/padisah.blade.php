@isset($padisahs)
      <div class=" text-center mt-5">
        <div class="card w-100 ">
          <div class="card-header">
            Padişahlar
          </div>
          <div class="list-group list-group-flush">
        @foreach($padisahs as $padisah)
        @if(isset($selected['selectedPadisah']) && $selected['selectedPadisah']->slug==$padisah->slug)
        <li class="list-group-item selectedBadge ">
    {{$padisah->name}}
    <span class="badge float-right badge-info">{{$padisah->articleCount()}}</span>
        </li>

        @else
  <a href="{{preg_match('/(padisah)/',URL::full()) ? preg_replace('/'.$selected['selectedPadisah']->slug.'/',$padisah->slug,$_SERVER['REQUEST_URI'])
    :
    $_SERVER['REQUEST_URI'].'&padisah='.$padisah->slug}}">
        <li class="list-group-item ">

    {{$padisah->name}}
    <span class="badge float-right badge-info">{{$padisah->articleCount()}}</span>
        </li>
        </a>
        @endif

        @endforeach
        </div>

      </div>
    </div>
@endisset
