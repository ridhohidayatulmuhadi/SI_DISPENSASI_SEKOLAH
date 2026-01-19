<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dispensasi_{{ $suratDispensasi->siswa->nama }}</title>
    <style>
        @page {
            margin: 1cm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11pt;
            color: #111;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .school-name {
            font-size: 16pt;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .address {
            font-size: 9pt;
            font-style: italic;
            color: #444;
        }

        .title {
            text-align: center;
            margin-bottom: 30px;
        }

        .title-text {
            font-size: 14pt;
            font-weight: bold;
            text-decoration: underline;
            display: inline-block;
        }

        .content {
            text-align: justify;
        }

        .data-table {
            width: 100%;
            margin: 20px 0;
        }

        .data-table td {
            padding: 5px 0;
            vertical-align: top;
        }

        .label {
            width: 30%;
            color: #555;
            font-size: 10pt;
            text-transform: uppercase;
        }

        .value {
            font-weight: bold;
        }

        .reason-box {
            background-color: #f9f9f9;
            border-left: 4px solid #ddd;
            padding: 10px 15px;
            font-style: italic;
            margin: 15px 0;
        }

        .footer {
            margin-top: 50px;
            width: 100%;
        }

        .signature {
            float: right;
            width: 250px;
            text-align: center;
        }

        .sig-space {
            height: 70px;
        }

        .sig-name {
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="school-name">SMK NEGERI 2 MOJOKERTO</div>
        <div class="address">
            Jl. Raya Pulo Rejo, Kota Mojokerto, Jawa Timur<br>
            Telp. (0321) 123456 • Website: smkn2mojokerto.sch.id
        </div>
    </div>

    <div class="title">
        <div class="title-text uppercase">SURAT DISPENSASI</div><br>
        <small style="color: #666">No: {{ $suratDispensasi->id }}/DISP/{{ date('Y') }}</small>
    </div>

    <div class="content">
        <p>Yang bertanda tangan di bawah ini menerangkan bahwa:</p>

        <table class="data-table">
            <tr>
                <td class="label">Nama Lengkap</td>
                <td width="2%">:</td>
                <td class="value uppercase">{{ $suratDispensasi->siswa->nama }}</td>
            </tr>
            <tr>
                <td class="label">NIS</td>
                <td>:</td>
                <td class="value font-mono">{{ $suratDispensasi->siswa->nis }}</td>
            </tr>
            <tr>
                <td class="label">Kelas / Jurusan</td>
                <td>:</td>
                <td class="value uppercase">{{ $suratDispensasi->siswa->kelas }}
                    {{ $suratDispensasi->siswa->jurusan->nama }}</td>
            </tr>
        </table>

        <p>
            Diberikan dispensasi <strong>{{ $suratDispensasi->jenisSurat->nama }}</strong> pada tanggal
            <strong>{{ \Carbon\Carbon::parse($suratDispensasi->tanggal_mulai)->translatedFormat('d F Y') }}</strong>.
            Siswa yang bersangkutan harus kembali ke sekolah pada jam pelajaran
            ke-{{ $suratDispensasi->kembali_pelajaran_ke }}
            (Pukul {{ \Carbon\Carbon::parse($suratDispensasi->waktu_kembali_batas)->format('H:i') }} WIB).
        </p>

        <div class="reason-box">
            "{{ $suratDispensasi->alasan }}"
        </div>

        <p>Demikian surat dispensasi ini dibuat untuk dipergunakan sebagaimana mestinya.</p>
    </div>

    <div class="footer">
        <div class="signature">
            <p>Mojokerto, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p style="margin-top: 5px; font-weight: bold">Mengetahui,</p>
            <div class="sig-space"></div>
            <p class="sig-name">Kepala Tata Usaha</p>
            <p style="font-size: 8pt; color: #555">NIP. 19820304 201001 1 012</p>
        </div>
        <div class="clear"></div>
    </div>

</body>

</html>
