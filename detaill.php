<?php
include 'config.php';
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit(); // Terminate script execution after the redirect
}

// Tangani pencarian
if(isset($_POST['submit'])){
    $search = $_POST['search'];
    // Query dengan filter pencarian
    $query_detail = "SELECT * FROM produk WHERE DetailID LIKE '%$search%' OR PenjualanID LIKE '%$search%' OR ProdukID LIKE '%$search%'
    OR JumlahProduk LIKE '%$search%' OR SubTotal LIKE '%$search'";

    $query_penjualan = "SELECT * FROM produk WHERE PenjualanID LIKE '%$search%' OR TanggalPenjualan LIKE '%$search%'OR TotalHarga LIKE '%$search'";

} else {
   
    $query_detail = "SELECT * FROM produk";
    $query_penjualan = "SELECT * FROM penjualan";
}

$result_detail = mysqli_query($conn, $query_detail);
$result_penjualan = mysqli_query($conn, $query_penjualan);
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
<a class="nav-link" href="index.php">
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
      <a class="nav-link active" href="detaill.php">
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
            <div class="input-group">
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
<form action="" method="GET" class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">>
<div class="form-group mb-0">
<div class="input-group input-group-alternative input-group-merge">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fas fa-search"></i></span>
</div>
<input type="text"class="form-control"  name="search_query" placeholder="Cari yang dibutuhkan">
            <button type="submit" name="search"class="btn btn-light-inline mr-sm-3"></button><br>
           
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
<!-- <li class="breadcrumb-item"><a href="#">Tables</a></li> -->
<li class="breadcrumb-item active" aria-current="page">Data Detail Penjualan</li>
</ol>
</nav>
</div>
<div class="col-lg-6 col-5 text-right">
<form method="post" action="">
<a href="inn.php" class="btn btn-sm btn-neutral">+ Data Detail Penjualan</a>
<a href="detaill.php"><button type="button" class="btn btn-sm btn-neutral">Tampilkan Semua</button></a>
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
<h3 class="mb-0">Data Detail Penjualan</h3>
</div>
<div class="table-responsive">
<table class="table align-items-center table-flush">
<!-- <table class="table"> -->
  <thead class="thead-light">
    <tr>
      <th scope="col">Kode Produk</th>
      <th scope="col">Nama Produk</th>

      <th scope="col">Aksi</th>

    </tr>
  </thead>
  <tbody>
    <?php
    // Include database connection
    include "config.php";

    // Initialize the query
    $sql = "SELECT PenjualanID, DetailID, ProdukID, JumlahProduk, SubTotal FROM detail_penjualan";

    // Check if search query is set
    if(isset($_GET['search'])) {
        $search_query = $_GET['search_query'];
        // Add WHERE clause for search
        $sql .= " WHERE PenjualanID LIKE '%$search_query%' OR DetailID LIKE '%$search_query%' OR ProdukID LIKE '%$search_query%' OR JumlahProduk LIKE '%$search_query%' OR SubTotal LIKE '%$search_query%'";
    }

    // Attempt to execute the query
    $result = $conn->query($sql);

    // Check if the query execution was successful
    if ($result) {
        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["PenjualanID"]."</td>";
                echo "<td>".$row["DetailID"]."</td>";
                echo "<td>".$row["ProdukID"]."</td>";
                echo "<td>".$row["JumlahProduk"]."</td>";
                echo "<td>".$row["SubTotal"]."</td>";
                echo "<td>";
                echo "<a href='edit.php?DetailID=".$row["DetailID"]."'>Edit</a> | ";
                echo "<a href='../../hapusdetail.php?DetailID=".$row["DetailID"]."' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data?\")'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data detail penjualan.</td></tr>";
        }
    } else {
        // Display error message if query execution fails
        echo "<tr><td colspan='6'>Error executing query: " . $conn->error . "</td></tr>";
    }

    // Close database connection
    $conn->close();
    ?>


 
    <tr>
    <td colspan="7">No data found</td>
  </tr>

  </tbody>
</table>
</div>

<div class="card-footer py-4">
<nav aria-label="...">
<ul class="pagination justify-content-end mb-0">
<li class="page-item disabled">
<a class="page-link" href="#" tabindex="-1">
<i class="fas fa-angle-left"></i>
<span class="sr-only">Previous</span>
</a>
</li>
<li class="page-item active">
<a class="page-link" href="#">1</a>
</li>
<li class="page-item">
<a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
</li>
<li class="page-item"><a class="page-link" href="#">3</a></li>
<li class="page-item">
<a class="page-link" href="#">
<i class="fas fa-angle-right"></i>
<span class="sr-only">Next</span>
</a>
</li>
</ul>
</nav>
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

<!-- Mirrored from demos.creative-tim.com/argon-dashboard-bs4/examples/tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Feb 2024 07:37:06 GMT -->
</html>