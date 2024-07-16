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
      $query = "SELECT * FROM supplier WHERE kodesupplier LIKE '%$search%' OR namasupplier LIKE '%$search%' OR alamatkantor LIKE '%$search%'
      OR alamatpengiriman LIKE '%$search%'";
  } else {
      // Query tanpa filter pencarian
      $query = "SELECT * FROM supplier";
  }

  $result = mysqli_query($conn, $query);
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
        <a class="nav-link active" href=" supplier.php">
        <i class="ni ni-bullet-list-67 text-default"></i>
        <span class="nav-link-text">Data supplier</span>
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
  <h6 class="h2 text-white d-inline-block mb-0">Halaman</h6>
  <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
  <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
  <!-- <li class="breadcrumb-item"><a href="#">Tables</a></li> -->
  <li class="breadcrumb-item active" aria-current="page">Data Supplier</li>
  </ol>
  </nav>
  </div>
  <div class="col-lg-6 col-5 text-right">
  <form method="post" action="">
  <a href="supplier.php" class="btn btn-sm btn-neutral" id="printButton"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
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
  <a href="insupplier.php" class="btn btn-sm btn-neutral">+ Data Supplier</a>

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
  <h3 class="mb-0">Data supplier</h3>
  </div><div class="table-responsive">
  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">No</th>
        <th scope="col">kodesupplier</th>
        <th scope="col">Nama kantor</th>
        <th scope="col">alamatkantor</th>
        <th scope="col">alamatpengiriman</th>
        <th scope="col">Aksi</th>

      </tr>
    </thead>
    <tbody>
    <?php
  if (mysqli_num_rows($result) > 0) {
    $sn=1;
    while($data = mysqli_fetch_assoc($result)) {
  ?>
      <tr>
        <th scope="row"><?php echo $sn; ?></th>
        <td><?php echo $data['kodesupplier']; ?></td>

        <td><?php echo $data['namasupplier']; ?></td>
        <td><?php echo $data['alamatkantor']; ?></td>
        <td><?php echo $data['alamatpengiriman']; ?></td>
        <td>
        <div class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle hdbutton" style="color: black;">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
              </svg> 
            </a>  
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#detailPelangganModal<?php echo $data['kodesupplier']; ?>">Detail Pelanggan</a></li>
          <li><a class="dropdown-item" href="dataproduksupplier.php?kodesupplier=<?php echo $data['kodesupplier']; ?>">List Produk</a> </li>
              <li><a   class="dropdown-item"href="editsupplier.php?kodesupplier=<?php echo $data['alamatkantor']; ?>">Edit</a></li>
              <li><a class="dropdown-item" href="#" onclick="confirmDelete('<?php echo $data['alamatkantor']; ?>')">Hapus</a></li>
            </ul>
          </div>  
        
          <div class="modal fade" id="detailPelangganModal<?php echo $data['kodesupplier']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailPelangganModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="detailPelangganModalLabel">Detail &times; <?php echo $data['namasupplier']; ?></h5>

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>     
        </div>
        <div class="modal-body">
      <div class="table-responsive">
      <table>
      <tr>
              <td>Kode Pelanggan:</td>
              <td><?php echo $data['kodesupplier']; ?></td>
          </tr>
          <tr>
              <td>Nama Perusahaan:</td>
              <td><?php echo $data['namasupplier']; ?></td>
          </tr>
          <tr>
              <td>Alamat Perusahaan:</td>
              <td><?php echo $data['alamatkantor']; ?></td>
          </tr>
          <tr>
              <td>Alamat Pengiriman:</td>
              <td><?php echo $data['alamatpengiriman']; ?></td>
          </tr>
          <tr>
              <td>Kontak Person:</td>
              <td><?php echo $data['kontakperson']; ?></td>
          </tr>
      
        
          <tr>
              <td>NPWP:</td>
              <td><?php echo $data['npwp']; ?></td>
          </tr>
        
          <tr>
              <td>Catatan:</td>
              <td><?php echo $data['catatan']; ?></td>
          </tr>
          <tr>
              <td>Tanggal Update:</td>
              <td><?php echo $data['tanggalupdate']; ?></td>
          </tr>
      </table>
  </div>
  </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  </td>
    </tr>


    <?php
    $sn++;
    }
  } else {
  ?>
      <tr>
      <td colspan="7">No data found</td>
    </tr>
  <?php
  }
  ?>
    </tbody>
  </table>
  </table>

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
  &copy; 2024 <a href="https://www.creative-tim.com/" class="font-weight-bold ml-1" target="_blank">Felice Copyright</a>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
      // Fungsi untuk menampilkan SweetAlert konfirmasi penghapusan
      function confirmDelete(alamatKantor) {
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
                  window.location.href = 'deletesupplier.php?alamatkantor=' + alamatKantor;
              }
          });
      }
  </script>
  <noscript>
      <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=111649226022273&amp;ev=PageView&amp;noscript=1" />
    </noscript>
  <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v84a3a4012de94ce1a686ba8c167c359c1696973893317" integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA==" data-cf-beacon='{"rayId":"859dccc7ab345fb4","b":1,"version":"2024.2.1","token":"1b7cbb72744b40c580f8633c6b62637e"}' crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </body>

  <!-- Mirrored from demos.creative-tim.com/argon-dashboard-bs4/examples/tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Feb 2024 07:37:06 GMT -->
  </html>