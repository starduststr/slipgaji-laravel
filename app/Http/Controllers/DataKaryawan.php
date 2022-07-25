<?php

namespace App\Http\Controllers;

use App\Models\DataKaryawanModel;
use Illuminate\Http\Request;

class DataKaryawan extends Controller
{
    public function index()
    {
        $data = DataKaryawanModel::all();
        return view('dataKaryawan', compact('data'));
    }

    public function TambahData(Request $request)
    {
        $validasi = $request->validate([
            'kode' => ['required', 'max:6', 'unique:data_karyawan'],
            'nama' => ['required', 'max:20',],
            'jabatan' => ['required', 'max: 20',],
            'alamat' => ['required', 'max: 50',],
            'kontak' => ['required', 'max: 20',]
        ]);

        if (!$validasi) {
            return redirect()->back()->with('failed', 'INPUT DATA GAGAL');
        } else {
            DataKaryawanModel::create([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'alamat' => $request->alamat,
                'kontak' => $request->kontak
            ]);
            return redirect()->back()->with('success', 'DATA BERHASIL DITAMBAHKAN');
        }
    }

    public function delete(Request $request)
    {
        DataKaryawanModel::where('kode', $request->kode)->delete();
        return redirect()->back()->withSuccess('DATA BERHASIL DIHAPUS');
    }

    public function edit(Request $request)
    {
        $validasi = $request->validate([
            'kode' => ['required', 'max:6',],
            'nama' => ['required', 'max:20',],
            'jabatan' => ['required', 'max: 20',],
            'alamat' => ['required', 'max: 50',],
            'kontak' => ['required', 'max: 20',]
        ]);

        if (!$validasi) {
            return redirect()->back()->with('failed', 'EDIT DATA GAGAL');
        } else {
            DataKaryawanModel::where('kode', $request->kode)->update([
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'alamat' => $request->alamat,
                'kontak' => $request->kontak
            ]);
            return redirect()->back()->with('success', 'DATA BERHASIL DIUPDATE');
        }
    }
}
