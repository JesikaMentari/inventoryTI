<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AksesModel;
use App\Models\Admin\BarangkeluarModel;
use App\Models\Admin\BarangmasukModel;
use App\Models\Admin\BarangModel;
use App\Models\Admin\JenisBarangModel;
use App\Models\Admin\LokasiModel;
use App\Models\Admin\SatuanModel;
use App\Models\Admin\VendorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Vendor;

class BarangController extends Controller
{
    public function index()
    {
        $data["title"] = "Barang";
        $data["hakTambah"] = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')
            ->where(['tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_judul' => 'Barang', 'tbl_akses.akses_type' => 'create'])
            ->count();
        $data["jenisbarang"] =  JenisBarangModel::orderBy('jenisbarang_id', 'DESC')->get();
        $data["satuan"] =  SatuanModel::orderBy('satuan_id', 'DESC')->get();
        $data["lokasi"] =  LokasiModel::orderBy('lokasi_id', 'DESC')->get();
        $data["vendors"] = VendorModel::orderBy('id_vendor', 'DESC')->get(); // Ambil data vendor untuk dropdown
        return view('Admin.Barang.index', $data);
    }

    public function getbarang($id)
    {
        $data = BarangModel::leftJoin('tbl_jenisbarang', 'tbl_jenisbarang.jenisbarang_id', '=', 'tbl_barang.jenisbarang_id')
            ->leftJoin('tbl_satuan', 'tbl_satuan.satuan_id', '=', 'tbl_barang.satuan_id')
            ->leftJoin('tbl_lokasi', 'tbl_lokasi.lokasi_id', '=', 'tbl_barang.lokasi_id')
            ->where('tbl_barang.barang_kode', '=', $id)
            ->get();
        return json_encode($data);
    }

    public function create() {
        $vendors = Vendor::all(); // Mengambil semua data vendor
        return view('Admin.Barang.create', compact('vendors'));
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {

            $data = BarangModel::leftJoin('tbl_jenisbarang', 'tbl_jenisbarang.jenisbarang_id', '=', 'tbl_barang.jenisbarang_id')
                ->leftJoin('tbl_satuan', 'tbl_satuan.satuan_id', '=', 'tbl_barang.satuan_id')
                ->leftJoin('tbl_lokasi', 'tbl_lokasi.lokasi_id', '=', 'tbl_barang.lokasi_id')
                ->orderBy('barang_id', 'DESC')
                ->get(['tbl_barang.*', 'tbl_vendor.vendor_nama as vendor'] );

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('img', function ($row) {
                    $array = ["barang_gambar" => $row->barang_gambar];
                    if ($row->barang_gambar == "image.png") {
                        return '<a data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Gmodaldemo8" onclick=gambar(' . json_encode($array) . ')><span class="avatar avatar-lg cover-image" style="background: url(&quot;' . url('/assets/default/barang') . '/' . $row->barang_gambar . '&quot;) center center;"></span></a>';
                    } else {
                        return '<a data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Gmodaldemo8" onclick=gambar(' . json_encode($array) . ')><span class="avatar avatar-lg cover-image" style="background: url(&quot;' . asset('storage/barang/' . $row->barang_gambar) . '&quot;) center center;"></span></a>';
                    }
                })
                ->addColumn('jenisbarang', function ($row) {
                    return $row->jenisbarang_id == '' ? '-' : $row->jenisbarang_nama;
                })
                ->addColumn('satuan', function ($row) {
                    return $row->satuan_id == '' ? '-' : $row->satuan_nama;
                })
                ->addColumn('lokasi', function ($row) {
                    return $row->lokasi_id == '' ? '-' : $row->lokasi_nama;
                })
                ->addColumn('currency', function ($row) {
                    return $row->barang_jumlah == '' ? '-' : number_format((int)$row->barang_jumlah, 0, ',', '.');
                })
                ->addColumn('vendor', function ($row) {
                    return $row->barang_vendor == '' ? '-' : $row->barang_vendor; // Menampilkan barang_vendor
                })
                ->addColumn('totalstok', function ($row) use ($request) {
                    if ($request->tglawal == '') {
                        $jmlmasuk = BarangmasukModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangmasuk.barang_kode')
                            ->where('tbl_barangmasuk.barang_kode', '=', $row->barang_kode)
                            ->sum('tbl_barangmasuk.bm_jumlah');
                    } else {
                        $jmlmasuk = BarangmasukModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangmasuk.barang_kode')
                            ->whereBetween('bm_tanggal', [$request->tglawal, $request->tglakhir])
                            ->where('tbl_barangmasuk.barang_kode', '=', $row->barang_kode)
                            ->sum('tbl_barangmasuk.bm_jumlah');
                    }

                    if ($request->tglawal) {
                        $jmlkeluar = BarangkeluarModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangkeluar.barang_kode')
                            ->whereBetween('bk_tanggal', [$request->tglawal, $request->tglakhir])
                            ->where('tbl_barangkeluar.barang_kode', '=', $row->barang_kode)
                            ->sum('tbl_barangkeluar.bk_jumlah');
                    } else {
                        $jmlkeluar = BarangkeluarModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangkeluar.barang_kode')
                            ->where('tbl_barangkeluar.barang_kode', '=', $row->barang_kode)
                            ->sum('tbl_barangkeluar.bk_jumlah');
                    }

                    $totalstok = $row->barang_stok + ($jmlmasuk - $jmlkeluar);
                    if ($totalstok == 0) {
                        return '<span class="">' . $totalstok . '</span>';
                    } elseif ($totalstok > 0) {
                        return '<span class="text-success">' . $totalstok . '</span>';
                    } else {
                        return '<span class="text-danger">' . $totalstok . '</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $array = [
                        "barang_id" => $row->barang_id,
                        "jenisbarang_id" => $row->jenisbarang_id,
                        "satuan_id" => $row->satuan_id,
                        "lokasi_id" => $row->lokasi_id,
                        "barang_kode" => $row->barang_kode,
                        "barang_nama" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->barang_nama)),
                        "barang_jumlah" => $row->barang_jumlah,
                        "barang_stok" => $row->barang_stok,
                        "barang_gambar" => $row->barang_gambar,
                    ];
                    $button = '';
                    $hakEdit = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')
                        ->where(['tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_judul' => 'Barang', 'tbl_akses.akses_type' => 'update'])
                        ->count();
                    $hakDelete = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')
                        ->where(['tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_judul' => 'Barang', 'tbl_akses.akses_type' => 'delete'])
                        ->count();
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
                ->rawColumns(['action', 'img', 'jenisbarang', 'satuan', 'lokasi', 'currency', 'totalstok', 'vendor']) // Tambahkan 'vendor' ke rawColumns
                ->make(true);
        }
    }

    public function listbarang(Request $request)
    {
        if ($request->ajax()) {
            $data = BarangModel::leftJoin('tbl_jenisbarang', 'tbl_jenisbarang.jenisbarang_id', '=', 'tbl_barang.jenisbarang_id')
                ->leftJoin('tbl_satuan', 'tbl_satuan.satuan_id', '=', 'tbl_barang.satuan_id')
                ->leftJoin('tbl_lokasi', 'tbl_lokasi.lokasi_id', '=', 'tbl_barang.lokasi_id')
                ->orderBy('barang_id', 'DESC')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('img', function ($row) {
                    if ($row->barang_gambar == "image.png") {
                        $img = '<span class="avatar avatar-lg cover-image" style="background: url(&quot;' . url('/assets/default/barang') . '/' . $row->barang_gambar . '&quot;) center center;"></span>';
                    } else {
                        $img = '<span class="avatar avatar-lg cover-image" style="background: url(&quot;' . asset('storage/barang/' . $row->barang_gambar) . '&quot;) center center;"></span>';
                    }

                    return $img;
                })
                ->addColumn('jenisbarang', function ($row) {
                    return $row->jenisbarang_id == '' ? '-' : $row->jenisbarang_nama;
                })
                ->addColumn('satuan', function ($row) {
                    return $row->satuan_id == '' ? '-' : $row->satuan_nama;
                })
                ->addColumn('lokasi', function ($row) {
                    return $row->lokasi_id == '' ? '-' : $row->lokasi_nama;
                })
                ->addColumn('currency', function ($row) {
                    return $row->barang_jumlah == '' ? '-' : number_format($row->barang_jumlah, 0);
                })
                ->addColumn('vendor', function ($row) {
                    return $row->barang_vendor == '' ? '-' : $row->barang_vendor; // Menampilkan barang_vendor
                })
                ->addColumn('totalstok', function ($row) use ($request) {
                    if ($request->tglawal == '') {
                        $jmlmasuk = BarangmasukModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangmasuk.barang_kode')
                            ->where('tbl_barangmasuk.barang_kode', '=', $row->barang_kode)
                            ->sum('tbl_barangmasuk.bm_jumlah');
                    } else {
                        $jmlmasuk = BarangmasukModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangmasuk.barang_kode')
                            ->whereBetween('bm_tanggal', [$request->tglawal, $request->tglakhir])
                            ->where('tbl_barangmasuk.barang_kode', '=', $row->barang_kode)
                            ->sum('tbl_barangmasuk.bm_jumlah');
                    }

                    if ($request->tglawal) {
                        $jmlkeluar = BarangkeluarModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangkeluar.barang_kode')
                            ->whereBetween('bk_tanggal', [$request->tglawal, $request->tglakhir])
                            ->where('tbl_barangkeluar.barang_kode', '=', $row->barang_kode)
                            ->sum('tbl_barangkeluar.bk_jumlah');
                    } else {
                        $jmlkeluar = BarangkeluarModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangkeluar.barang_kode')
                            ->where('tbl_barangkeluar.barang_kode', '=', $row->barang_kode)
                            ->sum('tbl_barangkeluar.bk_jumlah');
                    }

                    $totalstok = $row->barang_stok + ($jmlmasuk - $jmlkeluar);
                    if ($totalstok == 0) {
                        return '<span class="">' . $totalstok . '</span>';
                    } elseif ($totalstok > 0) {
                        return '<span class="text-success">' . $totalstok . '</span>';
                    } else {
                        return '<span class="text-danger">' . $totalstok . '</span>';
                    }
                })
                ->addColumn('action', function ($row) use ($request) {
                    $array = [
                        "barang_kode" => $row->barang_kode,
                        "barang_nama" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->barang_nama)),
                        "satuan_nama" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->satuan_nama)),
                        "jenisbarang_nama" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->jenisbarang_nama)),
                    ];
                    $button = '';
                    if ($request->get('param') == 'tambah') {
                        $button .= '
                        <div class="g-2">
                            <a class="btn btn-primary btn-sm" href="javascript:void(0)" onclick=pilihBarang(' . json_encode($array) . ')>Pilih</a>
                        </div>';
                    } else {
                        $button .= '
                    <div class="g-2">
                        <a class="btn btn-success btn-sm" href="javascript:void(0)" onclick=pilihBarangU(' . json_encode($array) . ')>Pilih</a>
                    </div>';
                    }

                    return $button;
                })
                ->rawColumns(['action', 'img', 'jenisbarang', 'satuan', 'lokasi', 'currency', 'totalstok', 'vendor'])
                ->make(true);
        }
    }

    public function proses_tambah(Request $request)
    {
        $img = "";
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->nama)));
    
        //upload image
        if ($request->file('foto') == null) {
            $img = "image.png";
        } else {
            $image = $request->file('foto');
            $image->storeAs('public/barang/', $image->hashName());
            $img = $image->hashName();
        }
    
        // Cek apakah input vendor dari dropdown atau free text
        $vendor_dropdown = $request->input('vendor_dropdown');
        $vendor_freetext = $request->input('vendor_freetext');
        $vendor = $vendor_dropdown ?: $vendor_freetext;
    
        // Debug data yang diterima dari form
        dd([
            'vendor_dropdown' => $vendor_dropdown,
            'vendor_freetext' => $vendor_freetext,
            'final_vendor' => $vendor, // Hasil akhir vendor yang akan digunakan
            'all_request_data' => $request->all() // Menampilkan semua data form yang dikirim
        ]);
    
        //create
        BarangModel::create([
            'barang_gambar' => $img,
            'jenisbarang_id' => $request->jenisbarang,
            'satuan_id' => $request->satuan,
            'lokasi_id' => $request->lokasi,
            'barang_kode' => $request->kode,
            'barang_nama' => $request->nama,
            'barang_slug' => $slug,
            'barang_jumlah' => $request->jumlah,
            'barang_stok' => 0,
            'barang_vendor' => $vendor, // Menyimpan vendor
        ]);
    
        return response()->json(['success' => 'Berhasil']);
    }
    

    public function proses_ubah(Request $request, BarangModel $barang)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->nama)));

        // Cek apakah input vendor dari dropdown atau free text
        $vendor = $request->input('vendor_dropdown') ?: $request->input('vendor_freetext');

        //check if image is uploaded
        if ($request->hasFile('foto')) {
            //upload new image
            $image = $request->file('foto');
            $image->storeAs('public/barang', $image->hashName());

            //delete old image
            Storage::delete('public/barang/' . $barang->barang_gambar);

            //update data with new image
            $barang->update([
                'barang_gambar'  => $image->hashName(),
                'jenisbarang_id' => $request->jenisbarang,
                'satuan_id' => $request->satuan,
                'lokasi_id' => $request->lokasi,
                'barang_kode' => $request->kode,
                'barang_nama' => $request->nama,
                'barang_slug' => $slug,
                'barang_jumlah' => $request->jumlah,
                'barang_stok' => $request->stok,
                'barang_vendor' => $vendor, // Update vendor
            ]);
        } else {
            //update data without image
            $barang->update([
                'jenisbarang_id' => $request->jenisbarang,
                'satuan_id' => $request->satuan,
                'lokasi_id' => $request->lokasi,
                'barang_kode' => $request->kode,
                'barang_nama' => $request->nama,
                'barang_slug' => $slug,
                'barang_jumlah' => $request->jumlah,
                'barang_stok' => $request->stok,
                'barang_vendor' => $vendor, // Update vendor
            ]);
        }

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_hapus(Request $request, BarangModel $barang)
    {
        //delete image
        Storage::delete('public/barang/' . $barang->barang_gambar);

        //delete
        $barang->delete();

        return response()->json(['success' => 'Berhasil']);
    }
}
