<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StokDompul;
use App\UploadDompul;
use App\Sales;
use Illuminate\Support\Facades\Auth;
use DB;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class StokCVSDompulAllController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','kasir']);
    }
    public function index(){
        $saless = Sales::where('status',1)->get();
        return view('persediaan/dompul/mutasi-dompul-semua-cvs',['saless'=>$saless]);
    }
    /**
     * Process dataTable ajax response.
     *
     * @param \Yajra\Datatables\Datatables $datatables
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Datatables $datatables,$tgl_awal,$tgl_akhir)
    {
        // $data = DB::table('temp_detail_penjualan_sps')->get();
        // session(['tgl_stok_dompul'=>$tgl]);
        $tgl_awal = Carbon::parse($tgl_awal);
        $tgl_awal = $tgl_awal->format('Y-m-d');

        $tgl_akhir = Carbon::parse($tgl_akhir);
        $tgl_akhir = $tgl_akhir->format('Y-m-d');
//         $stokDompul = DB::table('kartu_stok_dompuls')->select(DB::raw("kartu_stok_dompuls.id_produk as nama,
//         (SELECT sum(awal.masuk)-sum(awal.keluar)
// FROM kartu_stok_dompuls awal WHERE awal.tanggal_transaksi < '{$tgl_awal}' AND awal.id_produk=nama) AS stok_awal,
// sum(kartu_stok_dompuls.masuk) AS stok_masuk,
// sum(kartu_stok_dompuls.keluar) AS stok_keluar,
// (sum(kartu_stok_dompuls.masuk)-sum(kartu_stok_dompuls.keluar)+COALESCE((SELECT sum(awal.masuk)-sum(awal.keluar)
// FROM kartu_stok_dompuls awal WHERE awal.tanggal_transaksi < '{$tgl_awal}' AND awal.id_produk=nama),0)) AS jumlah_stok"))
//                         // ->join('upload_dompuls',function($join){
//                         //     $join->on('kartu_stok_dompuls.id_produk','=','upload_dompuls.produk');
//                         // })
//                         ->whereBetween('tanggal_transaksi',[$tgl_awal,$tgl_akhir])
//                         ->groupBy('nama');
        $stokDompul = DB::table('kartu_stok_dompuls')->select(DB::raw("kartu_stok_dompuls.id_produk as nama,
        COALESCE((SELECT sum(awal.masuk)-sum(awal.keluar)
FROM kartu_stok_dompuls awal WHERE awal.tanggal_transaksi < '{$tgl_awal}' AND awal.id_produk=nama),0) AS stok_awal,
COALESCE((SELECT sum(awal.masuk)
FROM kartu_stok_dompuls awal WHERE awal.tanggal_transaksi BETWEEN '{$tgl_awal}' AND '{$tgl_akhir}' AND awal.id_produk=nama),0) AS stok_masuk,
COALESCE((SELECT sum(awal.keluar)
FROM kartu_stok_dompuls awal WHERE awal.tanggal_transaksi BETWEEN '{$tgl_awal}' AND '{$tgl_akhir}' AND awal.id_produk=nama),0) AS stok_keluar,
(sum(masuk)-sum(keluar)) AS jumlah_stok"))
                        ->whereRaw("tanggal_transaksi <= '{$tgl_akhir}'")
                        ->groupBy('nama');
        $dompuls = UploadDompul::select('produk','stok_awal','stok_masuk','stok_keluar','jumlah_stok')
        ->leftJoinSub($stokDompul, 'total_nominal', function($join) {
                            $join->on('upload_dompuls.produk', '=', 'total_nominal.nama');
                        })
                        // ->joinSub($stokDompul, 'total_nominal', function($join) {
                        //     $join->on('upload_dompuls.produk', '=', 'total_nominal.nama');
                        // })
                        
                        ->where('status_active',1)->groupBy('produk','stok_awal','stok_masuk','stok_keluar','jumlah_stok')->get();
        $table = $datatables->of($dompuls);
        $saless = Sales::select('nm_sales','id_sales')->where('status',1)->get();
        foreach ($saless as $key => $sales) {
          $table = $table->addColumn($sales->nm_sales, function ($dataStok) use ($sales, &$tgl_akhir) {
                              $sum = DB::table('kartu_stok_dompuls')->select(DB::raw("id_sales,kartu_stok_dompuls.id_produk,(sum(masuk)-sum(keluar)) AS jumlah_stok"))
                              // ->rightJoin('master_produks','master_produks.kode_produk','=','kartu_stok_dompuls.id_produk')
                              ->whereRaw("tanggal_transaksi <= '{$tgl_akhir}'")
                              ->where('kartu_stok_dompuls.id_sales',$sales->id_sales)
                              ->where('kartu_stok_dompuls.id_produk',$dataStok->produk)
                              ->groupBy('id_sales','kartu_stok_dompuls.id_produk')
                              ->first();
                              if ($sum==null) {
                                return number_format(0,0,'','.');
                              } else {
                                return number_format($sum->jumlah_stok,0,'','.');
                              }
                            });
        }
        return $table
                        ->addColumn('indeks', function ($dataStok) {
                              return '';
                            })
                            ->addColumn('stok_awal', function ($dataStok) {
                              return number_format($dataStok->stok_awal,0,'','.');
                            })
                            ->addColumn('stok_masuk', function ($dataStok) {
                              return number_format($dataStok->stok_masuk,0,'','.');
                            })
                            ->addColumn('stok_keluar', function ($dataStok) {
                              return number_format($dataStok->stok_keluar,0,'','.');
                            })
                            ->addColumn('jumlah_stok', function ($dataStok) {
                              return number_format($dataStok->jumlah_stok,0,'','.');
                            })
                          ->make(true);
    }
}