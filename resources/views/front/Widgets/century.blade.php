@isset($centuries)
      <div class=" text-center mt-5">
        <div class="card w-100 ">
          <div class="card-header">
            Yüzyıllar
          </div>
          <div class="list-group list-group-flush">
        @foreach($centuries as $century)
        @if(isset($selected['selectedCentury']) && $selected['selectedCentury']->slug==$century->slug)
        <li class="list-group-item selectedBadge">
    {{$century->name}}
    <span class="badge float-right badge-info ">{{$century->articleCount()}}</span>
        </li>

        @else
  <a href="{{preg_match('/(yuzyil)/',URL::full()) ? preg_replace('/'.$selected['selectedCentury']->slug.'/',$century->slug,$_SERVER['REQUEST_URI'])
    :
    $_SERVER['REQUEST_URI'].'&yuzyil='.$century->slug}}">
        <li class="list-group-item ">

    {{$century->name}}
    <span class="badge float-right badge-info">{{$century->articleCount()}}</span>
        </li>
        </a>
        @endif

        @endforeach
        </div>

      </div>
    </div>
@endisset
