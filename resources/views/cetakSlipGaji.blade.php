<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- JSPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    
    <!-- JQUERY -->
    <script language="JavaScript" type="text/javascript" src="{{ asset('jquery/jquery.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .sidebar {
            position: fixed;
            top: 60px;
            bottom: 0;
            left: 0;
            z-index: 1000;
            display: block;
            padding: 20px;
            /* overflow-x: hidden;
            overflow-y: auto; */
            /* Scrollable contents if viewport is shorter than content. */
            background-color: #f5f5f5;
            border-right: 1px solid #eee;
        }

        @media (min-width: 900px) {
            .main {
                padding-right: 40px;
                padding-left: 250px;
                /* 180 + 40 */
            }
        }
    </style>
</head>
<?php
$namaBulan = [
    'Januari', 'Februari', 'Maret', 'April',
    'Mei', 'Juni', 'Juli', 'Agustus', 'September',
    'Oktober', 'November', 'Desember'
];
?>

<body>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3><img src="{{ asset('img/logorobonesia.png') }}" style="width: 100px; height: 30px;"></h3>
                </div>
                <div class="col">
                    <h3>SLIP GAJI</h3>
                </div>
            </div>
            <p>Robonesia <br>
                {{ $namaBulan[$bulan] }} {{ date('Y') }}
            </p>
            <p>
                <hr>
            </p>
            @foreach ($gaji as $g)
            <table>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $g['nama'] }}</td>
                </tr>
                <tr>
                    <td>Kode</td>
                    <td>:</td>
                    <td>{{ $g['kode'] }}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>{{ $g['jabatan'] }}</td>
                </tr>
            </table>
            <hr>
            <div class="row">
                <div class="col">
                    <table>
                        <tr>
                            <td>Gaji Pokok</td>
                            <td>:</td>
                            <td>Rp.{{ $g['gaji_pokok'] }}</td>
                        </tr>
                        <tr>
                            <td>Gaji Harian</td>
                            <td>:</td>
                            <td>Rp.{{ $g['gaji_harian'] }}</td>
                        </tr>
                        <tr>
                            <td>Tunjangan Lain</td>
                            <td>:</td>
                            <td>Rp.{{ $g['tunjangan_lain'] }}</td>
                        </tr>
                        <tr>
                            <td>THR</td>
                            <td>:</td>
                            <td>Rp.{{ $g['thr'] }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col">
                    <table>
                        <tr>
                            <td>Presensi</td>
                            <td>:</td>
                            <td>{{ $g['jumlah_presensi'] }} Hari</td>
                        </tr>
                        <tr>
                            <td>Absensi</td>
                            <td>:</td>
                            <td>{{ $g['jumlah_absensi'] }} Hari</td>
                        </tr>
                        <tr>
                            <td>Potongan</td>
                            <td>:</td>
                            <td>Rp.{{ $g['potongan'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <table>
                        <tr>
                            <td>Jumlah Gaji</td>
                            <td>:</td>
                            <td>Rp.{{ $g['jumlah_gaji'] }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col">
                    <table>
                        <tr>
                            <td>Jumlah Potongan</td>
                            <td>:</td>
                            <td>Rp.{{ $g['potongan'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr>
            <h3 class="text-center"><strong>GAJI BERSIH : Rp.{{ $g['gaji_bersih'] }}</strong></h3>
            <div class="text-end">
                <p style="margin-right: 40px;">BENDAHARA</p>
                <hr style="width: 170px; margin-top: 50px;" class="position-absolute end-0">
            </div>
            @endforeach
        </div>
    </div>
    <script>
        window.print();
    </script>