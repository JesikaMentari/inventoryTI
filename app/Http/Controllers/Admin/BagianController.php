<!-- 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BagianModel;
use App\Models\Admin\AksesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class BagianController extends Controller
{
    public function index()
    {
        $data["title"] = "Bagian";
        $data["hakTambah"] = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')
            ->where([
                'tbl_akses.role_id' => Session::get('user')->role_id, 
                'tbl_submenu.submenu_judul' => 'Bagian', 
                'tbl_akses.akses_type' => 'create'
            ])->count();
        return view('Admin.Bagian.index', $data);
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = BagianModel::orderBy('id_bagian', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $array = array(
                        "id_bagian" => $row->id_bagian,
                        "nama_bagian" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->nama_bagian))
                    );
                    $button = '';
                    $hakEdit = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')
                        ->where([
                            'tbl_akses.role_id' => Session::get('user')->role_id, 
                            'tbl_submenu.submenu_judul' => 'Bagian', 
                            'tbl_akses.akses_type' => 'update'
                        ])->count();
                    $hakDelete = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')
                        ->where([
                            'tbl_akses.role_id' => Session::get('user')->role_id, 
                            'tbl_submenu.submenu_judul' => 'Bagian', 
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
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function proses_tambah(Request $request)
    {
        $request->validate([
            'nama_bagian' => 'required|string|max:255',
        ]);

        // Insert data
        BagianModel::create([
            'nama_bagian' => $request->nama_bagian,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_ubah(Request $request, BagianModel $bagian)
    {
        $request->validate([
            'nama_bagian' => 'required|string|max:255',
        ]);

        // Update data
        $bagian->update([
            'nama_bagian' => $request->nama_bagian,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_hapus(Request $request, BagianModel $bagian)
    {
        $bagian->delete();
        return response()->json(['success' => 'Bagian berhasil dihapus!']);
    }
}     -->
