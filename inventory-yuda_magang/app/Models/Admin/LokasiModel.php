<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiModel extends Model
{
    use HasFactory;
    protected $table = "tbl_lokasi";
    protected $primaryKey = 'lokasi_id';
    protected $fillable = [
        'lokasi_nama',
        'lokasi_slug',
        'lokasi_keterangan'
    ]; 
}
