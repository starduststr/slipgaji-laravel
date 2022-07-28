<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataGajiModel extends Model
{
    use HasFactory;
    protected $table = 'gaji';
    protected $fillable = [
        'kode', 'nama', 'jabatan', 'alamat', 'gaji_pokok',
        'gaji_harian', 'tunjangan_lain', 'thr', 'jumlah_presensi',
        'jumlah_absensi', 'potongan', 'jumlah_gaji', 'gaji_bersih','bulan'
    ];
    public $timestamps = false;
}
