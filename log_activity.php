<?php

function logActivity($userId, $activity) {
    // Koneksi ke database
    $conn = new mysqli("localhost", "username", "password", "database_name");

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Persiapkan pernyataan SQL
    $stmt = $conn->prepare("INSERT INTO activity_logs (user_id, activity) VALUES (?, ?)");
    $stmt->bind_param("is", $userId, $activity);

    // Eksekusi pernyataan SQL
    $stmt->execute();

    // Tutup pernyataan dan koneksi
    $stmt->close();
    $conn->close();
}

?>

