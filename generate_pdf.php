<?php
// Include library Dompdf
require_once 'vendor/autoload.php';

// Buat objek Dompdf
use Dompdf\Dompdf;
$dompdf = new Dompdf();

// Ambil isi halaman web yang ingin Anda konversi menjadi PDF
$html = file_get_contents('http://localhost/lokasi/halaman_anda.php');

// Muat konten HTML ke objek Dompdf
$dompdf->loadHtml($html);

// Atur ukuran dan orientasi halaman PDF
$dompdf->setPaper('A4', 'portrait');

// Render halaman HTML ke PDF
$dompdf->render();

// Simpan PDF dalam variabel
$output = $dompdf->output();

// Tulis konten PDF ke file
file_put_contents('output.pdf', $output);

// Set header untuk memberi tahu browser bahwa ini adalah file PDF yang akan diunduh
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="output.pdf"');

// Pindahkan file PDF ke folder download bawaan
$download_folder = $_SERVER['DOCUMENT_ROOT'] . '/download/'; // Lokasi folder download
rename('output.pdf', $download_folder . 'output.pdf');

// Redirect ke halaman asal atau tampilkan pesan sukses
echo "<script>alert('File PDF berhasil diunduh.'); window.location='halaman_anda.php';</script>";
?>
