<?php
// Tentukan direktori tempat penyimpanan file proposal
$fileDir = 'proposal/';

// Pastikan parameter file telah diterima dengan benar
if (isset($_GET['file'])) {
    // Mendapatkan nama file dari parameter GET
    $fileName = $_GET['file'];

    // Mendapatkan path lengkap file
    $filePath = $fileDir . $fileName;

    // Periksa apakah file ada
    if (file_exists($filePath)) {
        // Set header untuk menentukan jenis file yang akan diunduh
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');

        // Baca file untuk diunduh
        readfile($filePath);
        exit;
    } else {
        // Jika file tidak ditemukan, tampilkan pesan error
        echo "File tidak ditemukan.";
    }
} else {
    // Jika parameter file tidak ada, tampilkan pesan error
    echo "Parameter file tidak valid.";
}
?>
