<?php
// Mulai session dan sertakan file konfigurasi
include 'config.php';
session_start();

// Redirect ke halaman login jika user belum login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ambil kode pelanggan dari parameter GET
if (isset($_GET['kodepelanggan'])) {
    $kodepelanggan = $_GET['kodepelanggan'];

    // Query untuk mengambil data produk berdasarkan kode pelanggan
    $query_produk = "SELECT kodeproduk, namaproduk, spesifikasiproduk, satuan, tanggal, jumlah, harga, tanggal2, jumlah2, harga2, tanggalupdate, fotoproduk, fotoproduk2 FROM produk WHERE kodepelanggan = '$kodepelanggan'";

    // Eksekusi query untuk mengambil produk
    $result_produk = mysqli_query($conn, $query_produk);

    if (!$result_produk) {
        die("ERROR: Gagal mengeksekusi query produk: " . mysqli_error($conn));
    }

    // Jika tidak ada produk ditemukan
    if (mysqli_num_rows($result_produk) == 0) {
        die("Tidak ada produk ditemukan untuk kode pelanggan '$kodepelanggan'");
    }

} else {
    // Redirect kembali ke halaman produk.php jika parameter kodepelanggan tidak ada
    header("Location: produk.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Include Bootstrap CSS and other meta tags -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Produk</title>
</head>

<body>

    <!-- Navbar and other HTML structure -->
    <!-- Navbar code here -->

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Data Produk <?php echo $kodepelanggan; ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Spesifikasi Produk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sn = 1;
                                    while ($row_produk = mysqli_fetch_assoc($result_produk)) {
                                        $kodeproduk = $row_produk['kodeproduk'];

                                        // Query untuk mengambil data kelompok berdasarkan kode produk
                                        $query_kelompok = "SELECT kelompokproduk, jumlah, tanggalcek, keterangan FROM kelompok WHERE kodeproduk = '$kodeproduk'";

                                        // Eksekusi query untuk mengambil kelompok
                                        $result_kelompok = mysqli_query($conn, $query_kelompok);

                                        if (!$result_kelompok) {
                                            die("ERROR: Gagal mengeksekusi query kelompok: " . mysqli_error($conn));
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td><?php echo $row_produk['kodeproduk']; ?></td>
                                            <td><?php echo $row_produk['namaproduk']; ?></td>
                                            <td><?php echo $row_produk['spesifikasiproduk']; ?></td>
                                            <td>
                                                <!-- Dropdown menu for actions -->
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                        Aksi
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="#detailPelangganModal<?php echo $row_produk['kodeproduk']; ?>"
                                                           data-toggle="modal">Detail Produk</a>
                                                        <a class="dropdown-item" href="editprodukk.php?kodeproduk=<?php echo $row_produk['kodeproduk']; ?>">Edit</a>
                                                        <a class="dropdown-item" href="#"
                                                           onclick="confirmDelete('<?php echo $row_produk['kodeproduk']; ?>')">Hapus</a>
                                                    </div>
                                                </div>
                                                <!-- Modal for Detail Produk -->
                                                <div class="modal fade" id="detailPelangganModal<?php echo $row_produk['kodeproduk']; ?>"
                                                     tabindex="-1" role="dialog" aria-labelledby="detailPelangganModalLabel"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="detailPelangganModalLabel">
                                                                    Detail Produk <?php echo $row_produk['kodeproduk']; ?></h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Kode Produk: <?php echo $row_produk['kodeproduk']; ?></p>
                                                                <p>Nama Produk: <?php echo $row_produk['namaproduk']; ?></p>
                                                                <p>Spesifikasi Produk: <?php echo $row_produk['spesifikasiproduk']; ?></p>
                                                                <p>Satuan: <?php echo $row_produk['satuan']; ?></p>
                                                                <p>Tanggal: <?php echo $row_produk['tanggal']; ?></p>
                                                                <p>Jumlah: <?php echo $row_produk['jumlah']; ?></p>
                                                                <p>Harga: <?php echo $row_produk['harga']; ?></p>
                                                                <p>Tanggal 2: <?php echo $row_produk['tanggal2']; ?></p>
                                                                <p>Jumlah 2: <?php echo $row_produk['jumlah2']; ?></p>
                                                                <p>Harga 2: <?php echo $row_produk['harga2']; ?></p>
                                                                <p>Tanggal Update: <?php echo $row_produk['tanggalupdate']; ?></p>
                                                                <p>
                                                                    Foto Produk 1: <br>
                                                                    <img src="<?php echo $row_produk['fotoproduk']; ?>"
                                                                         alt="Foto Produk" style="max-width: 200px;">
                                                                    <br>
                                                                    <a href="previewpsupplier.php?fotoproduk=<?php echo urlencode($row_produk['fotoproduk']); ?>"
                                                                       target="_blank">Pratinjau</a>
                                                                </p>
                                                                <p>
                                                                    Foto Produk 2: <br>
                                                                    <img src="<?php echo $row_produk['fotoproduk2']; ?>"
                                                                         alt="Foto Produk" style="max-width: 200px;">
                                                                    <br>
                                                                    <a href="previewpsupplier.php?fotoproduk=<?php echo urlencode($row_produk['fotoproduk2']); ?>"
                                                                       target="_blank">Pratinjau</a>
                                                                </p>
                                                                <!-- Table for Kelompok Produk -->
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Kelompok Produk</th>
                                                                        <th>Jumlah</th>
                                                                        <th>Tanggal Cek</th>
                                                                        <th>Keterangan</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php while ($row_kelompok = mysqli_fetch_assoc($result_kelompok)): ?>
                                                                        <tr>
                                                                            <td><?php echo $row_kelompok['kelompokproduk']; ?></td>
                                                                            <td><?php echo $row_kelompok['jumlah']; ?></td>
                                                                            <td><?php echo $row_kelompok['tanggalcek']; ?></td>
                                                                            <td><?php echo $row_kelompok['keterangan']; ?></td>
                                                                        </tr>
                                                                    <?php endwhile; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Tutup
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                        // Bebaskan memori dari hasil query kelompok
                                        mysqli_free_result($result_kelompok);
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Script for delete confirmation -->
    <script>
        function confirmDelete(kodeproduk) {
            if (confirm("Apakah Anda yakin ingin menghapus produk dengan kode " + kodeproduk + "?")) {
                window.location.href = "deleteprodukk.php?kodeproduk=" + kodeproduk;
            }
        }
    </script>

</body>

</html>
