@extends('adminlte::page')

@section('title', 'Penjualan Dompul')

@section('content_header')
    <h1>Tambah Penjualan Dompul RO</h1>
@stop

@section('css')
<style>
td{
  background-color: white;
}
</style>
@stop

@section('content')
<div class="container-fluid">
  @isset($datas)
    <input type="hidden" name="tgl" id="tgl" value="{{$datas->tanggal_transfer}}">
  @endisset
  <div class="row">
    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
      <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
        HP Sales :
      </div>
      <div class="col-xs-6 col-sm-6 col-md-8 col-lg-8">
        @isset($datas)
           {{$datas->no_hp_canvasser}}
        @endisset
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
      <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
        Nama Sales :
      </div>
      <div class="col-xs-6 col-sm-6 col-md-8 col-lg-8">
        @isset($datas)
          <input type="text" name="canvasser" id="canvasser" value="{{$datas->nama_canvasser}}" disabled>
        @endisset
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
      <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
        HP Kios :
      </div>
      <div class="col-xs-6 col-sm-6 col-md-8 col-lg-8">
        @isset($datas)
          {{$datas->no_hp_downline}}
        @endisset
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
      <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
        Nama Kios :
      </div>
      <div class="col-xs-6 col-sm-6 col-md-8 col-lg-8">
        @isset($datas)
        <input type="text" name="downline" id="downline" value="{{$datas->nama_downline}}" disabled>
        @endisset
      </div>
    </div>
  </div>
</div>
<form class="invoice-dompul repeater" action="/penjualan/dompul/verify/{{$datas->nama_canvasser}}/{{$datas->tanggal_transfer}}/{{$datas->nama_downline}}" method="post">
  @csrf
<table id="invoice-dompul-table" class="table responsive"  width="100%">
    <thead>
    <tr>
        {{-- <th>No</th> --}}
        <th>Uraian</th>
        <th>Tipe</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Jumlah Program</th>
        <th>Harga Total</th>
        <th>Action</th>
    </tr>
    </thead>
</table>
<div class="container-fluid" style="background:white;">
  <div class="row" style="border:1px solid; padding:5px;">
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">

    </div>
    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
      <b>Jumlah Tunai</b>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
      @isset($total)
        {{$total}}
      @endisset
    </div>
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
      <button data-repeater-create type="button" class="btn btn-warning"> <span class="glyphicon glyphicon-plus"></span> Tambah Pembayaran</button>
    </div>
  </div>
  <div data-repeater-list="group-a">
  <div data-repeater-item>
  <div class="row" style="border:1px solid; padding:3px;">
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">

    </div>
    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
      <b>Bank Transfer</b>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
      <select name="bank">
        <option value="">-- pilih bank --</option>
        <option value="BCA Pusat">BCA Pusat</option>
        <option value="BCA Cabang">BCA Cabang</option>
        <option value="BRI">BRI</option>
        <option value="BNI">BNI</option>
        <option value="Mandiri">Mandiri</option>
      </select>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">

    </div>
  </div>
  <div class="row" style="border:1px solid; padding:3px;">
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">

    </div>
    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
      <b>Jumlah Transfer</b>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
      <input type="text" id="trf3" name="trf" class="form-control" value="">
    </div>
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
      <button data-repeater-delete type="button" class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span> Delete</button>
    </div>
  </div>
</div>
</div>
<div class="row" style="border:1px solid; padding:3px;">
  <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">

  </div>
  <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
    <b>Catatan</b>
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <input type="text" id="catatan" required="required" name="catatan" class="form-control" value="">
  </div>
  <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">

  </div>
</div>
<div class="row">
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">

  </div>
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

  </div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">

  </div>
  <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
    <br>
    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Lanjutkan</button>
    <br><br>
  </div>
</div>
</div>
</form>

<!--Modal Edit-->
<div class="modal fade bs-example-modal-lg" id='editModal' tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Edit Tipe</h4>
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

                <form id="editForm" method="POST" data-parsley-validate class="form-horizontal form-label-left" action="/invoice_dompul/update/{{$datas->nama_canvasser}}/{{$datas->tanggal_transfer}}/{{$datas->nama_downline}}/{{$datas->produk}}">
                  @csrf @method('put')
                  <div class="form-group kode">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tipe Dompul
                      <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select name="tipe" required="required" id="tipe">

                      </select>
                    </div>
                  </div>

                  <div class="form-group nama">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Qty Program
                      <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" required="required" name="qty_program" class="form-control col-md-7 col-xs-12" value="">
                    </div>
                  </div>


                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button class="btn btn-primary" type="reset">Reset</button>
                      <input type="submit" class="btn btn-success" value="Simpan">
                      {{-- <button type="button" class="btn btn-primary" data-dismiss="modal">Simpan</button> --}}
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

@stop

@section('js')
<script>
    $(document).ready(function () {
        $('.repeater').repeater({
            // (Optional)
            // start with an empty list of repeaters. Set your first (and only)
            // "data-repeater-item" with style="display:none;" and pass the
            // following configuration flag
            // initEmpty: true,
            // (Optional)
            // "defaultValues" sets the values of added items.  The keys of
            // defaultValues refer to the value of the input's name attribute.
            // If a default value is not specified for an input, then it will
            // have its value cleared.
            // defaultValues: {
            //     'text-input': 'foo'
            // },
            // (Optional)
            // "show" is called just after an item is added.  The item is hidden
            // at this point.  If a show callback is not given the item will
            // have $(this).show() called on it.
            show: function () {
                $(this).slideDown();
            },
            // (Optional)
            // "hide" is called when a user clicks on a data-repeater-delete
            // element.  The item is still visible.  "hide" is passed a function
            // as its first argument which will properly remove the item.
            // "hide" allows for a confirmation step, to send a delete request
            // to the server, etc.  If a hide callback is not given the item
            // will be deleted.
            hide: function (deleteElement) {
                if(confirm('Apakah anda yakin ingin menghapus pesanan SP ini?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            // (Optional)
            // You can use this if you need to manually re-index the list
            // for example if you are using a drag and drop library to reorder
            // list items.
            // ready: function (setIndexes) {
            //     $dragAndDrop.on('drop', setIndexes);
            // },
            // (Optional)
            // Removes the delete button from the first list item,
            // defaults to false.
            isFirstItemUndeletable: false
        })
    });
</script>
<script>
    $(function () {
        var tgl = $('#tgl').val();
        var canvaser = $('#canvasser').val();
        var downline = $('#downline').val();
        var t = $('#invoice-dompul-table').DataTable({
                  serverSide: true,
                  processing: true,
                  paging:false,
                  info:false,
                  ajax: `/edit_invoice_dompul/${canvaser}/${tgl}/${downline}`,
                  columns: [
                      {data: 'produk'},
                      {data: 'tipe_dompul'},
                      {data: 'harga_dompul'},
                      {data: 'qty'},
                      {data: 'qty_program'},
                      {data: 'total_harga'},
                      {data: 'action', orderable: false, searchable: false}
                  ]
              });
    });
</script>
<script>
  $('#editModal').on('show.bs.modal', function (event) {
    var tgl = $('#tgl').val();
    var canvaser = $('#canvasser').val();
    var downline = $('#downline').val();
    var tipe = document.getElementById("tipe");

    var button = $(event.relatedTarget) // Button that triggered the modal
    var produk = button.data('produk') // Extract info from data-* attributes
    var tipe_harga = button.data('tipe')
    var no_faktur = button.data('faktur')
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    while (tipe.firstChild) {
        tipe.removeChild(tipe.firstChild);
    }
    var default_opt = document.createElement('option');
    default_opt.value = 'default';
    default_opt.innerHTML = '-- Pilih Tipe Dompul --';
    tipe.appendChild(default_opt);
    tipe_harga.forEach(element => {
      var opt = document.createElement('option');
      opt.value = element.tipe_harga_dompul;
      opt.innerHTML = element.tipe_harga_dompul;
      tipe.appendChild(opt);
    });
    console.log(produk);
    $('#editForm').attr('action', `/invoice_dompul/update/${canvaser}/${tgl}/${downline}/${produk}/${no_faktur}/0`);
  })
</script>
@stop
