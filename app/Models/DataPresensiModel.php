<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPresensiModel extends Model
{
    use HasFactory;
    protected $table = 'presensi';
    protected $fillable = ['kode','nama','jumlah_presensi','jumlah_absensi','bulan'];
    public $timestamps = false;
}
