<?php
// Lakukan koneksi ke database

include "config.php";
// Ambil kode pelanggan dari permintaan POST
$kodePelanggan = $_POST['kodePelanggan'];

// Query untuk mendapatkan detail pelanggan berdasarkan kode pelanggan
$query = "SELECT * FROM pelanggan WHERE kodepelanggan = '$kodePelanggan'";
$result = mysqli_query($conn, $query);

// Lakukan pengolahan data dan tampilkan dalam format HTML
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<table>';
    echo '<tr><td>Nama Perusahaan:</td><td>' . $row['namaperusahaan'] . '</td></tr>';
    echo '<tr><td>Alamat Perusahaan:</td><td>' . $row['alamatperusahaan'] . '</td></tr>';
    // Lanjutkan dengan menampilkan data lainnya sesuai kebutuhan
    echo '</table>';
} else {
    echo 'Data pelanggan tidak ditemukan.';
}
?>
