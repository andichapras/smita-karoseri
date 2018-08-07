<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PenjualanDompul;
use App\UploadDompul;
use App\HargaDompul;
use App\Sales;
use DB;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class MonitorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Diplay a list of transaction made before
     */
    public function index(){
        $tgl=session('tgl_penjualan');
        $totalQtyProgram5k=0;
        $totalQtyNonProgram5k=0;
        $totalQtyProgram10k=0;
        $totalQtyNonProgram10k=0;
        $totalQtyProgramRupiah=0;
        $totalQtyNonProgramRupiah=0;
        $total_5k=$totalQtyNonProgram5k+$totalQtyProgram5k;
        $total_10k=$totalQtyProgram10k+$totalQtyNonProgram10k;
        $total_rupiah=$totalQtyProgramRupiah+$totalQtyNonProgramRupiah;
        if(!empty($tgl)){
            $tgl = Carbon::parse($tgl);
        $tgl = $tgl->format('Y-m-d');
        $monitorUpload = UploadDompul::selectRaw("nama_canvasser AS nama,
(SELECT sum(qty_program) FROM upload_dompuls WHERE produk = 'DP5' and nama_canvasser = nama) AS qty_program5k,
(SELECT sum(qty) FROM upload_dompuls WHERE produk = 'DP5' and nama_canvasser = nama) AS qty_non_program5k,
(SELECT sum(qty_program) FROM upload_dompuls WHERE produk = 'DP10' and nama_canvasser = nama) AS qty_program10k,
(SELECT sum(qty) FROM upload_dompuls WHERE produk = 'DP10' and nama_canvasser = nama) AS qty_non_program10k,
(SELECT sum(qty_program) AS rupiah_program FROM upload_dompuls WHERE produk = 'DOMPUL' and nama_canvasser = nama) AS program_rupiah,
(SELECT sum(qty) AS rupiah FROM upload_dompuls WHERE produk = 'DOMPUL' and nama_canvasser = nama) AS non_program_rupiah")
                        ->where('tanggal_transfer',$tgl)
                        ->groupBy('nama')->get();
        $totalQtyProgram5k=0;
        $totalQtyNonProgram5k=0;
        $totalQtyProgram10k=0;
        $totalQtyNonProgram10k=0;
        $totalQtyProgramRupiah=0;
        $totalQtyNonProgramRupiah=0;
        foreach ($monitorUpload as $key => $value) {
            $totalQtyProgram5k+=$value->qty_program5k;
        }
        foreach ($monitorUpload as $key => $value) {
            $totalQtyNonProgram5k+=$value->qty_non_program5k ;
        }
        foreach ($monitorUpload as $key => $value) {
            $totalQtyProgram10k+=$value->qty_program10k;
        }
        foreach ($monitorUpload as $key => $value) {
            $totalQtyNonProgram10k+=$value->qty_non_program10k;
        }
        foreach ($monitorUpload as $key => $value) {
            $totalQtyProgramRupiah+=$value->program_rupiah;
        }
        foreach ($monitorUpload as $key => $value) {
            $totalQtyNonProgramRupiah+=$value->non_program_rupiah;
        }
        $total_5k=$totalQtyNonProgram5k+$totalQtyProgram5k;
        $total_10k=$totalQtyProgram10k+$totalQtyNonProgram10k;
        $total_rupiah=$totalQtyProgramRupiah+$totalQtyNonProgramRupiah;
        }
        
        return view('penjualan.monitoring.mntr-upload',[
        'totalQtyProgram5k'=>$totalQtyProgram5k,
        'totalQtyNonProgram5k'=>$totalQtyNonProgram5k,
        'totalQtyProgram10k'=>$totalQtyProgram10k,
        'totalQtyNonProgram10k'=>$totalQtyNonProgram10k,
        'totalQtyProgramRupiah'=>$totalQtyProgramRupiah,
        'totalQtyNonProgramRupiah'=>$totalQtyNonProgramRupiah,
        'total_5k'=>$total_5k,
        'total_10k'=>$total_10k,
        'total_rupiah'=>$total_rupiah]);
    }
    public function show(Request $request){
        
        $tgl = $request->get('tgl');
        session(['tgl_penjualan'=>$tgl]);
        $tgl = Carbon::parse($tgl);
        $tgl = $tgl->format('Y-m-d');
        $monitorUpload = UploadDompul::selectRaw("nama_canvasser AS nama,
(SELECT sum(qty_program) FROM upload_dompuls WHERE produk = 'DP5' and nama_canvasser = nama) AS qty_program5k,
(SELECT sum(qty) FROM upload_dompuls WHERE produk = 'DP5' and nama_canvasser = nama) AS qty_non_program5k,
(SELECT sum(qty_program) FROM upload_dompuls WHERE produk = 'DP10' and nama_canvasser = nama) AS qty_program10k,
(SELECT sum(qty) FROM upload_dompuls WHERE produk = 'DP10' and nama_canvasser = nama) AS qty_non_program10k,
(SELECT sum(qty_program) AS rupiah_program FROM upload_dompuls WHERE produk = 'DOMPUL' and nama_canvasser = nama) AS program_rupiah,
(SELECT sum(qty) AS rupiah FROM upload_dompuls WHERE produk = 'DOMPUL' and nama_canvasser = nama) AS non_program_rupiah")
                        ->where('tanggal_transfer',$tgl)
                        ->groupBy('nama')->get();
        $totalQtyProgram5k=0;
        $totalQtyNonProgram5k=0;
        $totalQtyProgram10k=0;
        $totalQtyNonProgram10k=0;
        $totalQtyProgramRupiah=0;
        $totalQtyNonProgramRupiah=0;
        foreach ($monitorUpload as $key => $value) {
            $totalQtyProgram5k+=$value->qty_program5k;
        }
        foreach ($monitorUpload as $key => $value) {
            $totalQtyNonProgram5k+=$value->qty_non_program5k ;
        }
        foreach ($monitorUpload as $key => $value) {
            $totalQtyProgram10k+=$value->qty_program10k;
        }
        foreach ($monitorUpload as $key => $value) {
            $totalQtyNonProgram10k+=$value->qty_non_program10k;
        }
        foreach ($monitorUpload as $key => $value) {
            $totalQtyProgramRupiah+=$value->program_rupiah;
        }
        foreach ($monitorUpload as $key => $value) {
            $totalQtyNonProgramRupiah+=$value->non_program_rupiah;
        }
        $total_5k=$totalQtyNonProgram5k+$totalQtyProgram5k;
        $total_10k=$totalQtyProgram10k+$totalQtyNonProgram10k;
        $total_rupiah=$totalQtyProgramRupiah+$totalQtyNonProgramRupiah;
        return view('penjualan.monitoring.mntr-upload',[
        'totalQtyProgram5k'=>$totalQtyProgram5k,
        'totalQtyNonProgram5k'=>$totalQtyNonProgram5k,
        'totalQtyProgram10k'=>$totalQtyProgram10k,
        'totalQtyNonProgram10k'=>$totalQtyNonProgram10k,
        'totalQtyProgramRupiah'=>$totalQtyProgramRupiah,
        'totalQtyNonProgramRupiah'=>$totalQtyNonProgramRupiah,
        'total_5k'=>$total_5k,
        'total_10k'=>$total_10k,
        'total_rupiah'=>$total_rupiah]);
    }

    /**
     * Process dataTable ajax response.
     *
     * @param \Yajra\Datatables\Datatables $datatables
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Datatables $datatables,$tgl)
    {
        $tgl = Carbon::parse($tgl);
        $tgl = $tgl->format('Y-m-d');
        $monitorUpload = UploadDompul::selectRaw("nama_canvasser AS nama,
(SELECT sum(qty_program) FROM upload_dompuls WHERE produk = 'DP5' and nama_canvasser = nama) AS qty_program5k,
(SELECT sum(qty) FROM upload_dompuls WHERE produk = 'DP5' and nama_canvasser = nama) AS qty_non_program5k,
(SELECT sum(qty_program) FROM upload_dompuls WHERE produk = 'DP10' and nama_canvasser = nama) AS qty_program10k,
(SELECT sum(qty) FROM upload_dompuls WHERE produk = 'DP10' and nama_canvasser = nama) AS qty_non_program10k,
(SELECT sum(qty_program) AS rupiah_program FROM upload_dompuls WHERE produk = 'DOMPUL' and nama_canvasser = nama) AS program_rupiah,
(SELECT sum(qty) AS rupiah FROM upload_dompuls WHERE produk = 'DOMPUL' and nama_canvasser = nama) AS non_program_rupiah")
                        ->where('tanggal_transfer',$tgl)
                        ->groupBy('nama')->get();
        return $datatables->of($monitorUpload)
                        ->addColumn('index', function ($uploadDompul) {
                              return 
                              '';
                            })
                          ->make(true);
    }
}
