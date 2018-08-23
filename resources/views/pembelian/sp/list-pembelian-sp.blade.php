@extends('adminlte::page')

@section('title', 'List Invoice')

@section('content_header')
    <h1>List Pembelian SP</h1>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('/datepicker/css/bootstrap-datepicker.min.css') }}">
@stop

@section('content')
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalInput">Input Tanggal Penjualan</button>
<br><br>
<form action="" method="post">
<table id="list-invoice-table" class="table responsive" width="100%">
    <thead>
    <tr>
        <th>No Penjualan</th>
        <th>Sales</th>
        <th>Hp Kios</th>
        <th>Nama Kios</th>
        <th>Tanggal Penjualan</th>
        <th>Status Verifikasi</th>
        <th>Action</th>
    </tr>
    </thead>
</table>
</form>

<!--Modal input-->
<div class="modal fade bs-example-modal-lg" id='modalInput' tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Input Penjualan SP</h4>
      </div>
      <div class="modal-body">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <br />

                <form id="editForm" method="POST" data-parsley-validate class="form-horizontal form-label-left" action="">
                  @csrf @method('put')
                  <div class="form-group kode">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pilih Tanggal
                      <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="datepicker col-md-7 col-xs-12" name="tgl" id="tgl" data-date-format="dd-mm-yyyy" required value="">
                    </div>
                  </div>

                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button class="btn btn-primary" type="reset"> <i class="fa fa-repeat"></i> Kosongkan</button>
                      <button id="show" class="btn btn-success" type="button" data-dismiss="modal"> </i> Tampilkan List Penjualan</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--Modal Verifikasi-->
<div class="modal fade" id="verificationModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" method="POST" id="verificationForm">
        @csrf @method('put')
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Apakah Anda Yakin ingin memverifikasi transaksi ini?</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-success">Verifikasi</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--Modal Hapus-->
<div class="modal fade" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="deleteForm" action="" method="POST">
        @csrf @method('delete')
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Apakah Anda Yakin ingin menghapus?</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <input type="submit" class="btn btn-danger" value="Hapus">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
        </div>
      </form>
    </div>
  </div>
</div>

@stop

@section('js')
<script src="{{ asset('/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
  $('.datepicker').datepicker({
  });
</script>
<script>
    $(function () {
        $tgl_penjualan = ($('#tgl').val()=='') ? 'null' : $('#tgl').val();
        var t = $('#list-invoice-table').DataTable({
            serverSide: true,
            processing: true,
            ajax: `/invoice_dompul/list/${$tgl_penjualan}`,
            columns: [
                // {data: 'indeks'},
                {data: 'id_penjualan_dompul'},
                {data: 'nm_sales'},
                {data: 'no_hp_kios'},
                {data: 'nm_cust'},
                {data: 'tanggal_penjualan_dompul'},
                {data: 'status_verif'},
                {data: 'action', orderable: false, searchable: false}
            ]
        });
</script>
@stop
