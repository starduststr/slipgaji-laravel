<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKaryawanModel extends Model
{
    use HasFactory;

    protected $table = 'data_karyawan';
    protected $fillable = ['kode','nama','jabatan','alamat','kontak'];
    public $timestamps = false;
}
