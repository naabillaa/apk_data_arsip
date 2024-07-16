<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit(); // Menghentikan eksekusi skrip setelah pengalihan
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
<title>Argon Dashboard - Free Dashboard for Bootstrap 4</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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
<style><style>
    /* Style untuk tombol */
    .btn {
        padding: 8px 16px;
        border-radius: 4px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    /* Style untuk input */
    input[type="text"],
    input[type="number"],
    input[type="date"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom: 10px;
    }

    /* Style untuk tabel */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }
</style>
</style>

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
 
 
    function updateSubTotal() {
            var hargaProduk = document.getElementById("ProdukID").options[document.getElementById("ProdukID").selectedIndex].getAttribute('data-harga');
            var jumlahProduk = document.getElementById("JumlahProduk").value;
            var subTotal = hargaProduk * jumlahProduk;
            document.getElementById("SubTotal").value = subTotal;
        }
    function addProduct() {
        var produkID = document.getElementById("ProdukID").value;
        var produkNama = document.getElementById("ProdukID").options[document.getElementById("ProdukID").selectedIndex].text;
        var hargaProduk = document.getElementById("ProdukID").options[document.getElementById("ProdukID").selectedIndex].getAttribute('data-harga');
        var jumlahProduk = document.getElementById("JumlahProduk").value;
        var subTotal = hargaProduk * jumlahProduk;

        // Buat element baru untuk menampilkan produk yang ditambahkan
        var newItem = document.createElement("div");
        newItem.innerHTML = produkNama + " (ID: " + produkID + ") - Jumlah: " + jumlahProduk + " - Subtotal: " + subTotal;
        document.getElementById("produkList").appendChild(newItem);

        // Update total harga
        var totalHarga = parseFloat(document.getElementById("SubTotal").value) + subTotal;
        document.getElementById("SubTotal").value = totalHarga;
    }

 </script>

</head>
<body>

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>


<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
<div class="scrollbar-inner">

<div class="sidenav-header  align-items-center">
<a class="navbar-brand" href="javascript:void(0)">
<img src="../assets/img/brand/1.png" class="navbar-brand-img" style="max-width: 50px; max-height: 50px;"alt="...">
<span style="font-weight: bold; color: #5e72e4;">KasirKu</span>

</a>
</div>
<div class="navbar-inner">

<div class="collapse navbar-collapse" id="sidenav-collapse-main">

<ul class="navbar-nav">
  <li class="nav-item">
  <a class="nav-link " href="index.php ">
  <i class="ni ni-tv-2 text-primary"></i>
  <span class="nav-link-text">Dashboard</span>
  </a>
  </li>
  
  
  <li class="nav-item">
  <a class="nav-link" href="produk.php">
  <i class="ni ni-bullet-list-67 text-default"></i>
  <span class="nav-link-text">Data Produk</span>
  </a>
  </li>
  <li class="nav-item">
      <a class="nav-link active" href="detail.php">
      <i class="ni ni-bullet-list-67 text-default"></i>
      <span class="nav-link-text">Data Detail Penjualan</span>
      </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="datapenjualan.php">
          <i class="ni ni-bullet-list-67 text-default"></i>
          <span class="nav-link-text">Data Penjualan</span>
          </a>
          </li>
      <br>
          <li class="nav-item">
          <form action="logout.php" method="POST" class="login-email">
            <div class="form-group">
                <button type="submit" class="btn btn-danger">
                  <i class="fa fa-power-off" style="font-size:20px;color:white"></i></button>
            </div>        
          </form>

  
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
<li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="detail.php">Data Produk</a></li>
<li class="breadcrumb-item active" aria-current="page">Tambah Data Detail </li>
</ol>
</nav>
</div>
<div class="col-lg-6 col-5 text-right">
<form method="post" action="">
<a href="../../inproduk.php" class="btn btn-sm btn-neutral">+ Data Produk</a>

 <input type="submit" class="btn btn-sm btn-neutral" name="show_all" value="Tampilkan Semua">
</form>

</div>
</div>
</div>
</div>
</div>

<div class="container-fluid mt--6">
<div class="row">
<div class="col">
<div class="card">

<div class="card-header border-0">
<h3 class="mb-0">Tambah Detail Penjualan</h3>
</div>
<div class="main-content" id="panel">
        <!-- Include header section here -->

        <div class="container">
        <form action="" method="POST">
        <div class="form-group">

            <label for="PenjualanID">Penjualan ID:</label><br>
            <input type="text" id="PenjualanID" name="PenjualanID" required><br>
            </div>            
            <label for="DetailID">Detail ID:</label><br>
            <input type="text" id="DetailID" name="DetailID" required><br>
            
            <table border="1">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="detail_penjualan">
                    <!-- Baris detail penjualan akan ditambahkan secara dinamis menggunakan JavaScript -->
                </tbody>
            </table>
            
            <button type="button" class="btn btn-primary" onclick="tambahBaris()">Tambah Produk</button><br><br><br>
                
            <label for="TanggalPenjualan">Tanggal Penjualan:</label><br>
            <input type="date" id="TanggalPenjualan" name="TanggalPenjualan" required><br><br>
                
            <div class="form-group" style="display: flex;
        align-items: center;">
    <input type="submit" class="btn btn-success" value="Submit">
    <div style="text-align: center;">
        <button type="button" onclick="cancel()" class="btn btn-danger">Cancel</button>
    </div>
</div>

  </form>
    </div>

    <script>
    // Fungsi untuk mengambil data produk dari server menggunakan AJAX
    function getDataProduk(selectElement) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "get_produk.php", true); // Sesuaikan dengan nama file PHP yang digunakan untuk mengambil data produk
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText;
                selectElement.innerHTML = response;
            }
        };
        xhr.send();
    }

    function cancel() {
        window.location.href = "detail.php"; // Ganti dengan halaman tujuan untuk cancel
    }

    function tambahBaris() {
        var table = document.getElementById("detail_penjualan");
        var row = table.insertRow();
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        
        // Buat ID unik untuk elemen dropdown ProdukID
        var uniqueID = 'ProdukID_' + Math.random().toString(36).substr(2, 9);
        
        cell1.innerHTML = '<select id="' + uniqueID + '" name="ProdukID[]" required></select>'; // Kosongkan dulu dropdown
        cell2.innerHTML = '<input type="text" name="jumlah[]" onchange="hitungTotal()">'; // Ubah input menjadi text
        cell3.innerHTML = '<button type="button"  class="btn btn-danger" onclick="hapusBaris(this)">Hapus</button>';
        
        // Panggil fungsi untuk mengambil data produk setelah menambahkan baris baru
        var selectElement = document.getElementById(uniqueID);
        getDataProduk(selectElement);
    }

    function hapusBaris(button) {
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
        hitungTotal();
    }
    </script>


</body>
</html>

<?php
// Koneksi ke database
include "config.php";

// Tangkap data dari formulir jika ada
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $DetailID = $_POST['DetailID'];
    $PenjualanID = $_POST['PenjualanID'];
    $TanggalPenjualan = $_POST['TanggalPenjualan'];
    $JumlahProdukArray = $_POST['jumlah']; // Ubah menjadi array untuk menangkap jumlah produk
    $ProdukIDArray = $_POST['ProdukID']; // Ubah menjadi array untuk menangkap ID produk

    // Variabel untuk menyimpan total harga
    $totalHarga = 0;

    // Loop untuk setiap produk yang dibeli
    for ($i = 0; $i < count($ProdukIDArray); $i++) {
        // Ambil nilai dari form
        // Generate ID detail penjualan secara unik
        $ProdukID = $ProdukIDArray[$i];
        $JumlahProduk = $JumlahProdukArray[$i];

        // Ambil harga produk dari tabel produk
        $sql_harga_produk = "SELECT Harga, Stok FROM produk WHERE ProdukID = '$ProdukID'";
        $result_produk = $conn->query($sql_harga_produk);

        if ($result_produk->num_rows > 0) {
            $row_produk = $result_produk->fetch_assoc();
            $Harga = $row_produk['Harga'];
            $Stok = $row_produk['Stok'];

            // Cek apakah stok mencukupi
            if ($JumlahProduk <= $Stok) {
                // Kurangi stok
                $stokBaru = $Stok - $JumlahProduk;
                $sql_update_stok = "UPDATE produk SET Stok = '$stokBaru' WHERE ProdukID = '$ProdukID'";
                if ($conn->query($sql_update_stok) !== TRUE) {
                    echo "Error updating stok: " . $conn->error;
                }

                // Hitung subtotal
                $SubTotal = $JumlahProduk * $Harga;
                $totalHarga += $SubTotal;

                // Query untuk menyimpan data ke dalam tabel detail_penjualan
                $sql_detail_penjualan = "INSERT INTO detail_penjualan (DetailID, PenjualanID, ProdukID, JumlahProduk, SubTotal) VALUES ('$DetailID', '$PenjualanID', '$ProdukID', '$JumlahProduk', '$SubTotal')";

                if ($conn->query($sql_detail_penjualan) !== TRUE) {
                    echo "Error inserting detail penjualan: " . $conn->error;
                }
            } else {
                echo "Stok produk tidak mencukupi untuk produk dengan ID: " . $ProdukID;
            }
        } else {
            echo "Error fetching produk data: " . $conn->error;
        }
    }

    // Query untuk menyimpan data ke dalam tabel penjualan
    $sql_penjualan = "INSERT INTO penjualan (PenjualanID, TanggalPenjualan, TotalHarga) VALUES ('$PenjualanID', '$TanggalPenjualan', '$totalHarga')";

    if ($conn->query($sql_penjualan) === TRUE) {
      echo"<script>window.location='detaill.php';</script>";
       
        exit();
    } else {
        echo "Error inserting penjualan data: " . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?> 
                

                      

                        

                        <div class="card-footer py-4">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Include footer section here -->
        </div>
    </div>

    <!-- Include scripts here -->
    <script>
        let counter = 1;

        function tambahProduk() {
            const container = document.getElementById('kandidatContainer');

            const newProduk = document.createElement('div');
            newProduk.innerHTML = `
                <hr>
                <div class="form-group">
                    <label>Produk ID</label>
                    <input type="text" placeholder="Produk ID" name="ProdukID[]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Jumlah Produk</label>
                    <input type="number" placeholder="Jumlah Produk" name="JumlahProduk[]" class="form-control" required>
                </div>
            `;

            container.appendChild(newProduk);
            counter++;
        }
    </script>
</body>

</html>
      </div>


<div class="card-footer py-4">
</div>
</div>
</div>
</div>


<footer class="footer pt-0">
<div class="row align-items-center justify-content-lg-between">
<div class="col-lg-6">
<div class="copyright text-center  text-lg-left  text-muted">
&copy; 2020 <a href="https://www.creative-tim.com/" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
</div>
</div>
<div class="col-lg-6">
<ul class="nav nav-footer justify-content-center justify-content-lg-end">
<li class="nav-item">
<a href="https://www.creative-tim.com/" class="nav-link" target="_blank">Creative Tim</a>
</li>
<li class="nav-item">
<a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
</li>
<li class="nav-item">
<a href="http://blog.creative-tim.com/" class="nav-link" target="_blank">Blog</a>
</li>
<li class="nav-item">
<a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
</li>
</ul>
</div>
</div>
</footer>
</div>
</div>


<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/js-cookie/js.cookie.js"></script>
<script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>

<script src="../assets/js/argon.min5438.js?v=1.2.0"></script>
<script>
    // Facebook Pixel Code Don't Delete
    ! function(f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function() {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n;
      n.push = n;
      n.loaded = !0;
      n.version = '2.0';
      n.queue = [];
      t = b.createElement(e);
      t.async = !0;
      t.src = v;
      s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window,
      document, 'script', '../../../connect.facebook.net/en_US/fbevents.js');

    try {
      fbq('init', '111649226022273');
      fbq('track', "PageView");

    } catch (err) {
      console.log('Facebook Track Error:', err);
    }
  </script>
<noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=111649226022273&amp;ev=PageView&amp;noscript=1" />
  </noscript>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v84a3a4012de94ce1a686ba8c167c359c1696973893317" integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA==" data-cf-beacon='{"rayId":"859dccc7ab345fb4","b":1,"version":"2024.2.1","token":"1b7cbb72744b40c580f8633c6b62637e"}' crossorigin="anonymous"></script>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-- Mirrored from demos.creative-tim.com/argon-dashboard-bs4/examples/tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Feb 2024 07:37:06 GMT -->
</html>