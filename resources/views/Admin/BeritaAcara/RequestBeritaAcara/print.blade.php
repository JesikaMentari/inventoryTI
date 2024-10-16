<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara Serah Terima</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 16px;
        }
        .container {
            width: 210mm;
            height: 297mm;
            padding: 20mm;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background: white;
            position: relative;
        }
        .header {
            position: relative;
            padding-bottom: 10px;
            border-bottom: 1px solid black; /* Border line below header */
        }
        .header-content {
            display: flex;
            align-items: center;
            justify-content: center; /* Center the header text */
            position: relative;
        }
        .logo {
            position: absolute;
            left: 0; /* Position logo to the left */
            top: 50%;
            transform: translateY(-50%);
            width: 80px; /* Adjust width as needed */
            height: auto; /* Maintain aspect ratio */
        }
        .header-text {
            text-align: center;
            margin-left: 60px; /* Space for the logo */
            width: calc(100% - 60px); /* Adjust width for header text */
        }
        .header-text h2 {
            margin: 5px 0; /* Adjust spacing between titles */
        }
        .content {
            margin-top: 20px; /* Add some space above content */
        }
        .content p {
            margin: 10px 0;
        }
        .data-section {
            margin-top: 5px; /* Further reduced top margin to bring sections closer */
        }
        .data-section h4 {
            margin-bottom: 2px; /* Reduce space below the heading */
        }

        .data-table {
            margin-top: 0; /* Ensure there's no extra space above the table */
        }
        .data-table td {
            padding: 3px 0; /* Reduced padding to bring rows closer */
            vertical-align: top;
            font-size: 16px; /* Adjust as needed */
        }
        .data-table .label {
            width: 150px;
            font-weight: bold;
        }
        .data-table .separator {
            width: 10px;
            text-align: center;
        }
        .data-table tr {
            border: none;
        }
        .data-table td, .data-table th {
            border: none;
        }
        .data-table {
            border: none;
        }
        .signature {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        .signature div {
            width: 45%;
            text-align: center;
        }
        .signature div p {
            font-weight: bold; /* Bold for names */
            font-size: 18px; /* Increased font size for names */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .footer {
            display: flex;
            justify-content: left; /* Align logo to the left */
            margin-top: 40px; /* Optional spacing above footer */
            border-top: 1px solid black; /* Border line at the top of footer */
            padding-top: 10px; /* Padding for spacing */
        }
        .footer img {
            width: 450px; /* Adjust size as needed */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-content">
                <img class="logo" src="{{ asset('assets/default/web/default.png') }}" alt="Default">
                <div class="header-text">
                    <h2>BERITA ACARA SERAH TERIMA</h2>
                    <h2>PTPN IV REGIONAL III</h2>
                </div>
            </div>
        </div>

<div class="content">
            <p>Pada hari ini {{ $hari }}, tanggal {{ \Carbon\Carbon::parse($tanggal)->format('d-m-Y') }}, kami yang bertandatangan di bawah ini:</p>

            <div class="data-section">
                <h4>I. Data Pihak Pertama</h4>
                <table class="data-table">
                    <tr>
                        <td class="label">Nama</td>
                        <td class="separator">:</td>
                        <td>{{ $namaPihakPertama }}</td>
                    </tr>
                    <tr>
                        <td class="label">Jabatan</td>
                        <td class="separator">:</td>
                        <td>{{ $jabatanPihakPertama }}</td>
                    </tr>
                    <tr>
                        <td class="label">Nomor HP</td>
                        <td class="separator">:</td>
                        <td>{{ $teleponPihakPertama }}</td>
                    </tr>
                    <tr>
                        <td class="label">Unit/Keb/PKS/Instansi</td>
                        <td class="separator">:</td>
                        <td>{{ $unitPihakPertama }}</td>
                    </tr>
                </table>
            </div>

            <p>Dalam hal ini disebut sebagai PIHAK PERTAMA (yang menyerahkan) </p>
            
            <div class="data-section">
                <h4>II. Data Pihak Kedua</h4>
                <table class="data-table">
                    <tr>
                        <td class="label">Nama</td>
                        <td class="separator">:</td>
                        <td>{{ $namaPihakKedua }}</td>
                    </tr>
                    <tr>
                        <td class="label">Jabatan</td>
                        <td class="separator">:</td>
                        <td>{{ $jabatanPihakKedua }}</td>
                    </tr>
                    <tr>
                        <td class="label">Nomor HP</td>
                        <td class="separator">:</td>
                        <td>{{ $teleponPihakKedua }}</td>
                    </tr>
                    <tr>
                        <td class="label">Unit/Keb/PKS/Instansi</td>
                        <td class="separator">:</td>
                        <td>{{ $unitPihakKedua }}</td>
                    </tr>
                </table>
            </div>

            <p>Dalam hal ini disebut sebagai PIHAK KEDUA (yang menerima).</p>

            <p>Dengan ini menyatakan bahwa PIHAK PERTAMA telah menyerahkan kepada PIHAK KEDUA dan PIHAK KEDUA telah menerima perangkat sebagai berikut:</p>

            <table>
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Type</th>
                        <th>Jumlah</th>
                        <th>Service Tag / SN</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barang as $item)
                        <tr>
                            <td>{{ $item['namaBarang'] }}</td>
                            <td>{{ $item['typeBarang'] }}</td>
                            <td>{{ $item['jumlahBarang'] }}</td>
                            <td>{{ $item['snBarang'] }}</td>
                            <td>{{ $item['keteranganBarang'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <p>Sejak penandatanganan berita acara ini, maka barang tersebut menjadi tanggung jawab PIHAK KEDUA untuk dipergunakan sebagai alat kerja.</p>

            <div class="signature">
                <div>
                    <p>PIHAK PERTAMA</p>
                    <br><br><br>
                    <p>{{ $namaPihakPertama }}</p>
                </div>
                <div>
                    <p>PIHAK KEDUA</p>
                    <br><br><br>
                    <p>{{ $namaPihakKedua }}</p>
                </div>
            </div>
        </div>

<script>
            window.onload = function() {
                window.print();
            };
        </script>

        <div class="footer">
            <img src="{{ asset('assets/default/web/akhlak.png') }}" alt="akhlak">
        </div>
        
    </div>
</body>
</html>