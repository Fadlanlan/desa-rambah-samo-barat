<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page {
            margin: 2cm;
        }
        body {
            font-family: 'Times New Roman', serif;
            line-height: 1.5;
            color: #000;
            font-size: 12pt;
        }
        .kop-surat {
            border-bottom: 3px double #000;
            padding-bottom: 2mm;
            margin-bottom: 15mm;
            text-align: center;
            position: relative;
        }
        .logo {
            position: absolute;
            left: 0;
            top: 0;
            width: 70px;
            height: auto;
        }
        .kop-text h1 {
            font-size: 14pt;
            margin: 0;
            text-transform: uppercase;
            font-weight: bold;
        }
        .kop-text h2 {
            font-size: 16pt;
            margin: 0;
            text-transform: uppercase;
            font-weight: bold;
        }
        .kop-text p {
            font-size: 10pt;
            margin: 0;
            font-style: italic;
        }
        .judul-surat {
            text-align: center;
            margin-bottom: 10mm;
        }
        .judul-surat h3 {
            text-transform: uppercase;
            text-decoration: underline;
            margin-bottom: 0;
            font-size: 12pt;
        }
        .judul-surat p {
            margin-top: 2px;
            font-size: 11pt;
        }
        .content {
            text-align: justify;
            margin-bottom: 15mm;
        }
        .content p {
            margin-bottom: 5mm;
            text-indent: 1cm;
        }
        .ttd-wrapper {
            float: right;
            width: 6cm;
            text-align: center;
        }
        .ttd-space {
            height: 2cm;
            position: relative;
        }
        .qr-code {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            top: 5mm;
        }
        .footer-note {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            font-size: 8pt;
            color: #666;
            border-top: 1px solid #ccc;
            padding-top: 2mm;
            text-align: center;
        }
        .clear {
            clear: both;
        }
    </style>
</head>
<body>
    <div class="kop-surat">
        @if(file_exists(public_path('images/logo_desa.png')))
            <img src="{{ public_path('images/logo_desa.png') }}" class="logo">
        @endif
        <div class="kop-text">
            <h1>Pemerintah Kabupaten {{ config('desa.kabupaten') }}</h1>
            <h1>Kecamatan {{ config('desa.kecamatan') }}</h1>
            <h2>Pemerintah Desa {{ config('desa.nama_desa') }}</h2>
            <p>Alamat: {{ config('desa.alamat') }}, Kode Pos: {{ config('desa.kode_pos') }}</p>
            <p>Email: {{ config('desa.email') }} | Website: {{ config('desa.website') }}</p>
        </div>
    </div>

    <div class="judul-surat">
        <h3>{{ $surat->jenisSurat->nama }}</h3>
        <p>Nomor: {{ $surat->nomor_surat }}</p>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <div class="ttd-wrapper">
        <p>{{ config('desa.nama_desa') }}, {{ $surat->tanggal_disetujui ? $surat->tanggal_disetujui->format('d F Y') : now()->format('d F Y') }}</p>
        <p>{{ config('desa.jabatan') }}</p>
        <div class="ttd-space">
            @if(isset($qrCode))
                <div class="qr-code">
                    {!! $qrCode !!}
                </div>
            @endif
        </div>
        <p style="margin-top: 5mm; font-weight: bold; text-decoration: underline;">{{ config('desa.kepala_desa') }}</p>
        @if(config('desa.nip_kepala_desa') != '-')
        <p style="margin-top: -4mm;">NIP. {{ config('desa.nip_kepala_desa') }}</p>
        @endif
    </div>

    <div class="footer-note">
        Dokumen ini diterbitkan secara elektronik melalui Sistem Informasi Desa {{ config('desa.nama_desa') }}.<br>
        Keaslian dokumen dapat diverifikasi dengan memindai kode QR atau melalui tautan resmi desa.
    </div>
</body>
</html>
