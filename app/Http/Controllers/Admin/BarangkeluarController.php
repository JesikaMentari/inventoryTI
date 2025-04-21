<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AksesModel;
use App\Models\Admin\BarangkeluarModel;
//use App\Models\Admin\BagianModel;
use App\Models\Admin\BarangModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class BarangkeluarController extends Controller
{
    public function index()
    {
        $data["title"] = "Barang Keluar";
        $data["hakTambah"] = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')
            ->where(array(
                'tbl_akses.role_id' => Session::get('user')->role_id,
                'tbl_submenu.submenu_judul' => 'Barang Keluar',
                'tbl_akses.akses_type' => 'create'
            ))->count();

        // $data['bagians'] = BagianModel::all();

        return view('Admin.BarangKeluar.index', $data);
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {

            // Mengambil data dengan join tabel barang dan unit
            $data = BarangkeluarModel::select([
                'tbl_barangkeluar.*',
                'tbl_barang.barang_nama',
                // 'tbl_unit.unit_nama'
            ])
                ->leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangkeluar.barang_kode')
                // ->leftJoin('tbl_unit', 'tbl_unit.unit_id', '=', 'tbl_barangmasuk.unit_id')
                ->orderBy('bk_id', 'DESC')
                ->get();

            // $data = BarangkeluarModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangkeluar.barang_kode')
            //     //->select('tbl_barangkeluar.*', 'tbl_barang.barang_nama')
            //     //->orderBy('bk_id', 'DESC')
            //     ->distinct()
            //     ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('tgl', function ($row) {
                    return $row->bk_tanggal ? Carbon::parse($row->bk_tanggal)->translatedFormat('d F Y') : '-';
                })
                //->addColumn('bagian', function ($row) {
                //    return $row->bagian ? $row->bagian->nama_bagian : '-';
                //})
                // Tambahkan kolom unit
                // ->addColumn('unit', function ($row) {
                //     return $row->unit_nama ?? '-';
                // })

                // Tambahkan kolom pihak2
                ->addColumn('namaPihakKedua', function ($row) {
                    return $row->namaPihakKedua ?? '-';
                })
                ->addColumn('barang', function ($row) {
                    return $row->barang_nama ? $row->barang_nama : '-';
                })
                ->addColumn('lampiran', function ($row) {
                    return $row->bk_lampiran ? '<a href="' . asset('storage/' . $row->bk_lampiran) . '" target="_blank">Lihat Lampiran</a>' : 'Tidak Ada Lampiran';
                })
                ->addColumn('action', function ($row) {
                    $array = array(
                        "bk_id" => $row->bk_id,
                        "bk_kode" => $row->bk_kode,
                        "barang_kode" => $row->barang_kode,
                        "bk_tanggal" => $row->bk_tanggal,
                        // "bk_bagian" => $row->bk_bagian,
                        // "unit_id" => $row->unit_id,
                        "bk_namakaryawan" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->bk_namakaryawan)),
                        "bk_jumlah" => $row->bk_jumlah,
                        "bk_lampiran" => $row->bk_lampiran
                    );
                    $button = '';
                    $hakEdit = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')
                        ->where(array(
                            'tbl_akses.role_id' => Session::get('user')->role_id,
                            'tbl_submenu.submenu_judul' => 'Barang Keluar',
                            'tbl_akses.akses_type' => 'update'
                        ))->count();
                    $hakDelete = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')
                        ->where(array(
                            'tbl_akses.role_id' => Session::get('user')->role_id,
                            'tbl_submenu.submenu_judul' => 'Barang Keluar',
                            'tbl_akses.akses_type' => 'delete'
                        ))->count();

                    if ($hakEdit > 0 && $hakDelete > 0) {
                        $button .= '
                        <div class="g-2">
                        <a class="btn modal-effect text-primary btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Umodaldemo8" data-bs-toggle="tooltip" data-bs-original-title="Edit" onclick=update(' . json_encode($array) . ')><span class="fe fe-edit text-success fs-14"></span></a>
                        <a class="btn modal-effect text-danger btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Hmodaldemo8" onclick=hapus(' . json_encode($array) . ')><span class="fe fe-trash-2 fs-14"></span></a>
                        </div>';
                    } elseif ($hakEdit > 0 && $hakDelete == 0) {
                        $button .= '
                        <div class="g-2">
                            <a class="btn modal-effect text-primary btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Umodaldemo8" data-bs-toggle="tooltip" data-bs-original-title="Edit" onclick=update(' . json_encode($array) . ')><span class="fe fe-edit text-success fs-14"></span></a>
                        </div>';
                    } elseif ($hakEdit == 0 && $hakDelete > 0) {
                        $button .= '
                        <div class="g-2">
                        <a class="btn modal-effect text-danger btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Hmodaldemo8" onclick=hapus(' . json_encode($array) . ')><span class="fe fe-trash-2 fs-14"></span></a>
                        </div>';
                    } else {
                        $button .= '-';
                    }
                    return $button;
                })
                ->rawColumns(['action', 'tgl', 'barang', 'lampiran'])->make(true);
        }
    }

    public function proses_tambah(Request $request)
    {
        $lampiranPath = $request->file('lampiran') ? $request->file('lampiran')->store('lampiran') : null;

        BarangkeluarModel::create([
            'bk_tanggal' => $request->tglkeluar,
            'bk_kode' => $request->bkkode,
            'barang_kode' => $request->barang,
            // 'bk_bagian' => $request->bk_bagian,
            'bk_namakaryawan' => $request->bk_namakaryawan,
            'bk_jumlah' => $request->jml,
            'bk_lampiran' => $lampiranPath
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_ubah(Request $request, BarangkeluarModel $barangkeluar)
    {
        if ($request->hasFile('lampiran')) {
            if ($barangkeluar->bk_lampiran) {
                Storage::delete($barangkeluar->bk_lampiran);
            }
            $lampiranPath = $request->file('lampiran')->store('lampiran');
        } else {
            $lampiranPath = $barangkeluar->bk_lampiran;
        }

        $barangkeluar->update([
            'bk_tanggal' => $request->tglkeluar,
            'bk_kode' => $request->bkkode,
            'barang_kode' => $request->barang,
            // 'bk_bagian' => $request->bk_bagian,
            'bk_namakaryawan' => $request->bk_namakaryawan,
            'bk_jumlah' => $request->jml,
            'bk_lampiran' => $lampiranPath
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_hapus(Request $request, BarangkeluarModel $barangkeluar)
    {
        if ($barangkeluar->bk_lampiran) {
            Storage::delete($barangkeluar->bk_lampiran);
        }
        $barangkeluar->delete();

        return response()->json(['success' => 'Berhasil']);
    }
}
