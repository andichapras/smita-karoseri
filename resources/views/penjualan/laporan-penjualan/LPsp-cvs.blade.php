@extends('adminlte::page')

@section('title', 'Laporan SP')

@section('content_header')
    <h1>Laporan Penjualan CVS SP</h1>

@stop

@section('css')
<link rel="stylesheet" href="{{ asset('/datepicker/css/bootstrap-datepicker.min.css') }}">
<style>
  td{
    text-align: center;
  }
  th{
    text-align: center;
  }
  .form-control{
    text-align: center;
  }
</style>
@stop

@section('content')

<div class="cotainer-fluid">
  <div class="row">
    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalInput" pull-right>Input Tanggal Laporan Penjualan</button>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        Tanggal Cetak Laporan
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        : {{\Carbon\Carbon::now('Asia/Jakarta')->format('d-m-Y')}}
      </div>
    </div>
  </div>
</div>
<br><br>

<table id="lp-sp-table" class="table responsive" width="100%">
    <thead>
    <tr>
        {{-- <th>No</th> --}}
        <th>Nama SP</th>
        <th>Qty</th>
        <th>Harga Satuan</th>
        <th>Harga Total</th>
        <th>Tunai</th>
        <th>BCA Pusat</th>
        <th>BCA Cabang</th>
        <th>Mandiri</th>
        <th>BRI</th>
        <th>BNI</th>
        <th>Kekurangan</th>
    </tr>
    </thead>
    <tfoot>
      <tr>
        {{-- <td></td> --}}
        <td><b>Grand Total</b></td>
        <td></td>
        <td><input type="text" name="qty" id="qty" class="form-control" value="" readonly></td>
        <td><input type="text" name="total" id="total" class="form-control" value="" readonly></td>
        <td><input type="text" name="cash" id="cash" class="form-control" value="" readonly></td>
        <td><input type="text" name="bca_pusat" id="bca_pusat" class="form-control" value="" readonly></td>
        <td><input type="text" name="bca_cabang" id="bca_cabang" class="form-control" value="" readonly></td>
        <td><input type="text" name="mandiri" id="mandiri" class="form-control" value="" readonly></td>
        <td><input type="text" name="bri" id="bri" class="form-control" value="" readonly></td>
        <td><input type="text" name="bni" id="bni" class="form-control" value="" readonly></td>
        <td><input type="text" name="piutang" id="piutang" class="form-control" value="" readonly></td>
      </tr>
    </tfoot>
</table>

<!--Modal input-->
<div class="modal fade bs-example-modal-lg" id='modalInput' tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Input Laporan Penjualan SP</h4>
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
                      @if(Session::has('tgl_laporan_sp'))
                      <input class="datepicker col-md-7 col-xs-12" id="tgl" data-date-format="dd-mm-yyyy" value="{{session('tgl_laporan_sp')}}">
                    @else
                      <input class="datepicker col-md-7 col-xs-12" id="tgl" data-date-format="dd-mm-yyyy" value="{{Carbon\Carbon::now()->format('d-m-Y')}}">
                    @endif
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4" style="padding-left:0px">
                      Nama Canvaser : &nbsp;
                      <select id="sales" required="required" name="sales" class="chosen-select" data-placeholder="{{session('id_sales')}}" value="{{session('id_sales')}}">
                            <option value="" disabled>Pilih Nama Canvaser</option>
                            @isset($salesarray)
                                @foreach ($salesarray as $data)
                                <option value="{{ $data->id_sales }}">{{ $data->nm_sales }}</option>
                                @endforeach
                            @endisset
                      </select>
                    </div>
                     
                  </div>

                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button class="btn btn-primary" type="reset"> <i class="fa fa-repeat"></i> Kosongkan</button>
                      <button type="button" id="save" class="btn btn-success" data-dismiss="modal"><i class="glyphicon glyphicon-ok"></i>Tampilkan Laporan Penjualan SP</button>
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
<script src="{{ asset('/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
  $('.datepicker').datepicker({
  });
  // $(".chosen-select").chosen();
  // $("#sales").val("{{session('id_sales')}}");
  // $("#sales").trigger("chosen:updated");
</script>
<script>
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
    $(function () {
        $tgl = $('#tgl').val();
        $sales = $('#sales').val();
        if($tgl==""){
          $tgl='null';
        }else{
          console.log('No');
        }
        console.log($sales);
        if($sales==""){
          $sales='null';
        }else{
          console.log($sales);
        }
        var t = $('#lp-sp-table').DataTable({
            serverSide: true,
            processing: true,
            ajax: `/laporan-penjualan/sp-cvs/${$tgl}/${$sales}`,
            columnDefs: [
                {
                    targets:0,
                    render: function ( data, type, row, meta ) {
                        if(type === 'display'){
                            data = `<a class="link-post" href="/penjualan/laporan-penjualan/LPsp-piutang/${data}">` + data + '</a>';
                        }
                        return data;
                    }
                }
            ],
            columns: [
                // {data: 'index'},
                {data: 'nama_produk'},
                {data: 'jumlah_sp'},
                {data: 'harga_satuan'},
                {data: 'harga_total'},
                {data: 'index'},
                {data: 'index'},
                {data: 'index'},
                {data: 'index'},
                {data: 'index'},
                {data: 'index'},
                {data: 'index'},
            ],
            dom: 'lBrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        });
        $.post(`/get_laporan_sp_cvs/${$tgl}/${$sales}`, function(response){
            if(response.success)
            {
              console.log('Success..');
              // $('#qty').val(response.qty.toLocaleString('id-ID'));
              $('#total').val(response.total.toLocaleString('id-ID'));
              $('#cash').val(response.cash.toLocaleString('id-ID'));
              $('#bca_pusat').val(response.bca_pusat.toLocaleString('id-ID'));
              $('#bca_cabang').val(response.bca_cabang.toLocaleString('id-ID'));
              $('#mandiri').val(response.mandiri.toLocaleString('id-ID'));
              $('#bni').val(response.bni.toLocaleString('id-ID'));
              $('#bri').val(response.bri.toLocaleString('id-ID'));
              $('#piutang').val(response.piutang.toLocaleString('id-ID'));
              console.log('Loaded');
              console.log(response.data);
            }
        }, 'json');
        $('#save').on('click',function(event) {
          $tgl = $('#tgl').val();
          $sales = $('#sales').val();
          t.ajax.url(`/laporan-penjualan/sp-cvs/${$tgl}/${$sales}`).load();
          $.post(`/get_laporan_sp_cvs/${$tgl}/${$sales}`, function(response){
            if(response.success)
            {
              console.log('Success..');
              // $('#qty').val(response.qty.toLocaleString('id-ID'));
              $('#total').val(response.total.toLocaleString('id-ID'));
              $('#cash').val(response.cash.toLocaleString('id-ID'));
              $('#bca_pusat').val(response.bca_pusat.toLocaleString('id-ID'));
              $('#bca_cabang').val(response.bca_cabang.toLocaleString('id-ID'));
              $('#mandiri').val(response.mandiri.toLocaleString('id-ID'));
              $('#bni').val(response.bni.toLocaleString('id-ID'));
              $('#bri').val(response.bri.toLocaleString('id-ID'));
              $('#piutang').val(response.piutang.toLocaleString('id-ID'));
              console.log('Loaded');
              console.log(response.data);
            }
        }, 'json');
        });
    });
</script>
@stop