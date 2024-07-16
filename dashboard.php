<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <h2>Log Aktivitas</h2>
    <ul>
        <?php
        // Koneksi ke database
        $conn = new mysqli("localhost", "root", "", "adminn");

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Ambil log aktivitas dari database
        $sql = "SELECT * FROM activity_logs ORDER BY timestamp DESC LIMIT 10";
        $result = $conn->query($sql);

        // Tampilkan log aktivitas
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<li>" . $row["timestamp"]. ": " . $row["activity"]. "</li>";
            }
        } else {
            echo "Tidak ada aktivitas yang dicatat.";
        }

        // Tutup koneksi
        $conn->close();
        ?>
    </ul>
</body>
</html>
