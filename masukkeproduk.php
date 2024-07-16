<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit(); // Menghentikan eksekusi skrip setelah pengalihan
}

// Periksa apakah formulir telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap nilai-nilai dari formulir
    $kodeproduk = $_POST["kodeproduk"];
    // Periksa apakah ada kodepelanggan dalam parameter URL
    if (isset($_GET['kodepelanggan'])) {
        $kodepelanggan = $_GET['kodepelanggan'];
    } else {
        // Jika tidak ada kodepelanggan dalam parameter URL, berikan nilai default atau lakukan tindakan lain sesuai kebutuhan
        $kodepelanggan = "Nilai Default";
    }
    $namaproduk = $_POST["namaproduk"];
    $satuan = $_POST["satuan"];
    $tanggal = $_POST["tanggal"];
    $jumlah = $_POST["jumlah"];
    $harga = $_POST["harga"];
    $tanggalupdate = $_POST["tanggalupdate"];
    $spesifikasiproduk = $_POST["spesifikasiproduk"];
    $fotoproduk = $_FILES["fotoproduk"]["name"];
    $kelompokproduk = $_POST["kelompokproduk"];
    $jumlahproduk = $_POST["jumlahproduk"];
    $tanggalcek = $_POST["tanggalcek"];
    $keterangan = $_POST["keterangan"];



    // Tentukan direktori penyimpanan file gambar
    $targetDir = "produk/";

    // Buat nama file unik dengan menggabungkan timestamp dengan nama file asli
    $targetFileName = $targetDir . uniqid() . '_' . basename($_FILES["fotoproduk"]["name"]);

    // Ambil ekstensi file
    $fileType = strtolower(pathinfo($targetFileName, PATHINFO_EXTENSION));

    // Format file yang diperbolehkan untuk diunggah
    $allowTypes = array('jpg', 'jpeg', 'png', 'gif');

    // Periksa apakah file adalah gambar dan sesuai dengan format yang diizinkan
    if (in_array($fileType, $allowTypes)) {
        // Pindahkan file gambar ke direktori penyimpanan
        if (move_uploaded_file($_FILES["fotoproduk"]["tmp_name"], $targetFileName)) {
            // Masukkan data produk ke dalam database
            for ($i = 0; $i < count($kelompokproduk); $i++) {
                $sql = "INSERT INTO produk (kodeproduk, kodepelanggan, namaproduk, satuan, tanggal, jumlah, harga, tanggalupdate, spesifikasiproduk, fotoproduk, kelompokproduk, jumlahproduk, tanggalcek, keterangan) 
                        VALUES ('$kodeproduk', '$kodepelanggan', '$namaproduk', '$satuan', '$tanggal', '$jumlah', '$harga', '$tanggalupdate', '$spesifikasiproduk', '$targetFileName', '{$kelompokproduk[$i]}', '{$jumlahproduk[$i]}', '{$tanggalcek[$i]}', '{$keterangan[$i]}')";
                
                if ($conn->query($sql) === TRUE) {
                    // Sebelumnya, pastikan Anda telah menyertakan SweetAlert dalam halaman Anda

// Buat panggilan JavaScript untuk menampilkan pesan sukses menggunakan SweetAlert
echo "<script>Swal.fire('Sukses!', 'Data produk telah berhasil dimasukkan ke database.', 'success').then((result) => { if (result.isConfirmed) { window.location.href = 'halaman_berikutnya.php'; }});</script>";
 
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
        }
    } else {
        echo "Maaf, hanya file gambar dengan format JPG, JPEG, PNG, atau GIF yang diperbolehkan.";
    }
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Include SweetAlert CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">

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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
function validateForm() {
    var namaproduk = document.forms["myForm"]["namaproduk"].value;
    if (namaproduk == "") {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Nama Barang harus diisi."
        });
        return false;
    }
    // Add other validations as needed
    return true;
}
</script>
<!-- Include SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- Include SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<!-- Include Sweet Alert CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">

<!-- Include jQuery (jika belum ada) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- Include Sweet Alert JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- Script untuk validasi -->
<script>
    function validateForm() {
        // Ambil nilai dari input
        var kodeproduk = document.forms["myForm"]["kodeproduk"].value;
        var namaproduk = document.forms["myForm"]["namaproduk"].value;
        var satuan = document.forms["myForm"]["satuan"].value;
        var tanggal = document.forms["myForm"]["tanggal"].value;
        var jumlah = document.forms["myForm"]["jumlah"].value;
        var harga = document.forms["myForm"]["harga"].value;
        var tanggalupdate = document.forms["myForm"]["tanggalupdate"].value;
        var spesifikasiproduk = document.forms["myForm"]["spesifikasiproduk"].value;
        var fotoproduk = document.forms["myForm"]["fotoproduk"].value;
        var kelompokproduk = document.forms["myForm"]["kelompokproduk[]"].value;
        var jumlahproduk = document.forms["myForm"]["jumlahproduk[]"].value;
        var tanggalcek = document.forms["myForm"]["tanggalcek[]"].value;
        var keterangan = document.forms["myForm"]["keterangan[]"].value;

        // Periksa jika ada field yang kosong
        if (kodeproduk == "" || namaproduk == "" || satuan == "" || tanggal == "" || jumlah == "" || harga == "" || tanggalupdate == "" || spesifikasiproduk == "" || fotoproduk == "" || kelompokproduk == "" || jumlahproduk == "" || tanggalcek == "" || keterangan == "") {
            // Tampilkan Sweet Alert
            swal({
                title: "Error!",
                text: "Semua field harus diisi!",
                icon: "error",
                button: "OK",
            });
            return false; // Mencegah pengiriman formulir jika ada field yang kosong
        }
    }
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
  <a class="nav-link " href="index.php ">
  <i class="ni ni-tv-2 text-primary"></i>
  <span class="nav-link-text">Dashboard</span>
  </a>
  </li>
  
  
  <li class="nav-item">
  <a class="nav-link active" href="produk.php">
  <i class="ni ni-bullet-list-67 text-default"></i>
  <span class="nav-link-text">Data Produk</span>
  </a>
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
<li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="produk.php">Data Pelanggan</a></li>
<li class="breadcrumb-item active" aria-current="page">Tambah Data Pelanggan</li>
</ol>
</nav>
</div>
<div class="col-lg-6 col-5 text-right">
<form method="post" action="">
  
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
<h3 class="mb-0">Tambah Pelanggan</h3><h2></h2>
</div>

  <div class="row">
      <div class="col-md-8 offset-md-2">
        
              <div class="card-body">
              <form method="POST" action="" enctype="multipart/form-data" name="myForm" onsubmit="return validateForm()">

           
              <div class="form-group">
                  <label>Kode Produk</label>
                  <input type="text" name="kodeproduk" placeholder="Kode Produk" class="form-control">
              </div>

              <div class="form-group">
                  <label>Nama Barang</label>
                  <input type="text" name="namaproduk" placeholder="Nama Barang" class="form-control">
              </div>
              
              <div class="form-group">
                  <label>Satuan</label>
                  <input type="text" name="satuan" placeholder="Satuan" class="form-control">
              </div>
              <div class="alamatkantor-group">
         
                        <p>histori pesanan</p>
                <div class="row">
                    <div class="col">
                    <input type="date" class="form-control" name="tanggal" placeholder="Tanggal">
                    </div>
                    
                    <div class="col">
                    <input type="number" class="form-control" name="jumlah" placeholder="Jumlah">
                    </div>
                    <div class="col">
                    <input type="number" class="form-control" name="harga" placeholder="Harga">
                    </div>
                </div>
<br>
              <div class="form-group">
                  <label>Tanggal Update</label>
                  <input type="date" name="tanggalupdate" placeholder="Tanggal Update" class="form-control">
              </div>
              <div class="form-group">
                  <label>Spesifikasi Produk</label>
                  <input type="text" name="spesifikasiproduk" placeholder="Spesifikasi Produk " class="form-control">
              </div>
              <div class="form-group">
                  <label>Foto Produk</label>
                  <input type="file" name="fotoproduk" placeholder="foto produk" class="form-control">
              </div>
              <div class="row">
    <div class="col">
        <label for="inputState">Kelompok</label>
        <input type="text" class="form-control" name="kelompokproduk[]" placeholder="Film Kalkir">
    </div>
    <div class="col">
        <label for="inputState">Jumlah</label>
        <input type="number" class="form-control" name="jumlahproduk[]" placeholder="Jumlah">
    </div>
    <div class="col">
        <label for="inputState">Tanggal Check</label>
        <input type="date" class="form-control" name="tanggalcek[]" placeholder="Tanggal">
    </div>
    <div class="row">
    <div class="col">
        <label for="inputState">Keterangan</label>
        <div class="input-group">
            <input type="text" class="form-control" name="keterangan[]" placeholder="Keterangan">
            <div class="input-group-append">
                <button type="button" onclick="addRow()" class="btn btn-primary">+</button>
            </div>
        </div>
    </div>
</div>

</div>

<div id="additionalRows"></div>

<script>
    function addRow() {
        var container = document.getElementById('additionalRows');
        var newRow = document.createElement('div');
        newRow.className = 'row';
        newRow.innerHTML = `
            <div class="col">
                <label for="inputState">Kelompok</label>
                <input type="text" class="form-control" name="kelompokproduk[]" placeholder="Film Kalkir">
            </div>
            <div class="col">
                <label for="inputState">Jumlah</label>
                <input type="number" class="form-control" name="jumlah[]" placeholder="Jumlah">
            </div>
            <div class="col">
                <label for="inputState">Tanggal Check</label>
                <input type="date" class="form-control" name="tanggal[]" placeholder="Tanggal">
            </div>
            <div class="col">
                <label for="inputState">Keterangan</label>
                <input type="text" class="form-control" name="keterangan[]" placeholder="Keterangan">
                
                <button type="button" onclick="removeRow(this)" class="btn btn-danger">-</button>
            </div>
        `;
        container.appendChild(newRow);
    }

    function removeRow(button) {
        button.parentNode.parentNode.remove();
    }
</script>

          </div>
          <br>
          <button type="submit" name="submit" class="btn btn-primary" style="background-color: blue; color: white;">SIMPAN</button>

              <button type="reset" class="btn btn-danger" onclick="confirmReset()" style="background-color:#e70707; color: white;">RESET</button>

          </form>

          </div>
              </div>
          </div>
          <script>
    // Mendapatkan tombol reset
    var resetButton = document.getElementById('resetButton');

    // Menambahkan event listener untuk saat tombol reset di-klik
    resetButton.addEventListener('click', function() {
      // Menampilkan Sweet Alert untuk konfirmasi
      swal({
        title: "Apakah Anda Yakin?",
        text: "Semua data akan di-reset!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willReset) => {
        // Jika pengguna mengklik "Ya", maka lakukan reset
        if (willReset) {
          // Di sini Anda bisa menambahkan logika untuk melakukan reset
          swal("Data telah di-reset!", {
            icon: "success",
          });
        } else {
          // Jika pengguna membatalkan, tampilkan pesan bahwa reset dibatalkan
          swal("Reset dibatalkan!");
        }
      });
    });
  </script>


<footer class="footer pt-0">
<div class="row align-items-center justify-content-lg-between">
<div class="col-lg-6">
<div class="copyright text-center  text-lg-left  text-muted">
&copy; 2024 <a href="https://www.creative-tim.com/" class="font-weight-bold ml-1" target="_blank">Felice copyright</a>
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
  
<script>
    // function addAlamatKantor() {
    //     var container = document.querySelector('.alamatkantor-group');
    //     var html = '<div class="form-group">';
    //     html += '<label>Alamat Kantor</label>';
    //     html += '<input type="text" name="alamatkantor[]" placeholder="alamat kantor" class="form-control">';
    //     html += '</div>';
    //     container.insertAdjacentHTML('beforebegin', html);
    // }

    // function addAlamatPengiriman() {
    //     var container = document.querySelector('.alamatpengiriman-group');
    //     var html = '<div class="form-group">';
    //     html += '<label>Alamat Pengiriman</label>';
    //     html += '<input type="text" name="alamatpengiriman[]" placeholder="Alamat Pengiriman" class="form-control">';
    //     html += '</div>';
    //     container.insertAdjacentHTML('beforebegin', html);
    // }

    function addNoTelpKantor() {
        var container = document.querySelector('.notelpkantor-group');
        var html = '<div class="form-group">';
        html += '<label>No.Telp Kantor</label>';
        html += '<input type="number" name="notelpkantor[]" placeholder="No.Telp Kantor" class="form-control">';
        html += '</div>';
        container.insertAdjacentHTML('beforebegin', html);
    }

    // function addKontak() {
    //     var container = document.querySelector('.kontak-group');
    //     var html = '<div class="form-group">';
    //     html += '<label>Kontak</label>';
    //     html += '<input type="text" name="kontak[]" placeholder="kontak" class="form-control">';
    //     html += '</div>';
    //     container.insertAdjacentHTML('beforebegin', html);
    // }

    function addNoTelp() {
        var container = document.querySelector('.notelp-group');
        var html = '<div class="form-group">';
        html += '<label>No.Telp/HP</label>';
        html += '<input type="number" name="notelp[]" placeholder="No.Telp/HP" class="form-control">';
        html += '</div>';
        container.insertAdjacentHTML('beforebegin', html);
    }
</script>
<script>
    // Fungsi untuk mengkonfirmasi reset data
    function confirmReset() {
      // Menampilkan Sweet Alert untuk konfirmasi
      swal({
        title: "Apakah Anda Yakin?",
        text: "Semua data akan di-reset!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willReset) => {
        // Jika pengguna mengklik "Ya", maka lakukan reset
        if (willReset) {
          // Di sini Anda bisa menambahkan logika untuk melakukan reset
          swal("Data telah di-reset!", {
            icon: "success",
          });
        } else {
          // Jika pengguna membatalkan, tampilkan pesan bahwa reset dibatalkan
          swal("Reset dibatalkan!");
        }
      });
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- Mirrored from demos.creative-tim.com/argon-dashboard-bs4/examples/tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Feb 2024 07:37:06 GMT -->
</html>