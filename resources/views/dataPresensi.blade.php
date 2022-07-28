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


            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title text-white">
                        DATA PRESENSI
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
                        <li> @for ($i=1; $i < 12; $i++)
                                <a class="dropdown-item" href="{{ route('presensi-bulan',$i) }}">{{ $namaBulan[$i] }} {{ date('Y') }}</a></li>
                            @endfor
                            
                        </ul>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-stipped">
                            <thead>
                                <th>NO</th>
                                <th>KODE</th>
                                <th>NAMA</th>
                                <div id="content">
                                    @for ($i = 1; $i < 33; $i++) <th>{{ $i }}</th>
                                        @endfor
                                </div>
                                <th>JUMLAH PRESENSI</th>
                                <th>JUMLAH ABSENSI</th>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($presensi as $d)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $d['kode'] }} </td>
                                    <td>{{ $d['nama'] }} </td>
                                    @for ($i=0;$i < $d['jumlah_presensi'];$i++) <td><input type="checkbox" class="form-check" id="update{{ $i }}{{ $d['kode'] }}Absensi" value="{{$d['kode']}}" checked></td>
                                        @endfor
                                        <?php $absensi = 33 - $d['jumlah_presensi']; ?>
                                        @for ($i=1; $i < $absensi; $i++) <td><input type="checkbox" class="form-check" id="update{{ $i }}{{ $d['kode'] }}Presensi" value="{{$d['kode']}}"></td>
                                            @endfor
                                            <td id="presensi{{ $d['kode'] }}">{{ $d['jumlah_presensi'] }}</td>
                                            <td id="absensi{{ $d['kode'] }}">{{ $d['jumlah_absensi'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- UPDATE PRESENSI -->
            <script type="text/javascript">
                var dataPresensi = <?php echo json_encode($presensi); ?>;
                var dataBulan = <?php echo json_encode($bulan); ?>;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $(document).ready(function() {
                    for (let i = 1; i < 33; i++) {
                        var data = JSON.stringify(dataPresensi);
                        var baru = JSON.parse(data);

                        var bulan = JSON.stringify(dataBulan);
                        var result = JSON.parse(bulan);

                        Object.entries(baru).forEach(([key, value]) => {
                            $('#update' + i + value.kode + 'Presensi').on('change', function(e) {
                                var kode = e.target.value;
                                $.ajax({
                                    url: "{{ route('updatePresensi') }}",
                                    type: "POST",
                                    data: {
                                        kode: kode,
                                        bulan: result
                                    },
                                    success: function(data) {
                                        document.getElementById('presensi' + value.kode).innerHTML = data.jumlah_presensi;
                                        document.getElementById('absensi' + value.kode).innerHTML = data.jumlah_absensi;
                                    }
                                })
                            });
                        });
                    }
                });
            </script>

            <!-- UPDATE ABSENSI -->
            <script type="text/javascript">
                var dataPresensi = <?php echo json_encode($presensi); ?>;
                var dataBulan = <?php echo json_encode($bulan); ?>;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $(document).ready(function() {
                    for (let i = 1; i < 33; i++) {
                        var data = JSON.stringify(dataPresensi);
                        var baru = JSON.parse(data);

                        var bulan = JSON.stringify(dataBulan);
                        var result = JSON.parse(bulan);

                        Object.entries(baru).forEach(([key, value]) => {
                            $('#update' + i + value.kode + 'Absensi').on('change', function(e) {
                                var kode = e.target.value;
                                $.ajax({
                                    url: "{{ route('updateAbsensi') }}",
                                    type: "POST",
                                    data: {
                                        kode: kode,
                                        bulan: result
                                    },
                                    success: function(data) {
                                        document.getElementById('presensi' + value.kode).innerHTML = data.jumlah_presensi;
                                        document.getElementById('absensi' + value.kode).innerHTML = data.jumlah_absensi;
                                    }
                                })
                            });
                        });
                    }
                });
            </script>
            @endsection