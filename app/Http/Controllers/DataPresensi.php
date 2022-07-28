<?php

namespace App\Http\Controllers;

use App\Models\DataPresensiModel;
use App\Models\DataGajiModel;
use Illuminate\Http\Request;
use Response;

class DataPresensi extends Controller
{
    public function index($bulan = null)
    {   
        if(!$bulan){
           $bulan = (int)date('m'); 
        }
        $presensi = DataPresensiModel::where('bulan', $bulan)->get();
        $data = array(
            'presensi' => $presensi,
            'bulan' => $bulan
        );
        return view('dataPresensi', $data);
    }

    public function updatePresensi(Request $request)
    {
        $data = DataPresensiModel::where(['kode' => $request->kode,'bulan'=>$request->bulan])->first();
        $jumlahAbsensi  = 31 - (int)$data->jumlah_presensi;

        $data = [
            'jumlah_presensi' => (int)$data->jumlah_presensi + 1,
            'jumlah_absensi' => (int)$jumlahAbsensi
        ];
        DataPresensiModel::where(['kode' => $request->kode,'bulan'=>$request->bulan])->update($data);
        DataGajiModel::where(['kode' => $request->kode,'bulan'=>$request->bulan])->update($data);
        return response()->json($data);
    }

    public function updateAbsensi(Request $request)
    {
        $data            = DataPresensiModel::where(['kode' => $request->kode,'bulan'=>$request->bulan])->first();

        $data = [
            'jumlah_presensi' => (int)$data->jumlah_presensi - 1,
            'jumlah_absensi' => (int)$data->jumlah_absensi + 1
        ];
        DataPresensiModel::where(['kode' => $request->kode,'bulan'=>$request->bulan])->update($data);
        DataGajiModel::where(['kode' => $request->kode,'bulan'=>$request->bulan])->update($data);
        return response()->json($data);
    }
}
