<?php
include "config.php"; // Mengimpor file konfigurasi database

// Pastikan parameter kodeproduk tersedia di URL
if (isset($_GET['kodeproduk'])) {
    // Ambil nilai parameter kodeproduk dari URL
    $kodeproduk = $_GET['kodeproduk'];


    // Buat query SQL untuk mengambil nama file foto produk yang terkait dengan produk
    $query = "SELECT fotoproduk FROM produksupplier WHERE kodeproduk = '$kodeproduk'";
    
    // Eksekusi query untuk mendapatkan nama file foto produk
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $fotoProduk = $row['fotoproduk'];

    // Buat query SQL untuk menghapus produk berdasarkan kodeproduk
    $deleteProdukQuery = "DELETE FROM produksupplier WHERE kodeproduk = '$kodeproduk'";
    
    // Buat query SQL untuk menghapus data dari tabel kelompok berdasarkan kodeproduk
    $deleteKelompokQuery = "DELETE FROM kelompoksupplier WHERE kodeproduk = '$kodeproduk'";
    
    // Mulai transaksi untuk memastikan kedua operasi penghapusan berhasil
    mysqli_begin_transaction($conn);

    // Eksekusi query penghapusan produk
    $error = false; // Variabel untuk menandai jika terjadi kesalahan

    if (mysqli_query($conn, $deleteProdukQuery)) {
        // Eksekusi query penghapusan kelompok
        if (mysqli_query($conn, $deleteKelompokQuery)) {
            // Jika penghapusan kelompok juga berhasil, hapus file foto produk terkait secara permanen
            $targetDir = "produk/"; // Direktori penyimpanan file foto produk
            $targetFilePath = $targetDir . $fotoProduk;
            
            // Hapus file jika ada
            if (file_exists($targetFilePath)) {
                unlink($targetFilePath);
            }

            // Commit transaksi karena kedua penghapusan berhasil
            mysqli_commit($conn);

            // Tampilkan pesan sukses dan arahkan kembali ke halaman produk.php
            echo "<script>alert('Produk berhasil dihapus.'); window.location='supplier.php';</script>";
            exit; // Keluar dari skrip setelah redirect
        } else {
            // Jika terjadi kesalahan saat menjalankan query penghapusan kelompok, rollback transaksi
            mysqli_rollback($conn);
            $error = true;
        }
    } else {
        // Jika terjadi kesalahan saat menjalankan query penghapusan produk, rollback transaksi
        mysqli_rollback($conn);
        $error = true;
    }

    // Jika terjadi kesalahan, tampilkan pesan error
    if ($error) {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.history.back();</script>";
    }

    // Tutup koneksi ke database
    mysqli_close($conn);

} else {
    // Jika parameter kodeproduk tidak tersedia, tampilkan pesan kesalahan dan kembalikan pengguna ke halaman sebelumnya
    echo "<script>alert('Parameter kodeproduk tidak tersedia.'); window.history.back();</script>";
}
?>
