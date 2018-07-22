@extends('adminlte::page')

@section('title', 'Upload')

@section('content_header')
<h1>Upload File</h1>

@stop @section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">Upload</button>
        <a href="{{ URL::to('downloadExcel/xls') }}">
            <button class="btn btn-success">Download Excel xls</button>
        </a>
        <a href="{{ URL::to('downloadExcel/xlsx') }}">
            <button class="btn btn-success">Download Excel xlsx</button>
        </a>
        <a href="{{ URL::to('downloadExcel/csv') }}">
            <button class="btn btn-success">Download CSV</button>
        </a>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
      Tanggal :
    </div>
  </div>
</div>

<table id="upload-table" class="table responsive" width="100%">
  <thead>
    <tr>
      <th>ID</th>
      <th>HP Sub Master</th>
      <th>Nama Sub Master</th>
      <th>Tanggal TRX</th>
      <th>No Faktur</th>
      <th>Produk</th>
      <th>Qty</th>
      <th>Balance</th>
      <th>Diskon</th>
      <th>HP Downline</th>
      <th>Nama Downline</th>
      <th>Status</th>
      <th>HP Kanvacer</th>
      <th>Nama Kanvacer</th>
      <th>Print</th>
      <th>Bayar</th>
      <th>Action</th>
    </tr>
  </thead>
</table>

<!-- Modal -->
<div id="uploadModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Excel</h4>
      </div>
      <div class="modal-body">
        <!-- Form -->
        <form method='post' action='/importExcel' enctype="multipart/form-data">
           @csrf
            <div class="form-group">
                <label for="import_file">File</label>
                <input type='file' name='import_file' id='import_file' class='form-control' accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"><br>
                <input type='submit' class='btn btn-info' value='Upload' id='upload'>
            </div>
        </form>
        <!-- Preview-->
        <div id='preview'></div>
      </div>

    </div>
  </div>
</div>

@stop @section('js')
{{-- <script type="text/javascript">
//    validasi form (hanya file .xls yang diijinkan)
    function validateForm()
    {
        function hasExtension(inputID, exts) {
            var fileName = document.getElementById(inputID).value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        }

        if(!hasExtension('dompul', ['.xls'])){
            alert("Hanya file XLS yang diijinkan.");
            return false;
        }
    }
</script> --}}
<script>
  $(function () {
    $('#upload-table').DataTable({
      serverSide: true,
      processing: true,
      ajax: '/upload',
      columns: [{
          data: 'id_upload'
        },
        {
          data: 'no_hp_sub_master_dompul'
        },
        {
          data: 'nama_sub_master_dompul'
        },
        {
          data: 'tanggal_transfer'
        },
        {
          data: 'no_faktur'
        },
        {
          data: 'produk'
        },
        {
          data: 'qty'
        },
        {
          data: 'balance'
        },
        // {
        //   data: 'diskon'
        // },
        {
          data: 'no_hp_downline'
        },
        {
          data: 'nama_downline'
        },
        {
          data: 'status'
        },
        {
          data: 'no_hp_canvasser'
        },
        {
          data: 'nama_canvasser'
        },
        {
          data: 'print'
        },
        {
          data: 'bayar'
        },
        {
          data: 'action',
          orderable: false,
          searchable: false
        }
      ]
    });
  });
  // $(function () {
  //   $('#upload-table').DataTable({
  //     serverSide: true,
  //     processing: true,
  //     ajax: '/upload',
  //     columns: [{
  //         data: 'id_upload'
  //       },
  //       {
  //         data: 'no_hp_sub_master_dompul'
  //       },
  //       {
  //         data: 'nama_sub_master_dompul'
  //       },
  //       {
  //         data: 'tanggal_transfer'
  //       },
  //       {
  //         data: 'no_faktur'
  //       },
  //       {
  //         data: 'produk'
  //       },
  //       {
  //         data: 'qty'
  //       },
  //       {
  //         data: 'balance'
  //       },
  //       {
  //         data: 'diskon'
  //       },
  //       {
  //         data: 'no_hp_downline'
  //       },
  //       {
  //         data: 'nama_downline'
  //       },
  //       {
  //         data: 'status'
  //       },
  //       {
  //         data: 'no_hp_canvasser'
  //       },
  //       {
  //         data: 'nama_canvasser'
  //       },
  //       {
  //         data: 'print'
  //       },
  //       {
  //         data: 'bayar'
  //       },
  //       {
  //         data: 'action',
  //         orderable: false,
  //         searchable: false
  //       }
  //     ]
  //   });
  // });
</script>


<script>
  $('#editModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var name = button.data('name')// Extract info from data-* attributes
  var id = button.data('id')
  var tipe = button.data('tipe')
  var induk = button.data('induk')
  var nilai = button.data('nilai')
  var status = button.data('status')
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  $('#editForm').attr('action', `/master/satuan/${id}`);
  modal.find('.modal-body .nama input').val(name)
  modal.find('.modal-body .id input').val(id)
  modal.find('.modal-body .tipe input').val(tipe)
  modal.find('.modal-body .induk input').val(induk)
  modal.find('.modal-body .nilai input').val(nilai)
  modal.find('.modal-body .status input').val(status)
  })
</script>
<script>
  $('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    $('#deleteForm').attr('action', `/master/satuan/${id}`);
  })
</script>
@stop
