<?php
include "config.php"; // Mengimpor file konfigurasi database

// Pastikan parameter namasupplier tersedia
if (isset($_GET['alamatkantor'])) {
    // Ambil nilai parameter namasupplier dari URL
    $alamatkantor = $_GET['alamatkantor'];

    // Buat query SQL untuk menghapus supplier berdasarkan namasupplier
    $deleteQuery = "DELETE FROM supplier WHERE alamatkantor = '$alamatkantor'";

    // Jalankan query penghapusan
    if (mysqli_query($conn, $deleteQuery)) {
        // Tampilkan pesan sukses dan arahkan kembali ke halaman supplier.php
        echo "<script>alert('supplier berhasil dihapus.'); window.location='supplier.php';</script>";
    } else {
        // Jika terjadi kesalahan saat menjalankan query, tampilkan pesan kesalahan dan kembalikan pengguna ke halaman sebelumnya
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.history.back();</script>";
    }

    // Tutup koneksi ke database
    mysqli_close($conn);
} else {
    // Jika parameter namasupplier tidak tersedia, tampilkan pesan kesalahan dan kembalikan pengguna ke halaman sebelumnya
    echo "<script>alert('Parameter namasupplier pelanggan tidak tersedia.'); window.history.back();</script>";
}
?>

