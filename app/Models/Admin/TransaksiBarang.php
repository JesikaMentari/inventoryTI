<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiBarang extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_transaksi_barang';
    protected $primaryKey = 'txb_id';
    public $timestamps = false;

    protected $fillable = [
        'txb_kode',
        'txb_namaPihakPertama',
        'txb_namaPihakKedua',
        'txb_bagianPihakPertama',
        'txb_bagianPihakKedua',
        'txb_jumlah',
        'kategori',
        'txb_lampiran',
        'txb_tanggal',
        'created_id',
        'updated_at',
    ];
}
