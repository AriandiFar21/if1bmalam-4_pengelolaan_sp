<?php
session_start();
include('../koneksi.php');
require('fpdf/fpdf.php');

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

if (!$sp) {
    die("Surat Peringatan tidak ditemukan atau Anda tidak memiliki hak akses.");
}

class PDF extends FPDF {}

$pdf = new PDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetMargins(20, 20, 20);

$pdf->Image('../foto/poltek.png', 20, 20, 25);
$pdf->Image('../foto/isoo.png', 160, 20, 15);
$pdf->Image('../foto/tuv.png', 176, 20, 15);

$pdf->SetY(20);

$pdf->SetFont('Times', 'B', 11);
$pdf->Cell(0, 5, 'KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI', 0, 1, 'C');

$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(0, 7, 'POLITEKNIK NEGERI BATAM', 0, 1, 'C');

$pdf->SetFont('Times', '', 9);
$pdf->MultiCell(0, 4, "Jl. Ahmad Yani, Batam Center, Kecamatan Batam Kota, Batam 29461\nTelepon +62 778 469856 - 469860 | Laman: www.polibatam.ac.id, Surel: info@polibatam.ac.id", 0, 'C');

$y_now = $pdf->GetY();
$pdf->Ln(2);
$garis_y = $pdf->GetY();

$pdf->Line(20, $garis_y, 190, $garis_y);
$pdf->Line(20, $garis_y + 1, 190, $garis_y + 1);

$pdf->Ln(10);

$pdf->SetFont('Times', 'BU', 14);
$pdf->Cell(0, 10, 'SURAT PERINGATAN (' . strtoupper($sp['jenis_sp']) . ')', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 10, 'Yang bertanda tangan dibawah ini:', 0, 1, 'L');

function buatBaris($pdf, $label, $isi)
{
    $pdf->Cell(40, 7, $label, 0, 0);
    $pdf->Cell(5, 7, ':', 0, 0);
    $pdf->Cell(0, 7, $isi, 0, 1);
}

buatBaris($pdf, 'Nama', $sp['pemberi_sp_nama']);
buatBaris($pdf, 'NIM', $sp['pemberi_sp_nim']);
buatBaris($pdf, 'Jabatan', $sp['pemberi_sp_jabatan']);

$pdf->Ln(5);
$pdf->MultiCell(0, 7, 'Dengan ini memberikan Surat Peringatan (' . $sp['jenis_sp'] . ') kepada mahasiswa:', 0, 'J');

$pdf->SetFont('Times', 'B', 12);
buatBaris($pdf, 'Nama', $sp['nama_mahasiswa']);
buatBaris($pdf, 'NIM', $sp['nim_mahasiswa']);
$pdf->SetFont('Times', '', 12);
buatBaris($pdf, 'Jabatan', 'Mahasiswa Aktif');

$pdf->Ln(5);
$pdf->MultiCell(0, 7, 'Surat peringatan ini diberikan karena mahasiswa yang bersangkutan telah melakukan pelanggaran sebagai berikut:', 0, 'J');

buatBaris($pdf, 'Waktu', date('d F Y', strtotime($sp['tanggal_terbit'])));

$pdf->Cell(40, 7, 'Keterangan', 0, 0);
$pdf->Cell(5, 7, ':', 0, 0);
$pdf->MultiCell(0, 7, $sp['pelanggaran'], 0, 'J');

$pdf->Ln(5);
$pdf->MultiCell(0, 7, 'Diharapkan yang bersangkutan dapat memperbaiki kinerja sehingga tidak melakukan pelanggaran lagi untuk kedepannya. Demikian Surat Peringatan ini dibuat untuk dipergunakan sebagaimana mestinya.', 0, 'J');

$pdf->Ln(20);
$pdf->SetX(120);
$pdf->Cell(0, 5, 'Batam, ' . date('d F Y'), 0, 1, 'L');

$pdf->SetX(120);
$pdf->Cell(0, 5, $sp['pemberi_sp_jabatan'] . ',', 0, 1, 'L');

$pdf->Ln(25);

$pdf->SetX(120);
$pdf->SetFont('Times', 'BU', 12);
$pdf->Cell(0, 5, $sp['pemberi_sp_nama'], 0, 1, 'L');

$pdf->SetX(120);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 5, 'NIM. ' . $sp['pemberi_sp_nim'], 0, 1, 'L');

$pdf->Output('I', 'Surat_Peringatan_' . $sp['nim_mahasiswa'] . '.pdf');
