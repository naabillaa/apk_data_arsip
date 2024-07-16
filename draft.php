<?php
// Include your database connection details
include 'config.php';
session_start();

// Redirect to login page if user is not authenticated
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Ambil kodesupplier dari parameter GET
if (isset($_GET['kodesupplier'])) {
    $kodesupplier = $_GET['kodesupplier'];
} else {
    $pesan = "Parameter kodesupplier tidak ditemukan.";
}

// Initialize message variable
$pesan = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDir = "produk/";

    // Prepare SQL statement for inserting into produksupplier table
    $sql_produk = "INSERT INTO produksupplier (kodeproduk, namaproduk, satuan, tanggal, jumlah, harga, tanggal2, jumlah2, harga2, tanggal3, jumlah3, harga3, spesifikasi, fotoproduk, fotoproduk2, kodesupplier) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_produk = $conn->prepare($sql_produk);

    if ($stmt_produk) {
        // Bind parameters to the prepared statement
        $stmt_produk->bind_param("ssssssssssssssss", $kodeproduk, $namaproduk, $satuan, $tanggal, $jumlah, $harga, $tanggal2, $jumlah2, $harga2, $tanggal3, $jumlah3, $harga3, $spesifikasi, $fotoproduk, $fotoproduk2, $kodesupplier);

        // Assign values from POST data
        $kodeproduk = $_POST["kodeproduk"];
        $namaproduk = $_POST["namaproduk"];
        $satuan = $_POST["satuan"];
        $tanggal = $_POST["tanggal"];
        $jumlah = $_POST["jumlah"];
        $harga = $_POST["harga"];
        $tanggal2 = $_POST["tanggal2"];
        $jumlah2 = $_POST["jumlah2"];
        $harga2 = $_POST["harga2"];
        $tanggal3 = $_POST["tanggal3"];
        $jumlah3 = $_POST["jumlah3"];
        $harga3 = $_POST["harga3"];
        $spesifikasi = $_POST["spesifikasi"];

        // Handle file uploads for fotoproduk and fotoproduk2
        $fotoproduk = uploadFile('fotoproduk', $targetDir);
        $fotoproduk2 = uploadFile('fotoproduk2', $targetDir);

        // Execute the prepared statement for produksupplier table
        if ($stmt_produk->execute()) {
            $produk_id = $stmt_produk->insert_id;

            // Prepare SQL statement for inserting into kelompok table
            $sql_kelompok = "INSERT INTO kelompok (kelompokproduk, jumlah, tanggalcek, keterangan, kodeproduk, kodesupplier) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_kelompok = $conn->prepare($sql_kelompok);

            if ($stmt_kelompok) {
                // Check if the POST arrays are set and are arrays
                if (isset($_POST['kelompokproduk']) && is_array($_POST['kelompokproduk']) &&
                    isset($_POST['jumlahproduk']) && is_array($_POST['jumlahproduk']) &&
                    isset($_POST['tanggalcek']) && is_array($_POST['tanggalcek']) &&
                    isset($_POST['keterangan']) && is_array($_POST['keterangan'])) {

                    $count = count($_POST['kelompokproduk']);

                    // Loop through each set of data and bind parameters for kelompok table
                    for ($i = 0; $i < $count; $i++) {
                        $kelompokproduk = $_POST['kelompokproduk'][$i];
                        $jumlahproduk = $_POST['jumlahproduk'][$i];
                        $tanggalcek = $_POST['tanggalcek'][$i];
                        $keterangan = $_POST['keterangan'][$i];

                        // Bind parameters to the prepared statement
                        $stmt_kelompok->bind_param("sssss", $kelompokproduk, $jumlahproduk, $tanggalcek, $keterangan, $kodeproduk, $kodesupplier);

                        // Execute the statement for kelompok table
                        if (!$stmt_kelompok->execute()) {
                            $pesan = "Error: " . $stmt_kelompok->error;
                            break; // Exit the loop on error
                        }
                    }
                }
            } else {
                $pesan = "Error: " . $conn->error;
            }

            if (empty($pesan)) {
                $pesan = "Sukses! Data produk dan kelompok telah berhasil dimasukkan ke database.";
            }
        } else {
            $pesan = "Error: " . $stmt_produk->error;
        }
    } else {
        $pesan = "Error: " . $conn->error;
    }
}

// Function to handle file upload
function uploadFile($fileInputName, $targetDir)
{
    $targetFile = $targetDir . uniqid() . '_' . basename($_FILES[$fileInputName]['name']);
    if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $targetFile)) {
        return $targetFile;
    } else {
        global $pesan;
        $pesan = "Maaf, terjadi kesalahan saat mengunggah file.";
        return "";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Pelanggan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Tambah Produk Pelanggan</h3>
                    </div>
                    <div class="card-body">
                    <?php if (!empty($pesan)) : ?>
                            <div class="mt-3 alert alert-<?php echo (strpos($pesan, 'Sukses') !== false) ? 'success' : 'danger'; ?>" role="alert">
                                <?php echo $pesan; ?>
                            </div>
                        <?php endif; ?>
                        <form action="" enctype="multipart/form-data" method="POST">
                            <div class="form-group">
                                <label for="kodeproduk">Kode Produk</label>
                                <input type="text" name="kodeproduk" id="kodeproduk" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="namaproduk">Nama Barang</label>
                                <input type="text" name="namaproduk" id="namaproduk" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" name="satuan" id="satuan" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Histori pesanan 1</label>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="date" class="form-control" name="tanggal" placeholder="Tanggal" required>
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" name="jumlah" placeholder="Jumlah" required>
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" name="harga" placeholder="Harga" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Histori pesanan 2</label>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="date" class="form-control" name="tanggal2" placeholder="Tanggal" required>
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" name="jumlah2" placeholder="Jumlah" required>
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" name="harga2" placeholder="Harga" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Histori pesanan 3</label>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="date" class="form-control" name="tanggal3" placeholder="Tanggal" required>
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" name="jumlah3" placeholder="Jumlah" required>
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" name="harga3" placeholder="Harga" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="spesifikasi">Spesifikasi</label>
                                <textarea class="form-control" name="spesifikasi" id="spesifikasi" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="fotoproduk">Upload Foto Produk</label>
                                <input type="file" class="form-control-file" name="fotoproduk" id="fotoproduk">
                            </div>
                            <div class="form-group">
                                <label for="fotoproduk2">Upload Foto Produk 2</label>
                                <input type="file" class="form-control-file" name="fotoproduk2" id="fotoproduk2">
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                            <a href="tampilan.php" class="btn btn-secondary">Batal</a>
                        </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and SweetAlert JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Script to handle SweetAlert for message display -->
    <script>
        $(document).ready(function () {
            // Display sweet alert if message is not empty
            <?php if (!empty($pesan)) : ?>
                swal({
                    title: "<?php echo (strpos($pesan, 'Sukses') !== false) ? 'Sukses!' : 'Error!'; ?>",
                    text: "<?php echo $pesan; ?>",
                    icon: "<?php echo (strpos($pesan, 'Sukses') !== false) ? 'success' : 'error'; ?>",
                    button: "OK",
                });
            <?php endif; ?>
        });
    </script>
</body>

</html>
