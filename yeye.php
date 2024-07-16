<?php
// Include your database connection
include 'config.php'; // Make sure this file has your database connection details
session_start();

// Redirect to login page if not authenticated
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
$kodesupplier = isset($_GET['kodesupplier']) ? $_GET['kodesupplier'] : "Nilai Default";
// Initialize message variable
$pesan = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDir = "produk/";

    // Prepare SQL statement for inserting into produksupplier table
    $sql_produk = "INSERT INTO produksupplier (kodeproduk, namaproduk, satuan, tanggal, jumlah, harga, spesifikasi, fotoproduk, fotoproduk2, kodesupplier) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_produk = $conn->prepare($sql_produk);

    if ($stmt_produk) {
        // Bind parameters
        $stmt_produk->bind_param("ssssssssss", $kodeproduk, $namaproduk, $satuan, $tanggal, $jumlah, $harga, $spesifikasi, $fotoproduk, $fotoproduk2, $kodesupplier);

        // Assign values from POST data
        $kodeproduk = $_POST["kodeproduk"];
        $namaproduk = $_POST["namaproduk"];
        $satuan = $_POST["satuan"];
        $tanggal = $_POST["tanggal"];
        $jumlah = $_POST["jumlah"];
        $harga = $_POST["harga"];
        $spesifikasi = $_POST["spesifikasi"];

        // Handle file uploads for fotoproduk
        if (isset($_FILES['fotoproduk']) && $_FILES['fotoproduk']['size'] > 0) {
            $fotoproduk = $targetDir . uniqid() . '_' . basename($_FILES['fotoproduk']['name']);
            if (!move_uploaded_file($_FILES['fotoproduk']['tmp_name'], $fotoproduk)) {
                $pesan = "Maaf, terjadi kesalahan saat mengunggah file 1.";
            }
        }

        // Handle file uploads for fotoproduk2
        if (isset($_FILES['fotoproduk2']) && $_FILES['fotoproduk2']['size'] > 0) {
            $fotoproduk2 = $targetDir . uniqid() . '_' . basename($_FILES['fotoproduk2']['name']);
            if (!move_uploaded_file($_FILES['fotoproduk2']['tmp_name'], $fotoproduk2)) {
                $pesan = "Maaf, terjadi kesalahan saat mengunggah file 2.";
            }
        }

        // Set kodesupplier from session
        $kodesupplier = $_SESSION['kodesupplier'];

        // Execute the statement for produksupplier table
        if ($stmt_produk->execute()) {
            $produk_id = $stmt_produk->insert_id;
            $pesan = "Sukses! Data produk telah berhasil dimasukkan ke database.";

            // Proceed with inserting into kelompoksupplier table
            $sql_kelompok = "INSERT INTO kelompoksupplier (kelompokproduk, jumlah, tanggalcek, keterangan, kodeproduk, kodesupplier) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_kelompok = $conn->prepare($sql_kelompok);

            if ($stmt_kelompok) {
                if (isset($_POST['kelompokproduk']) && is_array($_POST['kelompokproduk']) &&
                    isset($_POST['jumlahproduk']) && is_array($_POST['jumlahproduk']) &&
                    isset($_POST['tanggalcek']) && is_array($_POST['tanggalcek']) &&
                    isset($_POST['keterangan']) && is_array($_POST['keterangan'])) {

                    $count = count($_POST['kelompokproduk']);

                    // Loop through each set of data and bind parameters for kelompoksupplier table
                    for ($i = 0; $i < $count; $i++) {
                        $kelompokproduk = $_POST['kelompokproduk'][$i];
                        $jumlahproduk = $_POST['jumlahproduk'][$i];
                        $tanggalcek = $_POST['tanggalcek'][$i];
                        $keterangan = $_POST['keterangan'][$i];

                        // Bind parameters for kelompoksupplier table
                        $stmt_kelompok->bind_param("sssss", $kelompokproduk, $jumlahproduk, $tanggalcek, $keterangan, $kodeproduk, $kodesupplier);

                        // Execute the statement for kelompoksupplier table
                        if ($stmt_kelompok->execute()) {
                            $pesan = "Sukses! Data produk dan kelompok telah berhasil dimasukkan ke database.";
                        } else {
                            $pesan = "Error: " . $stmt_kelompok->error;
                            break;
                        }
                    }
                } else {
                    $pesan = "Error: Data kelompok tidak lengkap atau tidak valid.";
                }
            } else {
                $pesan = "Error: Gagal menyiapkan statement untuk kelompok. " . $conn->error;
            }
        } else {
            $pesan = "Error: Gagal mengeksekusi statement untuk produk. " . $stmt_produk->error;
        }
    } else {
        $pesan = "Error: Gagal menyiapkan statement untuk produk. " . $conn->error;
    }
} else {
    $pesan = "Error: Metode permintaan tidak valid.";
}

// Output message to the user
echo $pesan;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Pelanggan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Tambah Produk Pelanggan
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="kodeproduk">Kode Produk</label>
                                <input type="text" class="form-control" id="kodeproduk" name="kodeproduk" required>
                            </div>
                            <div class="form-group">
                                <label for="namaproduk">Nama Barang</label>
                                <input type="text" class="form-control" id="namaproduk" name="namaproduk" required>
                            </div>
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" class="form-control" id="satuan" name="satuan" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga" required>
                            </div>
                            <div class="form-group">
                                <label for="spesifikasi">Spesifikasi Produk</label>
                                <input type="text" class="form-control" id="spesifikasi" name="spesifikasi" required>
                            </div>
                            <div class="form-group">
                                <label for="fotoproduk">Foto Produk 1</label>
                                <input type="file" class="form-control-file" id="fotoproduk" name="fotoproduk">
                            </div>
                            <div class="form-group">
                                <label for="fotoproduk2">Foto Produk 2</label>
                                <input type="file" class="form-control-file" id="fotoproduk2" name="fotoproduk2">
                            </div>

                            <!-- Dynamic input fields for kelompokproduk -->
                            <div id="dynamic_field">
                                <div class="form-group">
                                    <label for="kelompokproduk">Kelompok Produk</label>
                                    <input type="text" class="form-control" id="kelompokproduk" name="kelompokproduk[]" required>
                                </div>
                                <div class="form-group">
                                    <label for="jumlahproduk">Jumlah Produk</label>
                                    <input type="text" class="form-control" id="jumlahproduk" name="jumlahproduk[]" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggalcek">Tanggal Cek</label>
                                    <input type="date" class="form-control" id="tanggalcek" name="tanggalcek[]" required>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan[]" rows="3"></textarea>
                                </div>
                            </div>
                            <button type="button" name="add" id="add" class="btn btn-success">Tambah</button>

                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        // Script for adding and removing dynamic input fields
        $(document).ready(function() {
            var i = 1;
            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<div id="row' + i + '">' +
                    '<div class="form-group">' +
                    '<label for="kelompokproduk">Kelompok Produk</label>' +
                    '<input type="text" class="form-control" id="kelompokproduk" name="kelompokproduk[]" required>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="jumlahproduk">Jumlah Produk</label>' +
                    '<input type="text" class="form-control" id="jumlahproduk" name="jumlahproduk[]" required>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="tanggalcek">Tanggal Cek</label>' +
                    '<input type="date" class="form-control" id="tanggalcek" name="tanggalcek[]" required>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="keterangan">Keterangan</label>' +
                    '<textarea class="form-control" id="keterangan" name="keterangan[]" rows="3"></textarea>' +
                    '</div>' +
                    '<button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Hapus</button>' +
                    '</div>');
            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
        });
    </script>
</body>

</html>
