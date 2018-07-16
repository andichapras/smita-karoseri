@extends('adminlte::page')

@section('title', 'Bank')

@section('content_header')
    <h1>Daftar Bank</h1>

@stop

@section('content')
<table id="users-table" class="table table-bordered">
    <thead>
    <tr>
        <th>Id</th>
        <th>Nama Bank</th>
        <th>action</th>
    </tr>
    </thead>
</table>
<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary btn-flat align-right" data-toggle="modal" data-target="#myModal">
    Tambah
</button>
<!--Modal Tambah-->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah Bank</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-bank"></i>
            </span>
            <input id="nama" name="nama" type="text" class="form-control" placeholder="Bank Name">
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Tambah</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div>

    </div>
  </div>
</div>

<!--Modal Tambah-->
<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Bank</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-bank"></i>
            </span>
            <input id="nama" name="nama" type="text" class="form-control" placeholder="Bank Name">
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div>

    </div>
  </div>
</div>

<!--Modal Hapus-->
<div class="modal fade" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Apakah Anda Yakin ingin menghapus?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Hapus</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
      </div>

    </div>
  </div>
</div>
@stop

@section('js')
<script>
    $(function () {
        $('#users-table').DataTable({
            serverSide: true,
            processing: true,
            ajax: '/bank-data',
            columns: [
                {data: 'id'},
                {data: 'nama'},
                {data: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>
@stop
