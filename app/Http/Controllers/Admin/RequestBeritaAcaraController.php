<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BagianModel;
use App\Models\Admin\UnitModel;
use App\Models\Admin\BarangModel;
use App\Models\Admin\BarangkeluarModel;
use App\Models\Admin\BarangmasukModel;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Storage;

class RequestBeritaAcaraController extends Controller
{
    public function index()
    {
        session()->forget('pdf_path');
        return view('Admin.BeritaAcara.RequestBeritaAcara.index');
    }

    private function prepareData(Request $request)
    {
        $namaBarang = $request->namaBarang;
        $typeBarang = $request->typeBarang;
        $jumlahBarang = $request->jumlahBarang;
        $snBarang = $request->snBarang ?? []; // Pastikan tidak error jika null
        $keteranganBarang = $request->keteranganBarang ?? [];

        $barangData = [];

        foreach ($namaBarang as $key => $nama) {
            $barangData[] = [
                'namaBarang' => $nama,
                'typeBarang' => $typeBarang[$key] ?? null,
                'jumlahBarang' => $jumlahBarang[$key] ?? null,
                'snBarang' => $snBarang[$key] ?? null,
                'keteranganBarang' => $keteranganBarang[$key] ?? null,
            ];
        }

        $data = $request->all();
        $data['barang'] = $barangData;
        \Log::info("Barang Data:", $request->all());

        return $data;
    }

    public function print(Request $request)
    {
        set_time_limit(300);

        // Persiapkan data yang akan digunakan di view
        $data = $this->prepareData($request);


        // Generate PDF dari view
        $pdf = PDF::loadView('Admin.BeritaAcara.RequestBeritaAcara.print', $data)
        ->setPaper('A3', 'portrait') // Atur ukuran kertas dan orientasi
        ->setOptions([
            'isHtml5ParserEnabled' => true,  // Pastikan HTML5 dapat diparse dengan benar
            'isPhpEnabled' => true,          // Aktifkan eksekusi PHP dalam PDF jika perlu
            'margin-top' => 15,              // Sesuaikan margin top
            'margin-right' => 15,            // Sesuaikan margin kanan
            'margin-bottom' => 15,           // Sesuaikan margin bottom
            'margin-left' => 15,             // Sesuaikan margin kiri
        ]);



        // Simpan PDF ke storage
        $pdfFileName = 'berita_acara_' . time() .'_' . uniqid(). '.pdf';
        // Path penyimpanan PDF di disk 'public'
        $pdfPath = 'lampiran/' . $pdfFileName;

        try {
            // Pastikan folder 'lampiran' ada di dalam 'storage/app/public'
            if (!Storage::disk('public')->exists('lampiran')) {
                Storage::disk('public')->makeDirectory('lampiran');
            }

            // Simpan PDF ke storage
            if (Storage::disk('public')->put($pdfPath, $pdf->output())) {
                \Log::info("PDF successfully saved at: " . storage_path('app/public/' . $pdfPath));
                session(['pdf_path' => $pdfPath]);

                $data['pdf_path']='lokasi';
            } else {
                \Log::error("Failed to save PDF at: " . storage_path('app/public/' . $pdfPath));
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyimpan file PDF.'
                ]);
            }
        } catch (\Exception $e) {
            \Log::error("Error while saving PDF: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan file PDF.'
            ]);
        }
        // Periksa apakah parameter 'action' untuk cetak atau view
        if ($request->input('action') === 'cetak') {
            dd(session());
            // Stream PDF ke browser dengan nama file
            return $pdf->stream($pdfFileName);
        }

        // Tampilkan view biasa
        return view('Admin.BeritaAcara.RequestBeritaAcara.print', $data);
    }

    // public function pdf(Request $request)
    // {
    //     // Validasi tipe dari token
    //     $tipe = $request->input('tipe', 'masuk'); // Default 'masuk'
    //     $data = $this->prepareData($request); // Persiapkan data PDF

    //     // Generate PDF
    //     $pdf = PDF::loadView('Admin.BeritaAcara.RequestBeritaAcara.print', $data);

    //     // Simpan PDF ke storage dengan path berdasarkan tipe
    //     $pdfFileName = 'berita_acara_' . $tipe . '_' . time() . '.pdf';
    //     $pdfPath = 'lampiran/' . $pdfFileName;

    //     // Debug: Log path dan PDF output
    //     \Log::info("Attempting to save PDF at: " . storage_path('app/' . $pdfPath));

    //     try {
    //         // Pastikan folder 'lampiran' ada
    //         if (!Storage::exists('lampiran')) {
    //             Storage::makeDirectory('lampiran');
    //         }

    //         // Simpan PDF
    //         if (Storage::disk('local')->put($pdfPath, $pdf->output())) {
    //             \Log::info("PDF successfully saved at: " . storage_path('app/' . $pdfPath));
    //             return response()->json(['success' => true, 'message' => 'PDF berhasil disimpan']);
    //         } else {
    //             \Log::error("Failed to save PDF at: " . storage_path('app/' . $pdfPath));
    //             return response()->json(['success' => false, 'message' => 'Gagal menyimpan PDF']);
    //         }
    //     } catch (\Exception $e) {
    //         \Log::error("Error while saving PDF: " . $e->getMessage());
    //         return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menyimpan PDF']);
    //     }
    // }

    public function storeMasuk(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'namaPihakPertama' => 'required|string',
            'namaPihakKedua' => 'required|string',
            'namaBarang' => 'required|array',
            'jumlahBarang' => 'required|array',
        ]);

        if (!$request->has(['namaBarang', 'jumlahBarang'])) {
            return response()->json([
                'success' => false,
                'message' => 'Data barang tidak lengkap.',
            ]);
        }

        try {
            // Ambil path PDF dari session
            $pdfPath = session('pdf_path');
            if (!$pdfPath) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lampiran PDF belum dibuat. Harap cetak terlebih dahulu.'
                ]);
            }

            // Simpan data unit
            $unit = UnitModel::firstOrCreate(
                ['unit_nama' => $request->namaPihakPertama],
                [
                    'unit_slug' => \Str::slug($request->namaPihakPertama),
                    'unit_notelp' => '',
                    'unit_alamat' => '',
                ]
            );

            // Iterasi barang untuk menyimpan data ke tabel barangmasuk
            foreach ($request->namaBarang as $key => $namaBarang) {
                $barang = BarangModel::firstOrCreate(
                    ['barang_nama' => $namaBarang],
                    [
                        'barang_kode' => 'BRG-' . uniqid(),
                        'barang_slug' => \Str::slug($namaBarang),
                        'barang_jumlah' => 0,
                        'barang_stok' => 0,
                    ]
                );

                BarangmasukModel::create([
                    'bm_kode' => 'BM-' . uniqid(),
                    'barang_kode' => $barang->barang_kode,
                    'unit_id' => $unit->unit_id,
                    'namaPihakKedua' => $request->namaPihakKedua,
                    'bm_tanggal' => $request->tanggal,
                    'bm_jumlah' => $request->jumlahBarang[$key],
                    'bm_lampiran' => $pdfPath
                ]);
            }

            // Hapus session setelah digunakan
            session()->forget('pdf_path');
            \Log::info("Session PDF path cleared.");

            return response()->json([
                'success' => true,
                'message' => 'Data barang masuk berhasil disimpan.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }


    public function storeKeluar(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'namaPihakPertama' => 'required|string',
            'namaPihakKedua' => 'required|string',
            'unitPihakKedua' => 'required|string',
            'namaBarang' => 'required|array',
            'jumlahBarang' => 'required|array',
        ]);

        if (!$request->has(['namaBarang', 'jumlahBarang'])) {
            return response()->json([
                'success' => false,
                'message' => 'Data barang tidak lengkap.',
            ]);
        }

        try {
            // Ambil path PDF dari session
            $pdfPath = session('pdf_path');
            if (!$pdfPath) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lampiran PDF belum dibuat. Harap cetak terlebih dahulu.'
                ]);
            }

            // Simpan atau ambil data unit pihak pertama
            $unit = UnitModel::firstOrCreate(
                ['unit_nama' => $request->namaPihakPertama],
                [
                    'unit_slug' => \Str::slug($request->namaPihakPertama),
                    'unit_notelp' => '',
                    'unit_alamat' => '',
                ]
            );

            // Simpan atau ambil data unit pihak kedua (dari tabel `tbl_bagian`)
            $bagian = BagianModel::firstOrCreate(
                ['nama_bagian' => $request->unitPihakKedua],
                [
                    'nama_bagian' => $request->unitPihakKedua,
                ]
            );

            // Iterasi barang untuk menyimpan data ke tabel barangkeluar
            foreach ($request->namaBarang as $key => $namaBarang) {
                $barang = BarangModel::firstOrCreate(
                    ['barang_nama' => $namaBarang],
                    [
                        'barang_kode' => 'BRG-' . uniqid(),
                        'barang_slug' => \Str::slug($namaBarang),
                        'barang_jumlah' => 0,
                        'barang_stok' => 0,
                    ]
                );

                // Simpan data ke database termasuk path PDF
                BarangkeluarModel::create([
                    'bk_kode' => 'BK-' . uniqid(), // Kode unik untuk barang keluar
                    'barang_kode' => $barang->barang_kode,
                    'bk_tanggal' => $request->tanggal,
                    'bk_jumlah' => $request->jumlahBarang[$key],
                    'bk_bagian' => $bagian->id_bagian, // Ambil ID dari tabel `tbl_bagian`
                    'unit_id' => $unit->unit_id, // Ambil ID unit pihak pertama
                    'bk_namakaryawan' => $request->namaPihakKedua,
                    'bk_lampiran' => $pdfPath, // Simpan path PDF
                ]);
            }

            // Hapus session setelah digunakan
            session()->forget('pdf_path');
            \Log::info("Session PDF path cleared.");

            return response()->json([
                'success' => true,
                'message' => 'Data barang keluar berhasil disimpan.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }


    public function lihatLampiran($file)
    {
        // Menangani path file dengan benar
        $filePath = 'storage/' . $file; // Path ke file PDF

        // Cek apakah file ada
        if (Storage::exists($filePath)) {
            // Menampilkan PDF menggunakan view
            return view('Admin.BeritaAcara.RequestBeritaAcara.print', ['pdfPath' => asset($filePath)]);
        }

        // Jika file tidak ditemukan
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
}
