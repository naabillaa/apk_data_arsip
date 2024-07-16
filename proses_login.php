<?php
include 'log_activity.php';

// Pastikan data formulir disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data login dari formulir
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Koneksi ke database
    $conn = new mysqli("localhost", "username", "password", "database_name");

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query database untuk mencari pengguna dengan username yang sesuai
    $sql = "SELECT id, password_hash FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa apakah pengguna ditemukan dan password cocok
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            // Autentikasi berhasil
            $login_successful = true;
            $userId = $row['id'];
        }
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();

    // Jika autentikasi berhasil, catat aktivitas login
    if ($login_successful) {
        logActivity($userId, "Masuk ke sistem");
        // Redirect ke dashboard atau halaman lainnya
        header("Location: dashboard.php");
        exit();
    } else {
        // Jika login gagal, kembalikan pengguna ke halaman login dengan pesan kesalahan
        header("Location: login.php?error=1");
        exit();
    }
}
?>

