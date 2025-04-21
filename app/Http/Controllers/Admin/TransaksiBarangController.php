<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AksesModel;
use App\Models\Admin\TransaksiBarangModel;
use App\Models\Admin\BarangModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class TransaksiBarangController extends Controller
{
    public function index()
    {
        $data["title"] = "Transaksi Barang";
        $data["hakTambah"] = AksesModel::leftJoin('tbl_menu', 'tbl_menu.menu_id', '=', 'tbl_akses.submenu_id')
            ->where([
                'tbl_akses.role_id' => Session::get('user')->role_id,
                'tbl_menu.menu_judul' => 'Transaksi Barang',
                'tbl_akses.akses_type' => 'create'
            ])->count();

        return view('Admin.TransaksiBarang.index', $data);
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = TransaksiBarang::select([
                'tbl_transaksibarang.*',
                'tbl_barang.barang_nama'
            ])
                ->leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_transaksibarang.barang_kode')
                ->orderBy('txb_id', 'DESC')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('tgl', fn($row) => $row->txb_tanggal ? Carbon::parse($row->txb_tanggal)->translatedFormat('d F Y') : '-')
                ->addColumn('pihak_pertama', fn($row) => $row->txb_namaPihakPertama ?? '-')
                ->addColumn('pihak_kedua', fn($row) => $row->txb_namaPihakKedua ?? '-')
                ->addColumn('barang', fn($row) => $row->barang_nama ?? '-')
                ->addColumn('lampiran', fn($row) => $row->txb_lampiran ? '<a href="' . asset('storage/' . $row->txb_lampiran) . '" target="_blank">Lihat Lampiran</a>' : 'Tidak Ada Lampiran')
                ->addColumn('action', function ($row) {
                    $array = [
                        "txb_id" => $row->txb_id,
                        "txb_kode" => $row->txb_kode,
                        "barang_kode" => $row->barang_kode,
                        "txb_tanggal" => $row->txb_tanggal,
                        "txb_namaPihakPertama" => $row->txb_namaPihakPertama,
                        "txb_namaPihakKedua" => $row->txb_namaPihakKedua,
                        "txb_jumlah" => $row->txb_jumlah,
                        "txb_lampiran" => $row->txb_lampiran
                    ];
                    return '<a class="btn text-primary btn-sm" href="#Umodaldemo8" onclick=update(' . json_encode($array) . ')><span class="fe fe-edit text-success fs-14"></span></a>
                            <a class="btn text-danger btn-sm" href="#Hmodaldemo8" onclick=hapus(' . json_encode($array) . ')><span class="fe fe-trash-2 fs-14"></span></a>';
                })
                ->rawColumns(['action', 'tgl', 'barang', 'lampiran'])
                ->make(true);
        }
    }

    public function proses_tambah(Request $request)
    {
        $lampiranPath = $request->file('lampiran') ? $request->file('lampiran')->store('lampiran') : null;

        TransaksiBarang::create([
            'txb_tanggal' => $request->tgl,
            'txb_kode' => $request->txb_kode,
            'barang_kode' => $request->barang,
            'txb_namaPihakPertama' => $request->pihak_pertama,
            'txb_namaPihakKedua' => $request->pihak_kedua,
            'txb_jumlah' => $request->jml,
            'txb_lampiran' => $lampiranPath
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_ubah(Request $request, TransaksiBarang $transaksiBarang)
    {
        if ($request->hasFile('lampiran')) {
            if ($transaksiBarang->txb_lampiran) {
                Storage::delete($transaksiBarang->txb_lampiran);
            }
            $lampiranPath = $request->file('lampiran')->store('lampiran');
        } else {
            $lampiranPath = $transaksiBarang->txb_lampiran;
        }

        $transaksiBarang->update([
            'txb_tanggal' => $request->tgl,
            'txb_kode' => $request->txb_kode,
            'barang_kode' => $request->barang,
            'txb_namaPihakPertama' => $request->pihak_pertama,
            'txb_namaPihakKedua' => $request->pihak_kedua,
            'txb_jumlah' => $request->jml,
            'txb_lampiran' => $lampiranPath
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_hapus(Request $request, TransaksiBarang $transaksiBarang)
    {
        if ($transaksiBarang->txb_lampiran) {
            Storage::delete($transaksiBarang->txb_lampiran);
        }
        $transaksiBarang->delete();

        return response()->json(['success' => 'Berhasil']);
    }
}