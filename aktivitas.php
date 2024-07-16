<?php
// Koneksi ke database
include 'config.php';

// Dapatkan riwayat aktivitas pengguna dari database
function getRiwayatAktivitas($userID) {
    global $conn;
    
    $sql = "SELECT * FROM riwayat_aktivitas WHERE user_id = '$userID' ORDER BY waktu DESC";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li>" . $row["aktivitas"] . " pada tanggal " . $row["waktu"] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "Belum ada aktivitas.";
    }
}

// Contoh penggunaan fungsi simpanAktivitas
// Misalnya, saat pengguna melakukan pembelian, Anda dapat memanggil fungsi ini dengan ID pengguna dan detail pembelian
// simpanAktivitas($userID, "Melakukan pembelian produk X");

// Contoh penggunaan fungsi getRiwayatAktivitas
// Misalnya, untuk menampilkan riwayat aktivitas pengguna dengan ID 1
// getRiwayatAktivitas(1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Riwayat Aktivitas Pengguna</title>
<link rel="stylesheet" href="styles.css"> <!-- Anda mungkin memiliki file CSS terpisah -->
</head>
<body>

<div class="container">
    <h1>Riwayat Aktivitas Pengguna</h1>
    <p>Selamat datang, <strong>Nama Pengguna</strong>! Berikut adalah beberapa aktivitas terbaru Anda:</p>
    
    <?php
    // Contoh penggunaan fungsi getRiwayatAktivitas
    // Misalnya, untuk menampilkan riwayat aktivitas pengguna dengan ID 1
    // getRiwayatAktivitas(1);
    ?>
    
    <p>Anda juga dapat mencetak riwayat aktivitas Anda:</p>
    <a href="#" class="btn btn-sm btn-neutral" id="printButton">Cetak Riwayat</a>
</div>

<script>
    // Fungsi untuk memicu perintah pencetakan saat tombol "Cetak Riwayat" diklik
    document.getElementById("printButton").addEventListener("click", function() {
        window.print(); // Memicu perintah pencetakan pada browser
        return false; // Mencegah tautan standar untuk diikuti
    });
</script>

</body>
</html>
