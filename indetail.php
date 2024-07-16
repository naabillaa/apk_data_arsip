<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit(); // Menghentikan eksekusi skrip setelah pengalihan
}

if(isset($_POST['submit'])){
    // Ambil nilai yang dikirimkan melalui form 
    $PenjualanID = $_POST['PenjualanID'];
    $TanggalPenjualan = $_POST['TanggalPenjualan'];
    $SubTotal = $_POST['SubTotal'];
    $DetailID = $_POST['DetailID'];
    $ProdukID = $_POST['ProdukID'];
    $JumlahProduk = $_POST['JumlahProduk'];
    
    // Buat query untuk menambahkan data ke tabel penjualan
    $sql_penjualan = "INSERT INTO penjualan (PenjualanID, TanggalPenjualan, SubTotal) VALUES ('$PenjualanID', '$TanggalPenjualan', '$SubTotal')";
    if ($conn->query($sql_penjualan) === TRUE) {
        // Buat query untuk menambahkan data ke tabel detail_penjualan
        $sql_detail = "INSERT INTO detail_penjualan (DetailID, PenjualanID, ProdukID, JumlahProduk, SubTotal) VALUES ('$DetailID', '$PenjualanID', '$ProdukID', '$JumlahProduk', '$SubTotal')";
        if ($conn->query($sql_detail) === TRUE) {
            // Kurangi stok produk
            $sql_update_stok = "UPDATE produk SET Stok = Stok - $JumlahProduk WHERE ProdukID = '$ProdukID'";
            if ($conn->query($sql_update_stok) === TRUE) {
                // Redirect ke halaman detail
                header("Location: detail.php");
                exit(); // Menghentikan eksekusi skrip setelah pengalihan
            } else {
                echo "Error updating stock: " . $conn->error;
            }
        } else {
            echo "Error adding to detail_penjualan table: " . $conn->error;
        }
    } else {
        // Handle duplicate key error
        if ($conn->errno == 1062) { // MySQL error code for duplicate entry
            // Generate a new PenjualanID and retry the insertion
            $PenjualanID = generateNewPenjualanID($conn);
            // Retry the insertion
          // Buat query untuk menambahkan data ke tabel penjualan
            $sql_penjualan = "INSERT INTO penjualan (TanggalPenjualan, SubTotal) VALUES ('$TanggalPenjualan', '$SubTotal')";
            if ($conn->query($sql_penjualan) === TRUE) {
                $PenjualanID = $conn->insert_id; // Mendapatkan ID yang baru saja disisipkan
              // Proceed with the rest of the operations
                // Buat query untuk menambahkan data ke tabel detail_penjualan
                $sql_detail = "INSERT INTO detail_penjualan (DetailID, PenjualanID, ProdukID, JumlahProduk, SubTotal) VALUES ('$DetailID', '$PenjualanID', '$ProdukID', '$JumlahProduk', '$SubTotal')";
                if ($conn->query($sql_detail) === TRUE) {
                    // Kurangi stok produk
                    $sql_update_stok = "UPDATE produk SET Stok = Stok - $JumlahProduk WHERE ProdukID = '$ProdukID'";
                    if ($conn->query($sql_update_stok) === TRUE) {
                        // Redirect ke halaman detail
                        header("Location: detail.php");
                        exit(); // Menghentikan eksekusi skrip setelah pengalihan
                    } else {
                        echo "Error updating stock: " . $conn->error;
                    }
                } else {
                    echo "Error adding to detail_penjualan table: " . $conn->error;
                }
            } else {
                echo "Error adding to penjualan table after retry: " . $conn->error;
            }
        } else {
            echo "Error adding to penjualan table: " . $conn->error;
        }
    }

    $conn->close();
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
<li class="breadcrumb-item active" aria-current="page">Tambah   Data Produk</li>
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

  <div class="row">
      <div class="col-md-8 offset-md-2">
        
              <div class="card-body">
              <form action="" method="POST" class="">
            

            <div class="form-group">
            <label>Detail ID</label>
                <input type="number" placeholder="Detail ID" name="DetailID" class="form-control" required>
            </div>
            <div class="form-group">
            <label>Penjualan ID </label>

                <input type="number" placeholder="ID Penjualan" name="PenjualanID" class="form-control"  required>
            </div>
               
            <div class="form-group">
            <label>Jumlah Produk</label>

                <input type="number" placeholder="Jumlah Produk" name="JumlahProduk" id="JumlahProduk" class="form-control" required>
            </div>

            <div class="form-group">
    <label> Name by Produk ID </label>
    <select name="ProdukID" id="ProdukID" style="width:200px;" onchange="updateSubTotal()" class="form-control">
    
        <option>Pilih Produk</option>
        <?php
        include "config.php";
        //query menampilkan produk ke dalam combobox
        $query = mysqli_query($conn, "SELECT * FROM produk ORDER BY ProdukID");
        while ($data = mysqli_fetch_array($query)) {
        ?>
            <option value="<?= $data['ProdukID']; ?>" data-harga="<?= $data['Harga']; ?>"><?php echo $data['NamaProduk']; ?></option>
        <?php
        }
        ?>
    </select>
    <!-- <button type="button" class="btn btn-primary" onclick="tambahProduk()">Tambah Produk</button> -->

</div>

<div id="selectedProducts"></div>

<script>
    function addProduct() {
        var produkID = document.getElementById("ProdukID").value;
        var produkNama = document.getElementById("ProdukID").options[document.getElementById("ProdukID").selectedIndex].text;

        // Buat element baru untuk menampilkan produk yang ditambahkan
        var newItem = document.createElement("div");
        newItem.innerHTML = produkNama + " (ID: " + produkID + ")";
        document.getElementById("selectedProducts").appendChild(newItem);
    }

                            let counter = 1;

                            function tambahProduk() {
                            const container = document.getElementById('kandidatContainer');

                            const newProduk = document.createElement('div');
                            newProduk.innerHTML = `
                            <hr>
                            <form id="formProduk" method="post" action="">
                            <div class="form-group">
                              <label> Name by Produk ID </label>
                              <select name="ProdukID" id="ProdukID" style="width:200px;" onchange="updateSubTotal()" class="form-control">
                              
                                  <option>Pilih Produk</option>
                                  <?php
                                  include "config.php";
                                  //query menampilkan produk ke dalam combobox
                                  $query = mysqli_query($conn, "SELECT * FROM produk ORDER BY ProdukID");
                                  while ($data = mysqli_fetch_array($query)) {
                                  ?>
                                      <option value="<?= $data['ProdukID']; ?>" data-harga="<?= $data['Harga']; ?>"><?php echo $data['NamaProduk']; ?></option>
                                  <?php
                                  }
                                  ?>
                              </select>
                              <button type="button" class="btn btn-primary" onclick="tambahProduk()">Tambah Produk</button>

                          </div>
                           
                            </form>
                            
                                `;

                            container.appendChild(newProduk);
                            counter++;
                            }
                        </script>

           
            <div class="form-group">
            <label> SubTotal</label>
                <input type="text" placeholder="Sub Total" name="SubTotal" id="SubTotal" onchange="updateSubTotal()" class="form-control" readonly >
            </div>
            <div class="form-group">
            <label> Tanggal Penjualan</label>

                <input type="Date" placeholder="Tanggal Penjualan" name="TanggalPenjualan" class="form-control" required>
            </div>
         
            <button type="submit" name="submit" class="btn btn-success">SIMPAN</button>
                      <button type="reset" class="btn btn-warning">RESET</button>

        </form>
              </div>
          </div>
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