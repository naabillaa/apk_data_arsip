<?php
include "config.php"; // Mengimpor file konfigurasi database

// Pastikan parameter alamatperusahaan pelanggan tersedia
if (isset($_GET['alamatperusahaan'])) {
    // Ambil nilai parameter alamatperusahaan dari URL
    $alamatperusahaan = $_GET['alamatperusahaan'];

    // Buat query SQL untuk mengambil nama file proposal yang terkait dengan pelanggan
    $query = "SELECT proposal FROM pelanggan WHERE alamatperusahaan = '$alamatperusahaan'";
    
    // Eksekusi query untuk mendapatkan nama file proposal
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $proposalFile = $row['proposal'];

    // Buat query SQL untuk menghapus pelanggan berdasarkan alamatperusahaan
    $deleteQuery = "DELETE FROM pelanggan WHERE alamatperusahaan = '$alamatperusahaan'";
    
    // Eksekusi query penghapusan
    if (mysqli_query($conn, $deleteQuery)) {
        // Jika penghapusan berhasil, hapus juga file proposal terkait
        $targetDir = "proposal/"; // Direktori penyimpanan file proposal
        $targetFilePath = $targetDir . $proposalFile;
        
        // Hapus file jika ada
        if (file_exists($targetFilePath)) {
            unlink($targetFilePath);
        }

        // Tampilkan pesan sukses dan arahkan kembali ke halaman produk.php
        echo "<script>alert('Pelanggan berhasil dihapus.'); window.location='produk.php';</script>";
    } else {
        // Jika terjadi kesalahan saat menjalankan query, tampilkan pesan kesalahan dan kembalikan pengguna ke halaman sebelumnya
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.history.back();</script>";
    }
    
    // Tutup koneksi ke database
    mysqli_close($conn);
} else {
    // Jika parameter alamatperusahaan tidak tersedia, tampilkan pesan kesalahan dan kembalikan pengguna ke halaman sebelumnya
    echo "<script>alert('Parameter alamatperusahaan pelanggan tidak tersedia.'); window.history.back();</script>";
}
?>
