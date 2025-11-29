<?php
session_start();
include('../koneksi.php');

// Keamanan dasar (tetap dipertahankan karena penting)
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'mahasiswa') {
    die("Akses ditolak. Anda harus login sebagai mahasiswa.");
}
if (!isset($_GET['id']) || $_GET['id'] == '') {
    die("ID Surat Peringatan tidak valid.");
}

$id_sp = $_GET['id'];
$nim_mahasiswa_session = $_SESSION['nim'];

$sql = "SELECT * FROM sp WHERE id_sp = '$id_sp' AND nim_mahasiswa = '$nim_mahasiswa_session'";
$result = mysqli_query($koneksi, $sql);
$sp = mysqli_fetch_assoc($result);

// Cek jika data ditemukan
if (!$sp) {
    die("Surat Peringatan tidak ditemukan atau Anda tidak memiliki hak akses.");
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Surat Peringatan - <?= $sp['nama_mahasiswa']; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Times+New+Roman&display=swap" rel="stylesheet">
    <style>
        /* (CSS Anda tidak diubah sama sekali) */
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
        }

        .container {
            width: 21cm;
            min-height: 29.7cm;
            padding: 2cm;
            margin: 1cm auto;
            border: 1px #D3D3D3 solid;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .kop-surat {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        .logo-kiri {
            width: 90px;
            height: auto;
        }

        .kop-text {
            text-align: center;
            line-height: 1.2;
            flex-grow: 1;
        }

        .kop-text .kementerian {
            font-size: 12pt;
            font-weight: bold;
        }

        .kop-text .politeknik {
            font-size: 16pt;
            font-weight: bold;
            margin: 2px 0;
        }

        .kop-text .alamat {
            font-size: 9pt;
        }

        .logo-kanan-container {
            display: flex;
            gap: 5px;
        }

        .logo-kanan {
            width: 45px;
            height: auto;
        }

        .judul-surat {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin-top: 30px;
            margin-bottom: 20px;
            font-size: 14pt;
        }

        .isi-surat table {
            width: 100%;
            border-collapse: collapse;
        }

        .isi-surat table td {
            padding: 2px 0;
            vertical-align: top;
        }

        .isi-surat table td:first-child {
            width: 150px;
        }

        .isi-surat table td:nth-child(2) {
            width: 20px;
        }

        .tanda-tangan {
            margin-top: 60px;
            width: 100%;
            text-align: right;
        }

        .tanda-tangan .ttd-kanan {
            width: 300px;
            float: right;
        }

        .tanda-tangan .ttd-kanan p {
            margin-bottom: 80px;
        }

        .print-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #0d6efd;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        @media print {
            body {
                margin: 0;
                background: none;
            }

            .container {
                margin: 0;
                border: none;
                box-shadow: none;
                width: 100%;
                min-height: 0;
                padding: 0;
            }

            .print-button {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="kop-surat">
            <img src="https://www.polibatam.ac.id/wp-content/uploads/2022/01/poltek.png" alt="Logo Polibatam" class="logo-kiri">
            <div class="kop-text">
                <p class="kementerian">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</p>
                <p class="politeknik">POLITEKNIK NEGERI BATAM</p>
                <p class="alamat">Jl. Ahmad Yani, Batam Center, Kecamatan Batam Kota, Batam 29461 <br> Telepon +62 778 469856 - 469860 | Laman: www.polibatam.ac.id, Surel: info@polibatam.ac.id</p>
            </div>
            <div class="logo-kanan-container">
                <img src="https://cdn.freebiesupply.com/logos/large/2x/urs-iso-9001-logo-png-transparent.png" alt="Logo URS" class="logo-kanan">
                <img src="https://cdn.freebiesupply.com/logos/large/2x/tuv-5-logo-png-transparent.png" alt="Logo TUV" class="logo-kanan">
            </div>
        </div>

        <p class="judul-surat">SURAT PERINGATAN (<?= $sp['jenis_sp']; ?>)</p>
        <div class="isi-surat">
            <p>Yang bertanda tangan dibawah ini:</p>
            <table>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?= $sp['pemberi_sp_nama']; ?></td>
                </tr>
                <tr>
                    <td>NIM</td>
                    <td>:</td>
                    <td><?= $sp['pemberi_sp_nim']; ?></td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td><?= $sp['pemberi_sp_jabatan']; ?></td>
                </tr>
            </table>
            <p>Dengan ini memberikan <b>Surat Peringatan (<?= $sp['jenis_sp']; ?>)</b> kepada mahasiswa:</p>
            <table>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><b><?= $sp['nama_mahasiswa']; ?></b></td>
                </tr>
                <tr>
                    <td>NIM</td>
                    <td>:</td>
                    <td><b><?= $sp['nim_mahasiswa']; ?></b></td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>Mahasiswa Aktif</td>
                </tr>
            </table>
            <p>Surat peringatan ini diberikan karena mahasiswa yang bersangkutan telah melakukan pelanggaran sebagai berikut:</p>
            <table>
                <tr>
                    <td>Waktu Pelanggaran</td>
                    <td>:</td>
                    <td><?= date('d F Y', strtotime($sp['tanggal_terbit'])); ?></td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td><?= nl2br($sp['pelanggaran']); ?></td>
                </tr>
            </table>
            <p>Diharapkan yang bersangkutan dapat memperbaiki kinerja sehingga tidak melakukan pelanggaran lagi untuk kedepannya. Demikian <b>Surat Peringatan (<?= $sp['jenis_sp']; ?>)</b> ini dibuat untuk dipergunakan sebagaimana mestinya.</p>
        </div>
        <div class="tanda-tangan">
            <div class="ttd-kanan">
                Batam, <?= date('d F Y'); ?>
                <p><?= $sp['pemberi_sp_jabatan']; ?>,</p>
                <b><u><?= $sp['pemberi_sp_nama']; ?></u></b><br>
                NIM. <?= $sp['pemberi_sp_nim']; ?>
            </div>
        </div>
    </div>
    <button class="print-button" onclick="window.print()">Cetak Surat</button>
</body>

</html>