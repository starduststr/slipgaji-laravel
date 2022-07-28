<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataGajiModel;
use Illuminate\Validation\Rules\In;

class DataGaji extends Controller
{
    public function index($bulan = null)
    {   
        if(!$bulan){
            $bulan = (int)date('m');
        }
        $gaji = DataGajiModel::where(['bulan'=>$bulan])->get();
        $data = array(
            'gaji' => $gaji,
            'bulan' => $bulan
        );

        return view('dataGaji', $data);
    }

    public function updateGaji(Request $request)
    {
        $data = array(
            'gaji_pokok' => $request->gaji_pokok,
            'gaji_harian' => $request->gaji_harian,
            'tunjangan_lain' => $request->tunjangan_lain,
            'thr' => $request->thr,
            'potongan' => $request->potongan,
            'jumlah_gaji' => $request->jumlah_gaji,
            'gaji_bersih' => $request->gaji_bersih
        );

        $result = DataGajiModel::where(['kode'=>$request->kode,'bulan'=>$request->bulan])->update($data);

        return response()->json($data);
    }

    public function cetak($data = null)
    {
        $result = explode('-',$data);

        $kode = $result[0];
        $bulan = $result[1];
        $gaji = DataGajiModel::where(['kode'=>$kode,'bulan'=>$bulan])->get();
        $data = array(
            'bulan'=> $bulan,
            'gaji'=> $gaji
        );

        return view('cetakSlipGaji', $data);
    }

}
