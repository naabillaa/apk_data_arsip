<?php
if(isset($_GET['fotoproduk'])) {
    // Mendapatkan nama file fotoproduk dari parameter URL
    $fotoproduk = $_GET['fotoproduk'];

    // Menentukan direktori tempat file disimpan
    $fileDir = 'produk/';  // Sesuaikan dengan nama direktori tempat foto disimpan

    // Membuat path lengkap ke file
    $filePath =  urldecode($fotoproduk);  // Menggabungkan direktori dengan nama file

    // Memeriksa apakah file foto tersebut ada di direktori
    if(file_exists($filePath)) {
        // Menampilkan foto dengan tag img
        echo "<img src='$filePath' alt='Foto Produk' style='max-width: 100%; height: auto;' />";
    } else {
        echo "File foto tidak ditemukan. Path: $filePath";
    }
} else {
    echo "Tidak ada file yang dipilih untuk ditampilkan.";
}
?>
