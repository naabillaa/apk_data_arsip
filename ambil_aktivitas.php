<?php
// Include file koneksi.php untuk melakukan koneksi ke database
include 'config.php';

// Query untuk mengambil aktivitas terbaru dari database
$sql = "SELECT * FROM aktivitas ORDER BY timestamp DESC LIMIT 10"; // Mengambil 10 aktivitas terbaru
$result = $conn->query($sql);

// Memuat aktivitas dalam format HTML
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="activity-item">';
        echo '<p>' . $row['user'] . ' ' . $row['activity'] . '</p>';
        echo '<span class="timestamp">' . $row['timestamp'] . '</span>';
        echo '</div>';
    }
} else {
    echo "Tidak ada aktivitas saat ini.";
}
// Menutup koneksi database
$conn->close();
?>
