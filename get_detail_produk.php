<?php
// Koneksi ke database (ganti dengan pengaturan koneksi database Anda sendiri)
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "namadatabase";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan ID produk dari permintaan GET
$kode_produk = $_GET['kode_produk'];

// Menyiapkan dan mengeksekusi kueri SQL untuk mendapatkan detail produk berdasarkan ID
$sql = "SELECT * FROM produk WHERE kode_produk = '$kode_produk'";
$result = $conn->query($sql);

// Memeriksa apakah hasil kueri tidak kosong
if ($result->num_rows > 0) {
    // Output data dari setiap baris
    while($row = $result->fetch_assoc()) {
        echo "<p>Kode Produk: " . $row["kodeproduk"]. "</p>";
        echo "<p>Nama Produk: " . $row["namaproduk"]. "</p>";
        echo "<p>Satuan: " . $row["satuan"]. "</p>";
        // Lanjutkan untuk kolom lainnya sesuai kebutuhan
    }
} else {
    echo "Detail produk tidak ditemukan";
}

// Menutup koneksi ke database
$conn->close();
?>
