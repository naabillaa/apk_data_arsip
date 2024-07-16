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

<!-- Mirrored from demos.creative-tim.com/argon-dashboard-bs4/examples/tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Feb 2024 07:37:01 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
<meta name="author" content="Creative Tim">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- Pastikan Anda sudah memasukkan jQuery dan Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<title>Argon Dashboard - Free Dashboard for Bootstrap 4</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="canonical" href="https://www.creative-tim.com/product/argon-dashboard" />

<meta name="keywords" content="dashboard, bootstrap 4 dashboard, bootstrap 4 design, bootstrap 4 system, bootstrap 4, bootstrap 4 uit kit, bootstrap 4 kit, argon, argon ui kit, creative tim, html kit, html css template, web template, bootstrap, bootstrap 4, css3 template, frontend, responsive bootstrap template, bootstrap ui kit, responsive ui kit, argon dashboard">
<meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">

<meta itemprop="name" content="Argon - Free Dashboard for Bootstrap 4 by Creative Tim">
<meta itemprop="description" content="Start your development with a Dashboard for Bootstrap 4.">
<meta itemprop="image" content="../../../s3.amazonaws.com/creativetim_bucket/products/96/original/opt_ad_thumbnail.jpg">

<meta name="twitter:card" content="product">
<meta name="twitter:site" content="@creativetim">
<meta name="twitter:title" content="Argon - Free Dashboard for Bootstrap 4 by Creative Tim">
<meta name="twitter:description" content="Start your development with a Dashboard for Bootstrap 4.">
<meta name="twitter:creator" content="@creativetim">
<meta name="twitter:image" content="../../../s3.amazonaws.com/creativetim_bucket/products/96/original/opt_ad_thumbnail.jpg">

<meta property="fb:app_id" content="655968634437471">
<meta property="og:title" content="Argon - Free Dashboard for Bootstrap 4 by Creative Tim" />
<meta property="og:type" content="article" />
<meta property="og:url" content="https://demos.creative-tim.com/argon-dashboard/index.html" />
<meta property="og:image" content="../../../s3.amazonaws.com/creativetim_bucket/products/96/original/opt_ad_thumbnail.jpg" />
<meta property="og:description" content="Start your development with a Dashboard for Bootstrap 4." />
<meta property="og:site_name" content="Creative Tim" />

<link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">

<link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
<link rel="stylesheet" href="../assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css" type="text/css">

<link rel="stylesheet" href="../assets/css/argon.min5438.css?v=1.2.0" type="text/css">

<script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        '../../../www.googletagmanager.com/gtm5445.html?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-NKDMSK6');
  </script>
<!-- di dalam <head> atau sebelum tag penutup </body> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Fungsi untuk menampilkan SweetAlert konfirmasi penghapusan
    function confirmDelete(namaProduk) {
        // Tampilkan SweetAlert konfirmasi
        Swal.fire({
            title: 'Yakin ingin menghapus pelanggan?',
            text: "Tindakan ini tidak dapat dibatalkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            // Jika pengguna menekan tombol "Ya, hapus!", lanjutkan dengan penghapusan
            if (result.isConfirmed) {
                // Redirect ke halaman hapuspelanggan.php dengan menyertakan parameter kodePelanggan
                window.location.href = 'deleteprodukpelamggan.php?kodepelanggan=' + namaProduk;
            }
        });
    }
</script>
<style>

.btn-wh {
        background-color: white; /* Warna latar belakang awal */
        /* border-color: #ced4da; Warna border */
        color: #495057; /* Warna teks */
    }

    .btn-wh:hover {
        color: #ffffff; /* Warna teks */

        background-color: #7caaff; /* Warna latar belakang saat hover */
    }
</style>
</script>
</head>
<body>

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>


<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
<div class="scrollbar-inner">

<div class="sidenav-header  align-items-center">
<a class="navbar-brand" href="javascript:void(0)">
<span style="font-weight: bold; font-size: 30px; color: #5e72e4;">Felice Area</span>
</a>
</div>
<div class="navbar-inner">

<div class="collapse navbar-collapse" id="sidenav-collapse-main">

<ul class="navbar-nav">
<li class="nav-item">
<a class="nav-link" href="index.php">
<i class="ni ni-tv-2 text-primary"></i>
<span class="nav-link-text">Dashboard</span>
</a>
</li>

 
  
<li class="nav-item">
  <a class="nav-link " href="produk.php">
  <i class="ni ni-bullet-list-67 text-default"></i>
  <span class="nav-link-text">Data Pelanggan</span>
  </a>
  </li>
  <li class="nav-item">
  <a class="nav-link active
" href="supplier.php">
  <i class="ni ni-bullet-list-67 text-default"></i>
  <span class="nav-link-text">Data Supplier</span>
  </a>
  </li>
  <!-- <li class="nav-item">
      <a class="nav-link" href="detaill.php">
      <i class="ni ni-bullet-list-67 text-default"></i>
      <span class="nav-link-text">Data Detail Penjualan</span>
      </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="datapenjualan.php">
          <i class="ni ni-bullet-list-67 text-default"></i>
          <span class="nav-link-text">Data Penjualan</span>
          </a>
          </li> -->
      <br>

  

</ul>
</div>
</div>
</div>
</nav>

<div class="main-content" id="panel">

<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
<div class="container-fluid">
<div class="collapse navbar-collapse" id="navbarSupportedContent">

<form method="post" class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
<div class="form-group mb-0">
<div class="input-group input-group-alternative input-group-merge">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fas fa-search"></i></span>
</div>
<input class="form-control"  type="text" name="search" placeholder="Cari disini" value="<?php if(isset($search)){echo $search;} ?>">
<button type="submit" name="submit" value="Search"class="btn btn-light-inline mr-sm-3"></button>
</div>
</div>
<!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg> -->
<!-- <button type="submit" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
<span aria-hidden="true">×</span> -->
</button>
</form>

<ul class="navbar-nav align-items-center  ml-md-auto ">
<li class="nav-item d-xl-none">

<div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
<div class="sidenav-toggler-inner">
<i class="sidenav-toggler-line"></i>
<i class="sidenav-toggler-line"></i>
<i class="sidenav-toggler-line"></i>
</div>
</div>
</li>
</ul>
<form action="logout.php" method="POST" class="login-email">
            <div class="input-group">
                <button type="submit" class="btn btn-danger">
                  <i class="fa fa-power-off" style="font-size:20px;color:white"></i></button>
            </div>        
          </form>
</div>
</div>
</nav>


<div class="header bg-primary pb-6">
<div class="container-fluid">
<div class="header-body">
<div class="row align-items-center py-4">
<div class="col-lg-6 col-7">
<h6 class="h2 text-white d-inline-block mb-0">Tables</h6>
<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
<ol class="breadcrumb breadcrumb-links breadcrumb-dark">
<li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="supplier.php">Data Pelanggan</a></li>
<li class="breadcrumb-item active" aria-current="page">Data Produk Pelanggan</li>
</ol>
</nav>
</div>

<div class="col-lg-6 col-5 text-right">
<form method="post" action="">
<a href="dataproduksupplier.php?kodesupplier=<?php echo $data['kodesupplier']; ?>" class="btn btn-sm btn-neutral" id="printButton"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
  <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
  <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
</svg></a>
<script>
    // Fungsi untuk memicu perintah pencetakan saat tombol "Print" diklik
    document.getElementById("printButton").addEventListener("click", function() {
        window.print(); // Memicu perintah pencetakan pada browser
        return false; // Mencegah tautan standar untuk diikuti
    });
</script>
<a class="btn btn-sm btn-neutral" href="produkpelanggan.php?kodepelanggan=<?php echo $kodepelanggan; ?>">+ Data Produk</a>

 <input type="submit" class="btn btn-sm btn-neutral" name="show_all" value="Tampilkan Semua">
</form>

</div>
</div>
</div>
</div>
</div>


    <!-- Navbar and other HTML structure -->
    <!-- Navbar code here -->
    <div class="container-fluid mt--6"> 
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Data Produk <?php echo $kodepelanggan; ?></h3>
                    </div>
  
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th  scope="col">No</th>
                                        <th  scope="col">Kode Produk</th>
                                        <th  scope="col">Nama Produk</th>
                                        <th  scope="col">Spesifikasi Produk</th>
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
                                                    <button class="btn btn-wh dropdown-toggle" type="button"
                                                            id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                                            <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                                            </svg>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="#detailPelangganModal<?php echo $row_produk['kodeproduk']; ?>"
                                                           data-toggle="modal">Detail Produk</a>
                                                        <a class="dropdown-item" href="editprodukk.php?namaproduk=<?php echo $row_produk['namaproduk']; ?>">Edit</a>
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
                                                            <div class="table-responsive">
                                                            <table class="table">
                                                          
                        <tr>
                            <td>Nama Produk:</td>
                            <td><?php echo $row_produk['namaproduk']; ?></td>
                        </tr>
                        <tr>
                          
                            <td>Satuan:</td>
                            <td><?php echo $row_produk['satuan']; ?></td>
                        </tr>
                        <tr>
                     
                            <td>Tanggal:</td>
                            <td><?php echo $row_produk['tanggal']; ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah:</td>
                            <td><?php echo $row_produk['jumlah']; ?></td>
                        </tr>
                        <tr>
                        <td>Harga:</td>
                            <td><?php echo $row_produk['harga']; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal 2:</td>
                            <td><?php echo $row_produk['tanggal2']; ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah 2:</td>
                            <td><?php echo $row_produk['jumlah2']; ?></td>
                        </tr>
                        <tr>
                            <td>Harga 2:</td>
                            <td><?php echo $row_produk['harga2']; ?></td>
                        </tr>
                           
                        <tr>
                            <td>Tanggal Update:</td>
                            <td><?php echo $row_produk['tanggalupdate']; ?></td>
                        </tr>
                        <tr>
                        <td>Foto produk:</td>
                            <?php 
                                // Assuming $data['fotoproduk'] contains the filename or path to the image
                                $foto_produk = $row_produk['fotoproduk'];
                                echo '<img src="' . $foto_produk . '" alt="Foto Produk" style="max-width: 200px; max-height: 200px;">'; 
                                ?>
                            <td><a href="previewpsupplier.php?fotoproduk=<?php echo urlencode($row_produk['fotoproduk']); ?>" target="_blank">Pratinjau</a></td>
                        </tr>
                        <tr>
                            <td>Foto Produk 2:</td>
                            <?php 
                                // Assuming $row_produk['fotoproduk'] contains the filename or path to the image
                                $foto_produk = $row_produk['fotoproduk2'];
                                echo '<img src="' . $foto_produk . '" alt="Foto Produk" style="max-width: 200px; max-height: 200px;">'; 
                                ?>
                            <td><a href="previewpsupplier.php?fotoproduk=<?php echo urlencode($row_produk['fotoproduk2']); ?>" target="_blank">Pratinjau</a></td>
                        </tr>
                                                                </table>
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
                                                                <button type="button" class="btn btn-danger"
                                                                        data-dismiss="modal">Tutup
                                                                </button>
                                                            </div>
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
