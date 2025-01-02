<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_vendor';
    protected $primaryKey = 'vendor_id';

    protected $fillable = [
        'vendor_nama',
        'vendorslug',
        'vendor_keterangan'
    ];
}
