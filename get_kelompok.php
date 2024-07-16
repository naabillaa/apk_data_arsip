<?php
// get_kelompok.php

// Contoh koneksi ke database
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "nama_database";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil kodeproduk dari request GET
$kodeproduk = $_GET['kodeproduk'];

// Query untuk mendapatkan data kelompok berdasarkan kodeproduk
$sql = "SELECT * FROM kelompok WHERE kodeproduk = '$kodeproduk'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data dari setiap baris
    while($row = $result->fetch_assoc()) {
        // Manipulasi atau format data sesuai kebutuhan
        echo "Kode Kelompok: " . $row["kode_kelompok"] . "<br>";
        echo "Nama Kelompok: " . $row["nama_kelompok"] . "<br>";
        echo "Deskripsi: " . $row["deskripsi"] . "<br>";
        // Anda dapat menambahkan lebih banyak informasi yang ingin ditampilkan
    }
} else {
    echo "0 results";
}

$conn->close();
?>
