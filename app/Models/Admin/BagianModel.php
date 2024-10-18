<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BagianModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_bagian';
    protected $primaryKey = 'id_bagian';
    protected $fillable = ['nama_bagian'];
}
