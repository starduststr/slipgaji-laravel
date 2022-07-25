@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('failed'))
            <div class="alert alert-danger">
                <span>{{ session('failed') }}</span>
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success">
                <span>{{ session('success') }}</span>
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahdata"><i class="fa fa-user-plus"></i> Tambah Data</button>
            <div class="card mt-2 position-end">
                <div class="card-header bg-primary">
                    <div class="card-title text-white">
                        <i class="fa fa-id-badge"></i> {{ __('DATA KARYAWAN') }}
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-stripped text-center">
                            <thead>
                                <th>NO.</th>
                                <th>KODE</th>
                                <th>NAMA</th>
                                <th>ALAMAT</th>
                                <th>JABATAN</th>
                                <th>KONTAK</th>
                                <th>AKSI</th>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($data as $d)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $d['kode'] }}</td>
                                    <td>{{ $d['nama'] }}</td>
                                    <td>{{ $d['alamat'] }}</td>
                                    <td>{{ $d['jabatan'] }}</td>
                                    <td>{{ $d['kontak'] }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit{{ $d['kode'] }}Modal">
                                            <i class="fa fa-edit"></i> EDIT
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $d['kode'] }}Modal">
                                            <i class="fa fa-trash"></i> HAPUS
                                        </button>
                                    </td>
                                </tr>
                                <!-- MODAL UPDATE DATA -->
                                <div class="modal fade" id="edit{{ $d['kode'] }}Modal" tabindex="-1" aria-labelledby="edit{{ $d['kode'] }}ModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">EDIT DATA KARYAWAN</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('editkaryawan')}}" class="form-group">
                                                    @csrf
                                                    <label for="kode">KODE</label>
                                                    <input class="form-control" name="kode" placeholder="INPUT DISINI" value="{{ $d['kode'] }}" readonly>
                                                    <label for="nama">NAMA</label>
                                                    <input class="form-control" name="nama" placeholder="INPUT DISINI" value="{{ $d['nama'] }}">
                                                    <label for="jabatan">JABATAN</label>
                                                    <input class="form-control" name="jabatan" placeholder="INPUT DISINI" value="{{ $d['jabatan'] }}">
                                                    <label for="kontak">KONTAK</label>
                                                    <input class="form-control" name="kontak" placeholder="INPUT DISINI" value="{{ $d['kontak'] }}">
                                                    <label for="alamat">ALAMAT</label>
                                                    <textarea class="form-control" name="alamat" rows="3">{{ $d['alamat'] }}</textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- MODAL DETELE DATA -->
                                <div class="modal fade" id="delete{{ $d['kode'] }}Modal" tabindex="-1" aria-labelledby="delete{{ $d['kode'] }}ModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Apakah anda yakin?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('deletekaryawan')}}">
                                                    @csrf
                                                    <input type="hidden" name="kode" value="{{$d['kode']}}"> Hapus data karyawan <strong>{{ $d['nama'] }}</strong>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Ya</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- MODAL TAMBAH DATA -->
<div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="tambahdataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahdataLabel">Tambah data karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-group" method="POST" action="{{ route('tambahkaryawan') }}">
                    @csrf
                    <label for="kode">KODE</label>
                    <input class="form-control" name="kode" placeholder="INPUT DISINI" value="{{ old('kode') }}">
                    <label for="nama">NAMA</label>
                    <input class="form-control" name="nama" placeholder="INPUT DISINI" value="{{ old('nama') }}">
                    <label for="jabatan">JABATAN</label>
                    <input class="form-control" name="jabatan" placeholder="INPUT DISINI" value="{{ old('jabatan') }}">
                    <label for="kontak">KONTAK</label>
                    <input class="form-control" name="kontak" placeholder="INPUT DISINI" value="{{ old('kontak') }}">
                    <label for="alamat">ALAMAT</label>
                    <textarea class="form-control" name="alamat" rows="3">{{ old('alamat') }}</textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">BATAL</button>
                <button type="submit" class="btn btn-primary">SIMPAN</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection