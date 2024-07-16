<?php
// Include file konfigurasi database dan mulai sesi
include 'config.php';
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit(); // Hentikan eksekusi skrip setelah pengalihan
}

// Periksa apakah formulir telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Tangkap nilai-nilai dari formulir
    $kodepelanggan = $_POST["kodepelanggan"];
    $namaperusahaan = $_POST["namaperusahaan"];
    $klasifikasi = $_POST["klasifikasi"];
    $alamatperusahaan = $_POST["alamatperusahaan"];
    $alamatpengiriman = $_POST["alamatpengiriman"];
    $kontakperson = $_POST["kontakperson"];
    $email = $_POST["email"];
    $website = $_POST["website"];
    $npwp = $_POST["npwp"];
    $sales = $_POST["sales"];
    $catatan = $_POST["catatan"];
    $tanggalupdate = $_POST["tanggalupdate"];

    // Persiapkan array untuk data file proposal
    $proposal_names = $_FILES['proposal']['name'];
    $proposal_tmp_names = $_FILES['proposal']['tmp_name'];

    // Loop melalui data yang dikirimkan dan masukkan ke dalam database
    for ($i = 0; $i < count($alamatperusahaan); $i++) {
        // Tangkap nilai dari masing-masing array
        $alamatperusahaan_val = $alamatperusahaan[$i];
        $alamatpengiriman_val = $alamatpengiriman[$i];
        $kontakperson_val = $kontakperson[$i];
        $proposal_name = $proposal_names[$i];
        $proposal_tmp_name = $proposal_tmp_names[$i];

        // Lakukan operasi database di sini
        $sql = "INSERT INTO pelanggan (kodepelanggan, namaperusahaan, klasifikasi, alamatperusahaan, alamatpengiriman, kontakperson, email, website, npwp, proposal, sales, catatan, tanggalupdate) 
                VALUES ('$kodepelanggan', '$namaperusahaan', '$klasifikasi', '$alamatperusahaan_val', '$alamatpengiriman_val', '$kontakperson_val', '$email', '$website', '$npwp', '$proposal_name', '$sales', '$catatan', '$tanggalupdate')";

        if ($conn->query($sql) === TRUE) {
            // Jika insert berhasil, lakukan pengelolaan file proposal
            $targetDir = "proposal/"; // Direktori penyimpanan file proposal
            $targetFilePath = $targetDir . basename($proposal_name);
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            // Cek apakah file adalah file gambar
            $allowTypes = array('pdf', 'doc', 'docx');
            if (in_array(strtolower($fileType), $allowTypes)) {
                // Pindahkan file ke direktori penyimpanan
                if (move_uploaded_file($proposal_tmp_name, $targetFilePath)) {
                    echo "File proposal berhasil diunggah.";
                } else {
                    echo "Maaf, terjadi kesalahan saat mengunggah file proposal.";
                }
            } else {
                echo "File proposal harus dalam format PDF, DOC, atau DOCX.";
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    header("Location: produk.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pelanggan</title>
</head>
<body>
    <h2>Formulir Pelanggan</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <!-- Field-formulir untuk data pelanggan -->
        <label>Kode Pelanggan:</label>
        <input type="text" name="kodepelanggan" required><br><br>

        <label>Nama Perusahaan:</label>
        <input type="text" name="namaperusahaan" required><br><br>

        <label>Klasifikasi:</label>
        <input type="text" name="klasifikasi" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Website:</label>
        <input type="text" name="website"><br><br>

        <label>NPWP:</label>
        <input type="text" name="npwp"><br><br>

        <!-- Field-formulir untuk data alamat perusahaan -->
        <h3>Alamat Perusahaan</h3>
        <div id="alamat_perusahaan">
            <div>
                <label>Alamat:</label>
                <input type="text" name="alamatperusahaan[]" required>
            </div>
            <div>
                <label>Alamat Pengiriman:</label>
                <input type="text" name="alamatpengiriman[]" required>
            </div>
            <div>
                <label>Kontak Person:</label>
                <input type="text" name="kontakperson[]" required>
            </div>
        </div>
        <button type="button" onclick="tambahAlamat()">Tambah Alamat</button><br><br>

        <!-- Field-formulir untuk file proposal -->
        <h3>Unggah Proposal</h3>
        <input type="file" name="proposal[]" accept=".pdf,.doc,.docx" multiple><br><br>

        <!-- Field-formulir untuk data tambahan -->
        <label>Sales:</label>
        <input type="text" name="sales"><br><br>

        <label>Catatan:</label>
        <textarea name="catatan" rows="4"></textarea><br><br>

        <label>Tanggal Update:</label>
        <input type="date" name="tanggalupdate"><br><br>

        <!-- Tombol untuk submit formulir -->
        <button type="submit">Submit</button>
    </form>

    <script>
        // Fungsi untuk menambahkan field alamat perusahaan baru
        function tambahAlamat() {
            var div = document.createElement('div');
            div.innerHTML = `
                <div>
                    <label>Alamat:</label>
                    <input type="text" name="alamatperusahaan[]" required>
                </div>
                <div>
                    <label>Alamat Pengiriman:</label>
                    <input type="text" name="alamatpengiriman[]" required>
                </div>
                <div>
                    <label>Kontak Person:</label>
                    <input type="text" name="kontakperson[]" required>
                </div>
            `;
            document.getElementById('alamat_perusahaan').appendChild(div);
        }
    </script>
</body>
</html>
