<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\RequestBeritaAcaraModel;
use Illuminate\Http\Request;
use PDF;

class RequestBeritaAcaraController extends Controller
{
    public function index()
    {
        return view('Admin.BeritaAcara.RequestBeritaAcara.index');
    }

    public function print(Request $request)
    {
        $data = $this->prepareData($request);
        return view('Admin.BeritaAcara.RequestBeritaAcara.print', $data);
    }

    public function pdf(Request $request)
    {
        $data = $this->prepareData($request);
        $pdf = PDF::loadView('Admin.BeritaAcara.RequestBeritaAcara.print', $data);
        return $pdf->download('Berita_Acara_Serah_Terima.pdf');
    }

    private function prepareData(Request $request)
    {
        $data = $request->all();
        $data['barang'] = array_map(function($namaBarang, $typeBarang, $jumlahBarang, $snBarang, $keteranganBarang) {
            return [
                'namaBarang' => $namaBarang,
                'typeBarang' => $typeBarang,
                'jumlahBarang' => $jumlahBarang,
                'snBarang' => $snBarang,
                'keteranganBarang' => $keteranganBarang
            ];
        }, $request->namaBarang, $request->typeBarang, $request->jumlahBarang, $request->snBarang, $request->keteranganBarang);

        return $data;
    }
}