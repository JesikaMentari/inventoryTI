<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    use HasFactory;
    protected $table = "tbl_barang";
    protected $primaryKey = 'barang_id';
    protected $fillable = [
        'jenisbarang_id',
        'satuan_id',
        'lokasi_id',
        'barang_kode',
        'barang_nama',
        'barang_slug',
        'barang_jumlah',
        'barang_stok',
        'barang_gambar',
        'barang_vendor',
    ]; 
}
