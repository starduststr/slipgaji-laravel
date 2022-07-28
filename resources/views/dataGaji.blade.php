@extends('layouts.app')

@section('content')
<style>
    td {
        min-width: 100px;
    }

    th {
        min-width: 130px;
    }
</style>
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

            <div class="card mt-2 position-end">
                <div class="card-header bg-primary">
                    <div class="card-title text-white">
                        <i class="fa fa-id-badge"></i> {{ __('DATA PENGGAJIAN') }}
                    </div>
                </div>

                <div class="card-body">
                    <?php
                    $namaBulan = [
                        'Januari', 'Februari', 'Maret', 'April',
                        'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                        'Oktober', 'November', 'Desember'
                    ];
                    ?>
                    <div class="dropdown">
                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $namaBulan[$bulan] }} {{ date('Y') }}
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li> @for ($i=1; $i < 12; $i++) <a class="dropdown-item" href="{{ route('gaji-bulan',$i) }}">{{ $namaBulan[$i] }} {{ date('Y') }}</a></li>
                            @endfor

                        </ul>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-stripped">
                            <thead>
                                <th>NO</th>
                                <th>KODE</th>
                                <th>NAMA</th>
                                <th>JABATAN</th>
                                <th>GAJI POKOK</th>
                                <th>GAJI HARIAN</th>
                                <th>TUNJANGAN LAIN</th>
                                <th>THR</th>
                                <th>PRESENSI</th>
                                <th>ABSENSI</th>
                                <th>POTONGAN</th>
                                <th>JUMLAH GAJI</th>
                                <th>GAJI BERSIH</th>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($gaji as $g)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $g['kode'] }}</td>
                                    <td>{{ $g['nama'] }}</td>
                                    <td>{{ $g['jabatan'] }}</td>
                                    <td>
                                        <input type="text" class="form-control" id="gajiPokok{{ $g['kode'] }}" placeholder="{{ $g['gaji_pokok'] }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="gajiHarian{{ $g['kode'] }}" placeholder="{{ $g['gaji_harian'] }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="tunjanganLain{{ $g['kode'] }}" placeholder="{{ $g['tunjangan_lain'] }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="thr{{ $g['kode'] }}" placeholder="{{ $g['thr'] }}">
                                    </td>

                                    <div class="">
                                        <div class="">

                                            <td id="jumlahPresensi{{ $g['kode'] }}" value="{{ $g['jumlah_presensi'] }}">{{ $g['jumlah_presensi'] }} Hari</td>
                                            <td id="jumlahAbsensi{{ $g['kode'] }}" value="{{ $g['jumlah_absensi'] }}">{{ $g['jumlah_absensi'] }} Hari</td>
                                            <td id="potongan{{ $g['kode'] }}">{{ $g['potongan'] }}</td>
                                            <td id="jumlahGaji{{ $g['kode'] }}">{{ $g['jumlah_gaji'] }}</td>
                                            <td id="gajiBersih{{ $g['kode'] }}">{{ $g['gaji_bersih'] }}</td>
                                            <td id=""><a href="{{ route('cetakSlipGaji',$g['kode'].'-'.$bulan) }}" class="btn btn-sm btn-primary">CETAK SLIP GAJI</a></td>

                                        </div>
                                    </div>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var dataGaji = <?php echo json_encode($gaji); ?>;
    var dataBulan = <?php echo json_encode($bulan); ?>;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        window.onkeyup = function() {
                var data = JSON.stringify(dataGaji);
                var baru = JSON.parse(data);

                var bulan = JSON.stringify(dataBulan);
                var result = JSON.parse(bulan);
                
                Object.entries(baru).forEach(([key, value]) => {
                    
                    let gajiPokok = parseFloat(document.getElementById('gajiPokok'+value.kode).value|0);
                    let gajiHarian = parseFloat(document.getElementById('gajiHarian'+value.kode).value|0);
                    let tunjanganLain = parseFloat(document.getElementById('tunjanganLain'+value.kode).value|0);
                    let thr       = parseFloat(document.getElementById('thr'+value.kode).value|0);

                    let jumlahPresensi = parseFloat(document.getElementById('jumlahPresensi'+value.kode).getAttribute('value')|0);
                    let jumlahAbsensi = parseFloat(document.getElementById('jumlahAbsensi'+value.kode).getAttribute('value')|0);

                    let potongan = gajiHarian * jumlahAbsensi;
                    let jumlahGaji = (gajiHarian * jumlahPresensi) + gajiPokok + tunjanganLain +thr;
                    let gajiBersih = jumlahGaji - potongan;
                        $.ajax({
                            url: "{{ route('updateGaji') }}",
                            type: "POST",
                            data: {
                                kode: value.kode,
                                bulan: result,
                                gaji_pokok: gajiPokok,
                                gaji_harian: gajiHarian,
                                tunjangan_lain: tunjanganLain,
                                thr: thr,
                                potongan: potongan,
                                gaji_bersih: gajiBersih,
                                jumlah_gaji: jumlahGaji
                            },
                            success: function(data) {
                                console.log(data)
                                document.getElementById('potongan' + value.kode).innerHTML = data.potongan;
                                document.getElementById('gajiBersih' + value.kode).innerHTML = data.gaji_bersih;
                                document.getElementById('jumlahGaji' + value.kode).innerHTML = data.jumlah_gaji;
                            }
                        })
                });
        }
    });
</script>
@endsection