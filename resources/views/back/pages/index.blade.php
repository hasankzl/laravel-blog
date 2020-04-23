@extends('back.layouts.master')
@section('title','Tüm Sayfalar')
@section('content')

<div class="card shadow mb-4">
  <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold float-left text-primary">@yield('title')</h6>
    <h6 class="m-0 font-weight-bold float-right text-primary">{{$pages->count()}} Makale Bulundu
    </h6>
  </div>
  <div class="card-body">
    <div id="orderSuccess" style="Display:none" class="alert alert-success">
      Sıralama başarıyla güncellendi
    </div>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Sıralama</th>
            <th>Fotoğraf</th>
            <th>Makale Başlığı</th>
          <th>Durum</th>
            <th>İşlemler   </th>
          </tr>
        </thead>

        <tbody id="orders">
          @foreach($pages as $page)
          <tr id="page_{{$page->id}}">
            <td class="handle text-center text-primary mt-auto" style="cursor:move;width:5px;margin-top:30px;">
<i class="fa fa-3x fa-arrows-alt-v" />
            </td>
            <td>
              <img src="{{asset($page->image)}}" width="200" />
            </td>
            <td>{{$page->title}}</td>
            <td><input class="switch" type="checkbox" page-id="{{$page->id}}" @if($page->status==1) checked @endif data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Aktif" data-off="Pasif"></td>
            <td>
              <a target="_blank" href="{{route('page',$page->slug)}}"  title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
              <a href="{{route('admin.page.edit',$page->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
              <a href="{{route('admin.page.delete',$page->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.10.1/Sortable.min.js" integrity="sha256-9D6DlNlpDfh0C8buQ6NXxrOdLo/wqFUwEB1s70obwfE=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
$('#orders').sortable({
handle:'.handle',
update:function(){
var siralama=  $('#orders').sortable('serialize');
$.get("{{route('admin.page.orders')}}?"+siralama,function(data,status){
  $('#orderSuccess').show();
  setTimeout(function(){$('#orderSuccess').fadeOut();},2000);
  console.log(data)
});
}
});
</script>
<script>
  $(function() {
    $('.switch').change(function() {
      var id= $(this)[0].getAttribute('page-id');
      var statu=$(this).prop('checked');
$.get("{{route('admin.page.switch',)}}",{id:id,statu:statu});
    })
  })
</script>
@endsection
