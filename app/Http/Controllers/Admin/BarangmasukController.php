<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AksesModel;
use App\Models\Admin\BarangmasukModel;
use App\Models\Admin\BarangModel;
use App\Models\Admin\UnitModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class BarangmasukController extends Controller
{
    public function index()
    {
        $data["title"] = "Barang Masuk";
        $data["hakTambah"] = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_judul' => 'Barang Masuk', 'tbl_akses.akses_type' => 'create'))->count();
        $data["unit"] = UnitModel::orderBy('unit_id', 'DESC')->get();
        return view('Admin.BarangMasuk.index', $data);
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            // Mengambil data dengan join tabel barang dan unit
            $data = BarangmasukModel::select([
                'tbl_barangmasuk.*',
                'tbl_barang.barang_nama',
                'tbl_unit.unit_nama'
            ])
                ->leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangmasuk.barang_kode')
                ->leftJoin('tbl_unit', 'tbl_unit.unit_id', '=', 'tbl_barangmasuk.unit_id')
                ->orderBy('bm_id', 'DESC')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                // Tambahkan kolom tanggal dengan format
                ->addColumn('tgl', function ($row) {
                    return $row->bm_tanggal
                        ? Carbon::parse($row->bm_tanggal)->translatedFormat('d F Y')
                        : '-';
                })
                // Tambahkan kolom unit
                ->addColumn('unit', function ($row) {
                    return $row->unit_nama ?? '-';
                })
                // Tambahkan kolom pihak2
                ->addColumn('namaPihakKedua', function ($row) {
                    return $row->namaPihakKedua ?? '-';
                })
                // Tambahkan kolom barang
                ->addColumn('barang', function ($row) {
                    return $row->barang_nama ?? '-';
                })
                // Tambahkan kolom lampiran
                ->addColumn('lampiran', function ($row) {
                    return $row->bm_lampiran ? '<a href="' . asset('storage/' . $row->bm_lampiran) . '" target="_blank">Lihat Lampiran</a>' : 'Tidak Ada Lampiran';
                })
                // Tambahkan kolom aksi
                ->addColumn('action', function ($row) {
                    $array = [
                        "bm_id" => $row->bm_id,
                        "bm_kode" => $row->bm_kode,
                        "barang_kode" => $row->barang_kode,
                        "unit_id" => $row->unit_id,
                        "bm_tanggal" => $row->bm_tanggal,
                        "bm_jumlah" => $row->bm_jumlah,
                        "bm_lampiran" => $row->bm_lampiran,
                    ];

                    $button = '';
                    $hakEdit = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')
                        ->where([
                            'tbl_akses.role_id' => Session::get('user')->role_id,
                            'tbl_submenu.submenu_judul' => 'Barang Masuk',
                            'tbl_akses.akses_type' => 'update'
                        ])->count();
                    $hakDelete = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')
                        ->where([
                            'tbl_akses.role_id' => Session::get('user')->role_id,
                            'tbl_submenu.submenu_judul' => 'Barang Masuk',
                            'tbl_akses.akses_type' => 'delete'
                        ])->count();

                    // Logika tombol aksi
                    if ($hakEdit > 0 && $hakDelete > 0) {
                        $button .= '
                        <div class="g-2">
                            <a class="btn modal-effect text-primary btn-sm" data-bs-effect="effect-super-scaled" 
                                data-bs-toggle="modal" href="#Umodaldemo8" 
                                onclick=update(' . json_encode($array) . ')>
                                <span class="fe fe-edit text-success fs-14"></span>
                            </a>
                            <a class="btn modal-effect text-danger btn-sm" data-bs-effect="effect-super-scaled" 
                                data-bs-toggle="modal" href="#Hmodaldemo8" 
                                onclick=hapus(' . json_encode($array) . ')>
                                <span class="fe fe-trash-2 fs-14"></span>
                            </a>
                        </div>';
                    } elseif ($hakEdit > 0) {
                        $button .= '
                        <div class="g-2">
                            <a class="btn modal-effect text-primary btn-sm" data-bs-effect="effect-super-scaled" 
                                data-bs-toggle="modal" href="#Umodaldemo8" 
                                onclick=update(' . json_encode($array) . ')>
                                <span class="fe fe-edit text-success fs-14"></span>
                            </a>
                        </div>';
                    } elseif ($hakDelete > 0) {
                        $button .= '
                        <div class="g-2">
                            <a class="btn modal-effect text-danger btn-sm" data-bs-effect="effect-super-scaled" 
                                data-bs-toggle="modal" href="#Hmodaldemo8" 
                                onclick=hapus(' . json_encode($array) . ')>
                                <span class="fe fe-trash-2 fs-14"></span>
                            </a>
                        </div>';
                    } else {
                        $button .= '-';
                    }

                    return $button;
                })
                ->rawColumns(['action', 'lampiran', 'tgl', 'unit', 'barang'])
                ->make(true);
        }
    }

    public function proses_tambah(Request $request)
    {
        // Upload lampiran jika ada
        $lampiranPath = $request->file('lampiran') ? $request->file('lampiran')->store('lampiran') : null;

        // Insert data
        BarangmasukModel::create([
            'bm_tanggal' => $request->tglmasuk,
            'bm_kode' => $request->bmkode,
            'barang_kode' => $request->barang,
            'unit_id' => $request->unit,
            'bm_jumlah' => $request->jml,
            'bm_lampiran' => $lampiranPath,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_ubah(Request $request, BarangmasukModel $barangmasuk)
    {
        $lampiranPath = $barangmasuk->bm_lampiran;

        // Update lampiran jika ada file baru
        if ($request->hasFile('lampiran')) {
            if ($lampiranPath) {
                Storage::delete($lampiranPath);
            }
            $lampiranPath = $request->file('lampiran')->store('lampiran');
        }

        // Update data
        $barangmasuk->update([
            'bm_tanggal' => $request->tglmasuk,
            'barang_kode' => $request->barang,
            'unit_id' => $request->unit,
            'bm_jumlah' => $request->jml,
            'bm_lampiran' => $lampiranPath,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_hapus(Request $request, BarangmasukModel $barangmasuk)
    {
        // Hapus lampiran jika ada
        if ($barangmasuk->bm_lampiran) {
            Storage::delete($barangmasuk->bm_lampiran);
        }

        // Delete data
        $barangmasuk->delete();

        return response()->json(['success' => 'Berhasil']);
    }

    public function lihatLampiran($file)
    {
        // Menangani path file dengan benar
        $filePath = 'storage/' . $file;
        
        // Periksa apakah file ada
        if (Storage::exists($filePath)) {
            return view('Admin.BeritaAcara.RequestBeritaAcara.print', ['pdfPath' => asset($filePath)]);
        }
    
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
    
}
