<?php

$logFile = 'activity_log.txt'; // Lokasi file log

// Cek apakah file log sudah ada, jika belum, buat file baru
if (!file_exists($logFile)) {
    $fileHandle = fopen($logFile, 'w'); // Buka file dalam mode tulis
    fclose($fileHandle); // Tutup file
}

?>
