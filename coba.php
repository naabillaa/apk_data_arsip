<?php
// Pastikan file 'config.php' memiliki detail koneksi database Anda
include 'config.php';
session_start();

// Redirect ke halaman login jika tidak terotentikasi
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Set nilai default untuk $kodesupplier jika tidak ada dalam $_GET
$kodesupplier = isset($_GET['kodesupplier']) ? $_GET['kodesupplier'] : "Nilai Default";

// Proses form jika metode adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDir = "produk/";

    // Query untuk memasukkan data produk supplier
    $sql_produk = "INSERT INTO produksupplier (kodeproduk, namaproduk, satuan, tanggal, jumlah, harga, tanggal2, jumlah2, harga2, spesifikasi, fotoproduk, fotoproduk2, kodesupplier) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_produk = $conn->prepare($sql_produk);

    // Bind parameter untuk statement produk
    $stmt_produk->bind_param("sssssssssssss", $kodeproduk, $namaproduk, $satuan, $tanggal, $jumlah, $harga, $tanggal2, $jumlah2, $harga2, $spesifikasi, $fotoproduk, $fotoproduk2, $kodesupplier);

    // Ambil nilai dari $_POST untuk setiap variabel
    $kodeproduk = $_POST["kodeproduk"];
    $namaproduk = $_POST["namaproduk"];
    $satuan = $_POST["satuan"];
    $tanggal = $_POST["tanggal"]; 
    $jumlah = $_POST["jumlah"];
    $harga = $_POST["harga"];
    $tanggal2 = $_POST["tanggal2"]; 
    $jumlah2 = $_POST["jumlah2"];
    $harga2 = $_POST["harga2"];
    $spesifikasi = $_POST["spesifikasi"];

    // Inisialisasi pesan untuk informasi hasil operasi
    $pesan = "";

    // Jika ada file fotoproduk diunggah, proses upload
    if ($_FILES['fotoproduk']['size'] > 0) {
        $fotoproduk = $targetDir . uniqid() . '_' . basename($_FILES['fotoproduk']['name']);
        if (!move_uploaded_file($_FILES['fotoproduk']['tmp_name'], $fotoproduk)) {
            $pesan = "Maaf, terjadi kesalahan saat mengunggah file 1.";
        }
    } else {
        $fotoproduk = "";
    }

    // Jika ada file fotoproduk2 diunggah, proses upload
    if ($_FILES['fotoproduk2']['size'] > 0) {
        $fotoproduk2 = $targetDir . uniqid() . '_' . basename($_FILES['fotoproduk2']['name']);
        if (!move_uploaded_file($_FILES['fotoproduk2']['tmp_name'], $fotoproduk2)) {
            $pesan = "Maaf, terjadi kesalahan saat mengunggah file 2.";
        }
    } else {
        $fotoproduk2 = "";
    }

    // Eksekusi statement untuk produk supplier
    if ($stmt_produk->execute()) {
        $produk_id = $stmt_produk->insert_id; 

        // Jika produk berhasil dimasukkan, masukkan data kelompok supplier jika ada
        $sql_kelompok = "INSERT INTO kelompoksupplier (kelompokproduk, jumlah, tanggalcek, keterangan, kodeproduk, kodesupplier) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_kelompok = $conn->prepare($sql_kelompok);

        if ($stmt_kelompok) {
            if (isset($_POST['kelompokproduk']) && is_array($_POST['kelompokproduk']) &&
                isset($_POST['jumlahproduk']) && is_array($_POST['jumlahproduk']) &&
                isset($_POST['tanggalcek']) && is_array($_POST['tanggalcek']) &&
                isset($_POST['keterangan']) && is_array($_POST['keterangan'])) {

                $count = count($_POST['kelompokproduk']);

                // Loop through each set of data and execute statement for kelompok table
                for ($i = 0; $i < $count; $i++) {
                    $kelompokproduk = $_POST['kelompokproduk'][$i];
                    $jumlahproduk = $_POST['jumlahproduk'][$i];
                    $tanggalcek = $_POST['tanggalcek'][$i];
                    $keterangan = $_POST['keterangan'][$i];

                    // Binding parameter untuk statement kelompok
                    $stmt_kelompok->bind_param("sssss", $kelompokproduk, $jumlahproduk, $tanggalcek, $keterangan, $kodeproduk, $kodesupplier);

                    // Eksekusi statement untuk kelompok table
                    if ($stmt_kelompok->execute()) {
                        $pesan = "Sukses! Data produk dan kelompok telah berhasil dimasukkan ke database.";
                    } else {
                        $pesan = "Error: " . $stmt_kelompok->error;
                        break; // Hentikan loop jika terjadi kesalahan
                    }
                }
            }
        } else {
            $pesan = "Error: " . $conn->error;
        }
    } else {
        $pesan = "Error: " . $stmt_produk->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Input Produk Supplier</title>
</head>
<body>
    <h2>Form Input Produk Supplier</h2>
    <?php if (!empty($pesan)) echo "<p>$pesan</p>"; ?>
    <form method="post" enctype="multipart/form-data">
        <label for="kodeproduk">Kode Produk:</label><br>
        <input type="text" id="kodeproduk" name="kodeproduk" required><br><br>

        <label for="namaproduk">Nama Produk:</label><br>
        <input type="text" id="namaproduk" name="namaproduk" required><br><br>

        <label for="satuan">Satuan:</label><br>
        <input type="text" id="satuan" name="satuan" required><br><br>

        <label for="tanggal">Tanggal:</label><br>
        <input type="date" id="tanggal" name="tanggal" required><br><br>

        <label for="jumlah">Jumlah:</label><br>
        <input type="text" id="jumlah" name="jumlah" required><br><br>

        <label for="harga">Harga:</label><br>
        <input type="text" id="harga" name="harga" required><br><br>

        <label for="tanggal2">Tanggal 2:</label><br>
        <input type="date" id="tanggal2" name="tanggal2" required><br><br>

        <label for="jumlah2">Jumlah 2:</label><br>
        <input type="text" id="jumlah2" name="jumlah2" required><br><br>

        <label for="harga2">Harga 2:</label><br>
        <input type="text" id="harga2" name="harga2" required><br><br>

        <label for="spesifikasi">Spesifikasi Produk:</label><br>
        <textarea id="spesifikasi" name="spesifikasi" rows="4" required></textarea><br><br>

        <label for="fotoproduk">Foto Produk 1:</label><br>
        <input type="file" id="fotoproduk" name="fotoproduk"><br><br>

        <label for="fotoproduk2">Foto Produk 2:</label><br>
        <input type="file" id="fotoproduk2" name="fotoproduk2"><br><br>

        <!-- Input untuk kelompok produk -->
        <h3>Data Kelompok Produk</h3>
        <div id="kelompokproduk">
            <div class="item">
                <label for="kelompokproduk">Kelompok Produk:</label>
                <input type="text" name="kelompokproduk[]" required>
                <label for="jumlahproduk">Jumlah:</label>
                <input type="text" name="jumlahproduk[]" required>
                <label for="tanggalcek">Tanggal Cek:</label>
                <input type="date" name="tanggalcek[]" required>
                <label for="keterangan">Keterangan:</label>
                <input type="text" name="keterangan[]" required>
            </div>
        </div>
        <button type="button" onclick="tambahKelompok()">Tambah Data Kelompok</button><br><br>

        <input type="submit" value="Submit">
    </form>

    <script>
        // JavaScript untuk menambahkan input baru untuk kelompok produk
        function tambahKelompok() {
            var div = document.createElement('div');
            div.innerHTML = `
                <label for="kelompokproduk">Kelompok Produk:</label>
                <input type="text" name="kelompokproduk[]" required>
                <label for="jumlahproduk">Jumlah:</label>
                <input type="text" name="jumlahproduk[]" required>
                <label for="tanggalcek">Tanggal Cek:</label>
                <input type="date" name="tanggalcek[]" required>
                <label for="keterangan">Keterangan:</label>
                <input type="text" name="keterangan[]" required><br><br>
            `;
            document.getElementById('kelompokproduk').appendChild(div);
        }
    </script>
</body>
</html>
