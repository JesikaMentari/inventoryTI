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
                    return $row->vendor_keterangan ?: '-';
                })
                ->addColumn('action', function ($row) {
                    $array = [
                        "id_vendor" => $row->id_vendor,
                        "vendor_nama" => $row->vendor_nama,
                        "vendor_keterangan" => $row->vendor_keterangan
                    ];

                    $button = '';
                    $hakEdit = AksesModel::whereRoleAccess('Vendor', 'update');
                    $hakDelete = AksesModel::whereRoleAccess('Vendor', 'delete');
                    
                    if ($hakEdit) {
                        $button .= '<a class="btn btn-sm text-success" data-bs-toggle="modal" href="#modalEditVendor" onclick="update(' . htmlspecialchars(json_encode($array)) . ')"><i class="fe fe-edit"></i></a>';
                    }
                    if ($hakDelete) {
                        $button .= '<a class="btn btn-sm text-danger" data-bs-toggle="modal" href="#modalHapusVendor" onclick="hapus(' . htmlspecialchars(json_encode($array)) . ')"><i class="fe fe-trash"></i></a>';
                    }
                    return $button ?: '-';
                })
                ->rawColumns(['action', 'ket'])
                ->make(true);
        }
    }

    public function proses_tambah(Request $request)
    {
        $request->validate([
            'vendor_nama' => 'required|string|max:255',
        ]);

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->vendor_nama)));

        VendorModel::create([
            'vendor_nama' => $request->vendor_nama,
            'vendorslug' => $slug,
            'vendor_keterangan' => $request->vendor_keterangan,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_ubah(Request $request)
    {
        $request->validate([
            'id_vendor' => 'required|integer', // Validasi id_vendor
            'vendor_nama' => 'required|string|max:255',
        ]);
    
        $vendor = VendorModel::find($request->id_vendor);
        if (!$vendor) {
            return response()->json(['error' => 'Vendor tidak ditemukan'], 404);
        }
    
        $vendor->update([
            'vendor_nama' => $request->vendor_nama,
            'vendor_keterangan' => $request->vendor_keterangan,
        ]);
    
        return response()->json(['success' => 'Data vendor berhasil diubah']);
    }    

    
    
    public function proses_hapus($id)
    {
        try {
            $vendor =VendorModel::findOrFail($id); // Temukan data berdasarkan ID
            $vendor->delete(); // Hapus data
    
            return response()->json(['success' => 'Data vendor berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus data vendor']);
        }
    }
}    