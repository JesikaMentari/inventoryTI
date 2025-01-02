<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestBeritaAcaraModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_request_berita_acara'; 
    protected $primaryKey ='request_berita_acara_id'; // Primary key tabel
    public $timestamps = true; 

    protected $fillable = [
        'hari', 
        'tanggal',
        'nama_pihak_pertama', 
        'jabatan_pihak_pertama', 
        'telepon_pihak_pertama', 
        'unit_pihak_pertama',
        'nama_pihak_kedua', 
        'jabatan_pihak_kedua', 
        'telepon_pihak_kedua', 
        'unit_pihak_kedua',
        // Kolom lain sesuai dengan tabel Anda
    ];
}