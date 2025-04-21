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
            $data = VendorModel::orderBy('id_vendordanbagian', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('ket', function ($row) {
                    return $row->keterangan ?: '-';
                })
                ->addColumn('action', function ($row) {
                    $array = [
                        "id_vendordanbagian" => $row->id_vendordanbagian,
                        "nama" => $row->nama,
                        "keterangan" => $row->keterangan
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
            'nama' => 'required|string|max:255',
        ]);

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->nama)));

        VendorModel::create([
            'nama' => $request->nama,
            'vendorslug' => $slug,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_ubah(Request $request)
    {
        $request->validate([
            'id_vendordanbagian' => 'required|integer', // Validasi id_vendor
            'nama' => 'required|string|max:255',
        ]);
    
        $vendor = VendorModel::find($request->id_vendordanbagian);
        if (!$vendor) {
            return response()->json(['error' => 'Vendor dan Bagian tidak ditemukan'], 404);
        }
    
        $vendor->update([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
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