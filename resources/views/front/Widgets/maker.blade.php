@isset($makers)
      <div class=" text-center mt-5">
        <div class="card w-100 ">
          <div class="card-header">
            Yaptıranlar
          </div>
          <div class="list-group list-group-flush">
        @foreach($makers as $maker)
        @if(isset($selected['selectedMaker']) && $selected['selectedMaker']->slug==$maker->slug)
        <li class="list-group-item selectedBadge ">
    {{$maker->name}}
    <span class="badge float-right badge-info ">{{$maker->articleCount()}}</span>
        </li>

        @else
  <a href="{{preg_match('/(yaptiran)/',URL::full()) ? preg_replace('/'.$selected['selectedMaker']->slug.'/',$maker->slug,$_SERVER['REQUEST_URI'])
    :
    $_SERVER['REQUEST_URI'].'&yaptiran='.$maker->slug}}">
        <li class="list-group-item ">

    {{$maker->name}}
    <span class="badge float-right badge-info ">{{$maker->articleCount()}}</span>
        </li>
        </a>
        @endif

        @endforeach
        </div>

      </div>
    </div>
@endisset
