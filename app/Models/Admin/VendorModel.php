<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_vendordanbagian';
    protected $primaryKey = 'id_vendordanbagian';

    protected $fillable = [
        'nama',
        'vendorslug',
        'keterangan'
    ];
}
