@extends('back.layouts.master')
@section('title','Mimarlar')
@section('content')
<div class="row">
<div class="col-md-4">

  <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold float-left text-primary">Yeni Mimar ekle</h6>
  </div>
  <div class="card-body">
<form method="post" action="{{route('admin.architect.create')}}">
@csrf
<div class="form-group">
<label> Adı</label>
<input type="text" class="form-control" name="architect" required />
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
            <th>Adı</th>
            <th>Makale Sayısı</th>
            <th>İşlemler</th>
          </tr>
        </thead>

        <tbody>
          @foreach($architects as $architect)
          <tr>
            <td>{{$architect->name}}</td>
            <td>{{$architect->articleCount()}}</td>
            <td>
                <a id="edit-click"  architect-id="{{$architect->id}}" class="edit-click btn btn-sm btn-primary text-white" title=" düzenle"><i class="fa fa-edit"></i></a>
                <a id="delete-click" architect-id="{{$architect->id}}" article-count="{{$architect->articleCount()}}"  architect-name="{{$architect->name}}"  class="delete-click btn btn-sm btn-danger text-white" title=" sil"><i class="fa fa-times"></i></a>
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
<p><b><span id="delete-cat-name"></span></b> sahip olduğu <b><span id="architect-count"></span></b> makale bulundu
   silmek istediğinize emin misiniz?</p>
</div>
      <div class="modal-footer">
        <form method="POST" action="{{route('admin.architect.remove')}}">
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
        <form method="post" action="{{route('admin.architect.update')}}">
          @csrf
<div class="form-group">
<label>Kategori Adı</label>
<input id="architect" type="text" class="form-control" name="architect" />
<input type="hidden" name="id" id="architect_id"  />
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
      var id= $(this)[0].getAttribute('architect-id');
      var name= $(this)[0].getAttribute('architect-name');
      if(id==1){
        alert( name +' kategorisi sabit kategoridir silinemez')
      }
      else{
        var architectCount= $(this)[0].getAttribute('article-count');
        $('#architect-count').html(architectCount);
            $('#delete-cat-name').html(name);
            $('#delete-id').val(id);
            $('#deleteModal').modal();
      }
    })

    $('.edit-click').click(function(){
      var id= $(this)[0].getAttribute('architect-id');
      $.ajax({
        type:'GET',
        url:'{{route('admin.architect.get.data')}}',
        data:{id:id},
        success:function(data){
          $('#architect').val(data.name);
          $('#slug').val(data.slug);
          $('#architect_id').val(data.id);
          $('#editModal').modal();
        }
      });
    })
  })
</script>
@endsection
