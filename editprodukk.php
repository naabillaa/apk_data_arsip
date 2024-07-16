<?php
include 'config.php'; // File koneksi ke database
session_start();

// Cek apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit(); // Hentikan eksekusi skrip setelah redirect
}

// Inisialisasi variabel
$kodeproduk = $namaproduk = $satuan = $tanggal = $jumlah = $harga  = $spesifikasiproduk = $fotoproduk = $kelompokproduk = $jumlahproduk = $tanggalcek = $keterangan = "";

// Cek apakah ada data yang dikirimkan melalui metode POST
if (isset($_POST['submit'])) {
    // Mendapatkan nilai-nilai dari form
    $kodeproduk = $_POST["kodeproduk"];
    $namaproduk = $_POST["namaproduk"];
    $satuan = $_POST["satuan"];
    $tanggal = $_POST["tanggal"];
    $jumlah = $_POST["jumlah"];
    $harga = $_POST["harga"];
    $spesifikasiproduk = $_POST["spesifikasiproduk"];
    $kelompokproduk = $_POST["kelompokproduk"];
    $jumlahproduk = $_POST["jumlahproduk"];
    $tanggalcek = $_POST["tanggalcek"];
    $keterangan = $_POST["keterangan"];

    // Periksa apakah file foto produk baru diunggah
    if (!empty($_FILES["fotoproduk"]["name"])) {
        // Jika file baru diunggah, proses file baru tersebut
        $foto_produk_name = $_FILES["fotoproduk"]["name"];
        $foto_produk_temp = $_FILES["fotoproduk"]["tmp_name"];
        $foto_produk_size = $_FILES["fotoproduk"]["size"];
        $foto_produk_type = $_FILES["fotoproduk"]["type"];

        // Direktori tempat file akan disimpan
        $target_dir = "produk/";
        // Nama file unik dengan ekstensi yang sesuai
        $targetFileName = $target_dir . uniqid() . '_' . basename($foto_produk_name);

        // Periksa ekstensi file yang diizinkan
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");
        $file_extension = strtolower(pathinfo($foto_produk_name, PATHINFO_EXTENSION));
        if (!in_array($file_extension, $allowed_extensions)) {
            echo "ERROR: Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
            exit();
        }

        // Periksa ukuran file
        if ($foto_produk_size > 5000000) { // 5 MB (5000000 bytes)
            echo "ERROR: Ukuran file terlalu besar. Max 5 MB.";
            exit();
        }

        // Coba untuk mengunggah file ke direktori yang ditentukan
        if (move_uploaded_file($foto_produk_temp, $targetFileName)) {
            // Jika berhasil diunggah, simpan nama file ke variabel fotoproduk
            $fotoproduk = basename($targetFileName);

            // Tambahkan path lengkap ke database
            $fotoproduk = $targetFileName;
        } else {
            // Jika gagal mengunggah, tampilkan pesan error
            echo "ERROR: Gagal mengunggah file foto produk.";
            exit();
        }
    } else {
        // Jika file tidak diunggah, gunakan nilai file yang sudah ada di database
        $fotoproduk = $_POST["existing_fotoproduk"];
    }

    // Query untuk melakukan update data produk
    $query_produk = "UPDATE produk SET namaproduk=?, satuan=?, tanggal=?, jumlah=?, harga=?, spesifikasiproduk=?, fotoproduk=? WHERE kodeproduk=?";

    // Persiapkan statement untuk produk
    $stmt_produk = mysqli_prepare($conn, $query_produk);
    if ($stmt_produk === false) {
        echo "ERROR: Gagal mempersiapkan statement update produk: " . mysqli_error($conn);
        exit();
    }

    // Bind parameter ke statement produk
    mysqli_stmt_bind_param($stmt_produk, "sssissss", $namaproduk, $satuan, $tanggal, $jumlah, $harga, $spesifikasiproduk, $fotoproduk, $kodeproduk);

    // Eksekusi statement untuk produk
    if (mysqli_stmt_execute($stmt_produk)) {
        // Jika berhasil update produk, lanjutkan ke tabel kelompok
        // Query untuk melakukan update data kelompok
        $query_kelompok = "UPDATE kelompok SET kelompokproduk=?, jumlah=?, tanggalcek=?, keterangan=? WHERE kodeproduk=?";

        // Persiapkan statement untuk kelompok
        $stmt_kelompok = mysqli_prepare($conn, $query_kelompok);
        if ($stmt_kelompok === false) {
            echo "ERROR: Gagal mempersiapkan statement update kelompok: " . mysqli_error($conn);
            exit();
        }

        // Bind parameter ke statement kelompok
        mysqli_stmt_bind_param($stmt_kelompok, "sissi", $kelompokproduk, $jumlahproduk, $tanggalcek, $keterangan, $kodeproduk);

        // Eksekusi statement untuk kelompok
        if (mysqli_stmt_execute($stmt_kelompok)) {
            echo "Data berhasil diperbarui.";
            // Redirect ke halaman produk setelah berhasil update
            header("Location: dataproduk.php");
            exit(); // Hentikan eksekusi skrip setelah redirect
        } else {
            echo "ERROR: Gagal mengeksekusi statement update kelompok: " . mysqli_stmt_error($stmt_kelompok);
        }

        // Tutup statement kelompok
        mysqli_stmt_close($stmt_kelompok);
    } else {
        echo "ERROR: Gagal mengeksekusi statement update produk: " . mysqli_stmt_error($stmt_produk);
    }

    // Tutup statement produk
    mysqli_stmt_close($stmt_produk);
}

// Mendapatkan nilai kodeproduk dari URL atau form
if (isset($_GET['kodeproduk'])) {
    $kodeproduk = $_GET['kodeproduk'];
} else {
    echo "Kode produk tidak ditemukan dalam URL.";
    exit();
}

// Query untuk mendapatkan data produk berdasarkan kodeproduk
$query_produk = "SELECT * FROM produk WHERE kodeproduk = ?";

// Persiapkan statement untuk produk
$stmt_produk = mysqli_prepare($conn, $query_produk);
if ($stmt_produk === false) {
    echo "ERROR: Gagal mempersiapkan statement select produk: " . mysqli_error($conn);
    exit();
}

// Bind parameter ke statement produk
mysqli_stmt_bind_param($stmt_produk, "s", $kodeproduk);

// Eksekusi statement untuk produk
if (mysqli_stmt_execute($stmt_produk)) {
    // Ambil hasil dari statement produk
    $result_produk = mysqli_stmt_get_result($stmt_produk);

    // Ambil data produk
    if ($row_produk = mysqli_fetch_assoc($result_produk)) {
        $namaproduk = $row_produk['namaproduk'];
        $satuan = $row_produk['satuan'];
        $tanggal = $row_produk['tanggal'];
        $jumlah = $row_produk['jumlah'];
        $harga = $row_produk['harga'];
        $spesifikasiproduk = $row_produk['spesifikasiproduk'];
        $fotoproduk = $row_produk['fotoproduk']; // Simpan nama file foto produk untuk ditampilkan
    } else {
        echo "Data produk tidak ditemukan.";
        exit();
    }
} else {
    echo "ERROR: Gagal mengeksekusi statement select produk: " . mysqli_stmt_error($stmt_produk);
    exit();
}

// Tutup statement produk
mysqli_stmt_close($stmt_produk);

// Query untuk mendapatkan data kelompok berdasarkan kodeproduk
$query_kelompok = "SELECT * FROM kelompok WHERE kodeproduk = ?";

// Persiapkan statement untuk kelompok
$stmt_kelompok = mysqli_prepare($conn, $query_kelompok);
if ($stmt_kelompok === false) {
    echo "ERROR: Gagal mempersiapkan statement select kelompok: " . mysqli_error($conn);
    exit();
}

// Bind parameter ke statement kelompok
mysqli_stmt_bind_param($stmt_kelompok, "s", $kodeproduk);

// Eksekusi statement untuk kelompok
if (mysqli_stmt_execute($stmt_kelompok)) {
    // Ambil hasil dari statement kelompok
    $result_kelompok = mysqli_stmt_get_result($stmt_kelompok);

    // Ambil data kelompok
    if ($row_kelompok = mysqli_fetch_assoc($result_kelompok)) {
        $kelompokproduk = $row_kelompok['kelompokproduk'];
        $jumlahproduk = $row_kelompok['jumlah'];
        $tanggalcek = $row_kelompok['tanggalcek'];
        $keterangan = $row_kelompok['keterangan'];
    } else {
        echo "Data kelompok tidak ditemukan.";
        exit();
    }
} else {
    echo "ERROR: Gagal mengeksekusi statement select kelompok: " . mysqli_stmt_error($stmt_kelompok);
    exit();
}

// Tutup statement kelompok
mysqli_stmt_close($stmt_kelompok);

// Tutup koneksi database
mysqli_close($conn);
?>



<!DOCTYPE html>
<html>

<!-- Mirrored from demos.creative-tim.com/argon-dashboard-bs4/examples/tables.html by HTTrack spesifikasiprodukproduk Copier/3.x [XR&CO'2014], Fri, 23 Feb 2024 07:37:01 GMT -->
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
<a href="#">
  <img src="logo.png" class="navbar-brand-img" alt="..." style="width: 1b0%; height: auto;">
</a>

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
  <a class="nav-link active" href="produk.php">
  <i class="ni ni-bullet-list-67 text-default"></i>
  <span class="nav-link-text">Data Produk</span>
  </a>
  </li>
  <li class="nav-item">
  <a class="nav-link " href="produk.php">
  <i class="ni ni-bullet-list-67 text-default"></i>
  <span class="nav-link-text">Data Supplier</span>
  </a>
  </li>
 
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

<form action="logout.php" method="POST" class="login-email">
            <div class="input-group">

            </div>        
          </form>
<div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
<div class="sidenav-toggler-inner">
<i class="sidenav-toggler-line"></i>
<i class="sidenav-toggler-line"></i>
<i class="sidenav-toggler-line"></i>
</div>
</div>
</li>
</ul>
<ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">

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
<li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="produk.php">Data Supplier</a></li>
<li class="breadcrumb-item active" aria-current="page">Edit Produk Suuplier</li>
</ol>
</nav>
</div>
<div class="col-lg-6 col-5 text-right">
<form method="post" action="">

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
<h3 class="mb-0">Edit Produk</h3>
</div>

  <div class="row">
      <div class="col-md-8 offset-md-2">
        
              <div class="card-body">
              <form method="post" enctype="multipart/form-data">
    <!-- Hidden input to store existing filename for existing image -->
    <input type="hidden" name="existing_fotoproduk" value="<?php echo htmlspecialchars($fotoproduk); ?>">

    <!-- Other form inputs -->
    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" name="namaproduk" value="<?php echo htmlspecialchars($namaproduk); ?>" class="form-control">
    </div>
    <div class="form-group">
        <label>Satuan</label>
        <input type="text" name="satuan" value="<?php echo htmlspecialchars($satuan); ?>" class="form-control">
    </div>
    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" name="tanggal" value="<?php echo htmlspecialchars($tanggal); ?>" class="form-control">
    </div>
    <div class="form-group">
        <label>Jumlah</label>
        <input type="number" name="jumlah" value="<?php echo htmlspecialchars($jumlah); ?>" class="form-control">
    </div>
    <div class="form-group">
        <label>Harga</label>
        <input type="text" name="harga" value="<?php echo htmlspecialchars($harga); ?>" class="form-control">
    </div>
    <div class="form-group">
        <label>Spesifikasi Produk</label>
        <textarea name="spesifikasiproduk" class="form-control"><?php echo htmlspecialchars($spesifikasiproduk); ?></textarea>
    </div>
    <div class="form-group">
        <label>Foto Produk</label>
        <input type="file" name="fotoproduk" class="form-control">
    </div>
   
                      
                  <div class="form-group">
    <label>Kelompok Produk</label>
    <input type="text" name="kelompokproduk" value="<?php echo htmlspecialchars($kelompokproduk); ?>" placeholder="Kelompok Produk" class="form-control">
</div>

<div class="form-group">
    <label>Jumlah Produk</label>
    <input type="text" name="jumlahproduk" value="<?php echo htmlspecialchars($jumlahproduk); ?>" placeholder="Jumlah Produk" class="form-control">
</div>

<div class="form-group">
    <label>Tanggal Cek</label>
    <input type="date" name="tanggalcek" value="<?php echo htmlspecialchars($tanggalcek); ?>" placeholder="Tanggal Cek" class="form-control">
</div>

<div class="form-group">
    <label>Keterangan</label>
    <input type="text" name="keterangan" value="<?php echo htmlspecialchars($keterangan); ?>" placeholder="Keterangan" class="form-control">
</div>


                      <button type="submit" name="submit" class="btn btn-primary">UPDATE</button>
                      <form id="form">
  <!-- Isi formulir di sini -->
  <button type="reset" class="btn btn-danger btn-reset" style="background-color: #f10000;">RESET</button>
</form>
<script>
  // Menangkap klik tombol reset
  document.querySelector('.btn-reset').addEventListener('click', function(event) {
    event.preventDefault(); // Mencegah reset bawaan
    // Menampilkan Sweet Alert untuk konfirmasi reset
    swal({
      title: "Anda yakin ingin mereset?",
      text: "Semua data yang diisi akan hilang!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willReset) => {
      if (willReset) {
        // Jika pengguna mengkonfirmasi reset, resetkan formulir
        document.getElementById("form").reset();
        swal("Formulir telah direset!", {
          icon: "success",
        });
      } else {
        // Jika pengguna membatalkan reset, tampilkan pesan
        swal("Formulir tidak direset!");
      }
    });
  });
</script>


                      
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

<!-- Mirrored from demos.creative-tim.com/argon-dashboard-bs4/examples/tables.html by HTTrack spesifikasiprodukproduk Copier/3.x [XR&CO'2014], Fri, 23 Feb 2024 07:37:06 GMT -->
</html>