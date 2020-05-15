@isset($categories)
      <div class=" text-center">
        <div class="card w-100 ">
          <div class="card-header">
            Kategoriler
          </div>
          <div class="list-group list-group-flush">
        @foreach($categories as $category)

        @if( isset($selected['selectedCategory']) && $selected['selectedCategory']->slug ==$category->slug)
        <li class="list-group-item selectedBadge">
    {{$category->name}}
    <span class="badge float-right badge-info">{{$category->articleCount()}}</span>
        </li>

        @else
  <a href="{{preg_match('/(kategori)/',URL::full()) ? preg_replace('/'.$selected['selectedCategory']->slug.'/',$category->slug,$_SERVER['REQUEST_URI'])
    :
    $_SERVER['REQUEST_URI'].'&kategori='.$category->slug}}">
        <li class="list-group-item ">

    {{$category->name}}
    <span class="badge float-right badge-info">{{$category->articleCount()}}</span>
        </li>
        </a>
        @endif

        @endforeach
        </div>

      </div>
    </div>
@endisset
