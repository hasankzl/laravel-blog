@extends('back.layouts.master')
@section('title','Caddeler')
@section('content')
<div class="row">
<div class="col-md-4">

  <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold float-left text-primary">Yeni Cadde ekle</h6>
  </div>
  <div class="card-body">
<form method="post" action="{{route('admin.avenue.create')}}">
@csrf
<div class="form-group">
  <select class="form-control" name="neighborhood" required>
    <option value="">Mahalle seçiniz</option>
    @foreach($neighborhoods as $neighborhood)
    <option value="{{$neighborhood->id}}">{{$neighborhood->name}}</option>
    @endforeach
  </select>
</div>
<div class="form-group">
<label> Adı</label>
<input type="text" class="form-control" name="avenue" required />
</div>
<div class="form-group">
<button type="submit" class="btn btn-primary btn-block  ">Ekle</button>
</div>
</form>
  </div>
    </div>
</div>
<div class="col-md-8">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold float-left text-primary">@yield('title')</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Mahalle</th>
            <th>Adı</th>
            <th>Makale Sayısı</th>
            <th>İşlemler</th>
          </tr>
        </thead>

        <tbody>
          @foreach($avenues as $avenue)
          <tr>
            <td>{{$avenue->getNeighborhood->name}}</td>
              <td>{{$avenue->name}}</td>
            <td>{{$avenue->articleCount()}}</td>
            <td>
                <a id="edit-click"  avenue-id="{{$avenue->id}}" class="edit-click btn btn-sm btn-primary text-white" title=" düzenle"><i class="fa fa-edit"></i></a>
                <a id="delete-click" avenue-id="{{$avenue->id}}" article-count="{{$avenue->articleCount()}}"  avenue-name="{{$avenue->name}}"  class="delete-click btn btn-sm btn-danger text-white" title=" sil"><i class="fa fa-times"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
    </div>
</div>
<!-- Delete Modal-->
<div class="modal fade" id="deleteModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Kategori Sil</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
<div class="modal-body">
<p><b><span id="delete-cat-name"></span></b> sahip olduğu <b><span id="avenue-count"></span></b> makale bulundu
   silmek istediğinize emin misiniz?</p>
</div>
      <div class="modal-footer">
        <form method="POST" action="{{route('admin.avenue.remove')}}">
          @csrf
          <input type="hidden" name="id" id="delete-id" />
          <button type="submit" class="btn btn-danger" >Sil</button>
        </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
</form>
  </div>
</div>



<!-- Edit Modal-->
<div class="modal fade" id="editModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> Düzenle</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('admin.avenue.update')}}">
          @csrf
          <div class="form-group">
            <label for="neighborhood">Ülke</label>
            <select id="neighborhood_id" class="form-control" name="neighborhood" required>
              <option value="">ülke seçiniz</option>
              @foreach($neighborhoods as $neighborhood)
              <option value="{{$neighborhood->id}}">{{$neighborhood->name}}</option>
              @endforeach
            </select>
          </div>
<div class="form-group">
<label>Kategori Adı</label>
<input id="avenue" type="text" class="form-control" name="avenue" />
<input type="hidden" name="id" id="avenue_id"  />
</div>
<div class="form-group">
<label>Kategori Slug</label>
<input id="slug" type="text" class="form-control" name="slug" />
</div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" >Kaydet</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
</form>
  </div>
</div>

</div>
@endsection
@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
  $(function() {


    $('.delete-click').click(function(){
      var id= $(this)[0].getAttribute('avenue-id');
      var name= $(this)[0].getAttribute('avenue-name');
      if(id==1){
        alert( name +' kategorisi sabit kategoridir silinemez')
      }
      else{
        var avenueCount= $(this)[0].getAttribute('article-count');
        $('#avenue-count').html(avenueCount);
            $('#delete-cat-name').html(name);
            $('#delete-id').val(id);
            $('#deleteModal').modal();
      }
    })

    $('.edit-click').click(function(){
      var id= $(this)[0].getAttribute('avenue-id');
      $.ajax({
        type:'GET',
        url:'{{route('admin.avenue.get.data')}}',
        data:{id:id},
        success:function(data){
          $('#avenue').val(data.name);
          $('#slug').val(data.slug);
          $('#avenue_id').val(data.id);
          $('#neighborhood_id').val(data.neighborhood_id);
          $('#editModal').modal();
        }
      });
    })
  })
</script>
@endsection
