<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\VendorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Admin\AksesModel;

class VendorController extends Controller
{
    public function index()
    {
        $data["title"] = "Vendor";
        $data["hakTambah"] = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')
            ->where([
                'tbl_akses.role_id' => Session::get('user')->role_id, 
                'tbl_submenu.submenu_judul' => 'Vendor', 
                'tbl_akses.akses_type' => 'create'
            ])->count();

        return view('Admin.Vendor.index', $data);
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = VendorModel::orderBy('id_vendor', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('ket', function ($row) {
                    return $row->vendor_keterangan == '' ? '-' : $row->vendor_keterangan;
                })
                ->addColumn('action', function ($row) {
                    $array = array(
                        "id_vendor" => $row->id_vendor,
                        "vendor_nama" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->vendor_nama)),
                        "vendor_keterangan" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->vendor_keterangan))
                    );
                    $button = '';
                    $hakEdit = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')
                        ->where([
                            'tbl_akses.role_id' => Session::get('user')->role_id, 
                            'tbl_submenu.submenu_judul' => 'Vendor', 
                            'tbl_akses.akses_type' => 'update'
                        ])->count();
                    $hakDelete = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')
                        ->where([
                            'tbl_akses.role_id' => Session::get('user')->role_id, 
                            'tbl_submenu.submenu_judul' => 'Vendor', 
                            'tbl_akses.akses_type' => 'delete'
                        ])->count();
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
                ->rawColumns(['action', 'ket'])->make(true);
        }
    }

    public function proses_tambah(Request $request)
    {
        $request->validate([
            'vendor_nama' => 'required|string|max:255',
        ]);

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->vendor_nama)));

        //insert data
        VendorModel::create([
            'vendor_nama' => $request->vendor_nama,
            'vendorslug' => $slug,
            'vendor_keterangan' => $request->vendor_keterangan,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_ubah(Request $request, VendorModel $vendor)
    {
        $request->validate([
            'vendor_nama' => 'required|string|max:255',
        ]);

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->vendor_nama)));

        //update data
        $vendor->update([
            'vendor_nama' => $request->vendor_nama,
            'vendorslug' => $slug,
            'vendor_keterangan' => $request->vendor_keterangan,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_hapus(Request $request, VendorModel $vendor)
    {
        //delete
        $vendor->delete();

        return response()->json(['success' => 'Berhasil']);
    }
}
