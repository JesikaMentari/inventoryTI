<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BarangmasukModel;
use App\Models\Admin\WebModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use PDF;

class LapBarangMasukController extends Controller
{
    public function index(Request $request)
    {
        $data["title"] = "Lap Barang Masuk";
        return view('Admin.BeritaAcara.BarangMasuk.index', $data);
    }

    public function print(Request $request)
    {
        if ($request->tglawal) {
            $data['data'] = BarangmasukModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangmasuk.barang_kode')
                ->whereBetween('bm_tanggal', [$request->tglawal, $request->tglakhir])
                ->orderBy('bm_id', 'DESC')
                ->get();
        } else {
            $data['data'] = BarangmasukModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangmasuk.barang_kode')
                ->orderBy('bm_id', 'DESC')
                ->get();
        }

        $data["title"] = "Print Barang Masuk";
        $data['web'] = WebModel::first();
        $data['tglawal'] = $request->tglawal;
        $data['tglakhir'] = $request->tglakhir;
        return view('Admin.BeritaAcara.BarangMasuk.print', $data);
    }

    public function pdf(Request $request)
    {
        if ($request->tglawal) {
            $data['data'] = BarangmasukModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangmasuk.barang_kode')
                ->whereBetween('bm_tanggal', [$request->tglawal, $request->tglakhir])
                ->orderBy('bm_id', 'DESC')
                ->get();
        } else {
            $data['data'] = BarangmasukModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangmasuk.barang_kode')
                ->orderBy('bm_id', 'DESC')
                ->get();
        }

        $data["title"] = "PDF Barang Masuk";
        $data['web'] = WebModel::first();
        $data['tglawal'] = $request->tglawal;
        $data['tglakhir'] = $request->tglakhir;
        $pdf = PDF::loadView('Admin.BeritaAcara.BarangMasuk.pdf', $data);
        
        if($request->tglawal){
            return $pdf->download('lap-bm-'.$request->tglawal.'-'.$request->tglakhir.'.pdf');
        }else{
            return $pdf->download('lap-bm-semua-tanggal.pdf');
        }
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            if ($request->tglawal == '') {
                $data = BarangmasukModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangmasuk.barang_kode')
                    ->orderBy('bm_id', 'DESC')
                    ->get();
            } else {
                $data = BarangmasukModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangmasuk.barang_kode')
                    ->whereBetween('bm_tanggal', [$request->tglawal, $request->tglakhir])
                    ->orderBy('bm_id', 'DESC')
                    ->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('tgl', function ($row) {
                    return $row->bm_tanggal == '' ? '-' : Carbon::parse($row->bm_tanggal)->translatedFormat('d F Y');
                })
                ->addColumn('barang', function ($row) {
                    return $row->barang_id == '' ? '-' : $row->barang_nama;
                })
                ->rawColumns(['tgl', 'barang'])
                ->make(true);
        }
    }
}
