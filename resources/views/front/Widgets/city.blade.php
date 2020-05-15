@isset($makers)
      <div class=" text-center mt-5">
        <div class="card w-100 ">
          <div class="card-header">
            Şehirler
          </div>
          <div class="list-group list-group-flush">
        @foreach($cities as $city)
        @if(isset($selected['selectedCity']) && $selected['selectedCity']->slug==$city->slug)
        <li class="list-group-item selectedBadge ">
    {{$city->name}}
    <span class="badge float-right badge-info">{{$city->articleCount()}}</span>
        </li>

        @else
        <a href="{{preg_match('/(sehir)/',URL::full()) ? preg_replace('/'.$selected['selectedCity']->slug.'/',$city->slug,$_SERVER['REQUEST_URI'])
          :
          $_SERVER['REQUEST_URI'].'&sehir='.$city->slug}}">
        <li class="list-group-item ">

    {{$city->name}}
    <span class="badge float-right badge-info">{{$city->articleCount()}}</span>
        </li>
        </a>
        @endif

        @endforeach
        </div>

      </div>
    </div>
@endisset
