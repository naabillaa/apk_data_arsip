<?php
// Include file konfigurasi database
include 'config.php';

// Mulai session
session_start();

// Redirect ke halaman login jika session username tidak di-set
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit(); // Hentikan eksekusi script setelah redirect
}

// Inisialisasi variabel untuk pesan feedback dan errors
$pesan = '';

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Collect form data
    $kodepelanggan = $_POST['kodepelanggan'];
    $namaperusahaan = $_POST['namaperusahaan'];
    $klasifikasi = $_POST['klasifikasi'];
    $alamatperusahaan = $_POST['alamatperusahaan'];
    $alamatperusahaan2 = $_POST['alamatperusahaan2'];
    $alamatpengiriman = $_POST['alamatpengiriman'];
    $alamatpengiriman2 = $_POST['alamatpengiriman2'];
    $kontakperson = $_POST['kontakperson'];
    $kontakperson2 = $_POST['kontakperson2'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $npwp = $_POST['npwp'];
    $sales = $_POST['sales'];
    $catatan = $_POST['catatan'];
    $tanggalupdate = $_POST['tanggalupdate'];

    // Folder tujuan untuk menyimpan file proposal
    $targetDir = 'proposal/';

    // Handle File Upload for proposal
    $proposalFileName = '';
    if (isset($_FILES['proposal']) && $_FILES['proposal']['error'] === UPLOAD_ERR_OK) {
        $proposalFileName = $_FILES['proposal']['name'];
        $proposalFilePath = $targetDir . $proposalFileName;

        // Pindahkan file ke folder tujuan 
        if (move_uploaded_file($_FILES['proposal']['tmp_name'], $proposalFilePath)) {
            echo "<script>
            alert('File proposal berhasil diunggah');
            window.location.href = 'produk.php'; // Redirect ke halaman produk.php
        </script>";
        } else {
            echo "Gagal mengunggah file proposal.";
        }
    } else {
        echo "Error: Terjadi masalah saat mengunggah file proposal.";
    }

    // Handle File Upload for proposal2
    $proposal2FileName = '';
    if (isset($_FILES['proposal2']) && $_FILES['proposal2']['error'] === UPLOAD_ERR_OK) {
        $proposal2FileName = $_FILES['proposal2']['name'];
        $proposal2FilePath = $targetDir . $proposal2FileName;

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($_FILES['proposal2']['tmp_name'], $proposal2FilePath)) {
            echo "File proposal2 berhasil diunggah.";
        } else {
            echo "Gagal mengunggah file proposal2.";
        }
    } else {
        echo "Error: Terjadi masalah saat mengunggah file proposal2.";
    }

    // Handle File Upload for proposal3
    $proposal3FileName = '';
    if (isset($_FILES['proposal3']) && $_FILES['proposal3']['error'] === UPLOAD_ERR_OK) {
        $proposal3FileName = $_FILES['proposal3']['name'];
        $proposal3FilePath = $targetDir . $proposal3FileName;

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($_FILES['proposal3']['tmp_name'], $proposal3FilePath)) {
            echo "File proposal3 berhasil diunggah.";
        } else {
            echo "Gagal mengunggah file proposal3.";
        }
    } else {
        echo "Error: Terjadi masalah saat mengunggah file proposal3.";
    }

    // Example SQL insert query
    $sql = "INSERT INTO pelanggan (kodepelanggan, namaperusahaan, klasifikasi, alamatperusahaan, alamatperusahaan2, alamatpengiriman, alamatpengiriman2, kontakperson, kontakperson2, email, website, npwp, proposal, proposal2, proposal3, sales, catatan, tanggalupdate) 
            VALUES ('$kodepelanggan', '$namaperusahaan', '$klasifikasi', '$alamatperusahaan', '$alamatperusahaan2', '$alamatpengiriman', '$alamatpengiriman2', '$kontakperson', '$kontakperson2', '$email', '$website', '$npwp', '$proposalFileName', '$proposal2FileName', '$proposal3FileName', '$sales', '$catatan', '$tanggalupdate')";

    // Execute the insert query
    if (mysqli_query($conn, $sql)) {
        $pesan = "Data berhasil disimpan.";
    } else {
        $pesan = "Gagal menyimpan data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Argon Dashboard - Free Dashboard for Bootstrap 4</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="canonical" href="https://www.creative-tim.com/product/argon-dashboard">
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
      j.src = '../../../www.googletagmanager.com/gtm5445.html?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-NKDMSK6');
  </script>

</head>
<body>
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe>
  </noscript>

  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <div class="sidenav-header align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <span style="font-weight: bold; color: #5e72e4;">Felice Area</span>
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
                <span class="nav-link-text">Data Pelanggan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="supplier.php">
                <i class="ni ni-bullet-list-67 text-default"></i>
                <span class="nav-link-text">Data supplier</span>
              </a>
            </li>
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
                <!-- Search input -->
              </div>
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
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="produk.php">Data Pelanggan</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Tambah Data Pelanggan</li>
                </ol>
              </nav>
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
              <h3 class="mb-0">Tambah Pelanggan</h3>
              <h2></h2>
            </div>
            <?php if (!empty($pesan)) : ?>
              <p><?php echo $pesan; ?></p>
            <?php endif; ?>
            <div class="row">
              <div class="col-md-8 offset-md-2">
                <div class="card-body">
                  <form action="" enctype="multipart/form-data" method="POST" id="myForm">
                    <div class="form-group">
                      <label>Kode Pelanggan</label>
                      <input type="text" name="kodepelanggan" placeholder="Kode Pelanggan" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Nama Perusahaan</label>
                      <input type="text" name="namaperusahaan" placeholder="Nama Perusahaan" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Klasifikasi</label>
                      <input type="text" name="klasifikasi" placeholder="C01-PAKAIAN DAN AKSESORIS MODE" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Alamat Perusahaan 1</label>
                      <input type="text" name="alamatperusahaan" placeholder="Alamat Kantor" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Alamat Perusahaan 2</label>
                      <input type="text" name="alamatperusahaan2" placeholder="Alamat Kantor" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Alamat Pengiriman 1</label>
                      <input type="text" name="alamatpengiriman" placeholder="Alamat Pengiriman" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Alamat Pengiriman 2</label>
                      <input type="text" name="alamatpengiriman2" placeholder="Alamat Pengiriman" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Kontak Person 1</label>
                      <input type="number" name="kontakperson" placeholder="Kontak Person 1" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Kontak Person 2</label>
                      <input type="number" name="kontakperson2" placeholder="Kontak Person 2" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="text" name="email" placeholder="Email" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Website</label>
                      <input type="text" name="website" placeholder="Website" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>NPWP</label>
                      <input type="text" name="npwp" placeholder="NPWP" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Proposal 1</label>
                      <input type="file" name="proposal" placeholder="Proposal 1" class="form-control"required>
                    </div>
                    <div class="form-group">
                      <label>Proposal 2</label>
                      <input type="file" name="proposal2" placeholder="Proposal 2" class="form-control"required>
                    </div>
                    <div class="form-group">
                      <label>Proposal 3</label>
                      <input type="file" name="proposal3" placeholder="Proposal 3" class="form-control"required>
                    </div>
                    <div class="form-group">
                      <label> Sales </label>
                      <input type="text" name="sales" placeholder="sales" class="form-control"required>
                    </div>
                    <div class="form-group">
                      <label> Catatan </label>
                      <input type="text" name="catatan" placeholder="catatan" class="form-control"required>
                    </div>
                    <div class="form-group">
                    <label >Tanggal Update:</label>
                    <input type="date" id="tanggalupdate" name="tanggalupdate" class="form-control"required><br><br>
                    </div>
                    <div class="form-group">
                      <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                      <a href="produk.php" class="btn btn-default">Batal</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/license" class="nav-link" target="_blank">License</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrUEfoEmps6L/A6zon6TPsF5G5LsK7QV" crossorigin="anonymous"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script src="../assets/js/argon.min5438.js?v=1.2.0"></script>

</body>
</html>
