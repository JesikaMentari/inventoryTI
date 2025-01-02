<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangkeluarModel extends Model
{
    use HasFactory;
    protected $table = "tbl_barangkeluar";
    protected $primaryKey = 'bk_id';
    protected $fillable = [
        'bk_kode',
        'barang_kode',
        'bk_tanggal',
        'bk_bagian',
        'unit_id',
        'bk_namakaryawan',
        'bk_jumlah',
        'bk_lampiran',
    ];

    public function bagian()
    {
        return $this->belongsTo(BagianModel::class, 'bk_bagian', 'id_bagian');
    }
}
