@extends('pdf.layout')

@section('content')
<p style="text-indent: 1cm;">Yang bertanda tangan di bawah ini Kepala Desa {{ config('desa.nama_desa') }}, Kecamatan {{ config('desa.kecamatan') }}, Kabupaten {{ config('desa.kabupaten') }}, dengan ini menerangkan bahwa:</p>

<table style="width: 100%; margin-left: 1cm; margin-bottom: 20px; border-collapse: collapse;">
    <tr>
        <td style="width: 35%; padding: 2px 0;">Nama Lengkap</td>
        <td style="width: 2%; padding: 2px 0;">:</td>
        <td style="font-weight: bold; padding: 2px 0;">{{ $surat->penduduk->nama }}</td>
    </tr>
    <tr>
        <td style="padding: 2px 0;">NIK</td>
        <td style="padding: 2px 0;">:</td>
        <td style="padding: 2px 0;">{{ $surat->penduduk->nik }}</td>
    </tr>
    <tr>
        <td style="padding: 2px 0;">Tempat/Tgl Lahir</td>
        <td style="padding: 2px 0;">:</td>
        <td style="padding: 2px 0;">{{ $surat->penduduk->tempat_lahir }}, {{ $surat->penduduk->tanggal_lahir->format('d/m/Y') }}</td>
    </tr>
    <tr>
        <td style="padding: 2px 0;">Jenis Kelamin</td>
        <td style="padding: 2px 0;">:</td>
        <td style="padding: 2px 0;">{{ $surat->penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
    </tr>
    <tr>
        <td style="padding: 2px 0;">Agama</td>
        <td style="padding: 2px 0;">:</td>
        <td style="padding: 2px 0;">{{ $surat->penduduk->agama ?? '-' }}</td>
    </tr>
    <tr>
        <td style="padding: 2px 0;">Pekerjaan</td>
        <td style="padding: 2px 0;">:</td>
        <td style="padding: 2px 0;">{{ $surat->penduduk->pekerjaan }}</td>
    </tr>
    <tr>
        <td style="padding: 2px 0; vertical-align: top;">Alamat</td>
        <td style="padding: 2px 0; vertical-align: top;">:</td>
        <td style="padding: 2px 0;">{{ $surat->penduduk->alamat }}</td>
    </tr>
</table>

<p style="text-indent: 1cm;">Orang tersebut di atas adalah benar warga Desa {{ config('desa.nama_desa') }} yang berdomisili di alamat tersebut. Surat Keterangan ini diberikan kepada yang bersangkutan untuk keperluan:</p>

<div style="margin: 10px 0 20px 1cm; font-weight: bold; border: 1px solid #eee; padding: 10px;">
    {{ $surat->keperluan }}
</div>

<p style="text-indent: 1cm;">Demikian Surat Keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
@endsection

