@isset($categories)
      <div class="col-md-3 text-center">
        <div class="card w-100 ">
          <div class="card-header">
            Kategoriler
          </div>
          <div class="list-group">
        @foreach($categories as $category)
        @if(Request::segment(2)==$category->slug)
        <li class="list-group-item active ">
    {{$category->name}}
    <span class="badge float-right bg-danger text-white">{{$category->articleCount()}}</span>
        </li>

        @else
        <li class="list-group-item ">
  <a href="{{route('category',$category->slug)}}">
    {{$category->name}}</a>
    <span class="badge float-right bg-danger text-white">{{$category->articleCount()}}</span>
        </li>
        @endif

        @endforeach
        </div>

      </div>
@endisset
