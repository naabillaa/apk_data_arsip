<?php
// Mulai session
session_start();

// Include file konfigurasi database
include "config.php";

// Cek apakah $_SESSION['username'] sudah di-set (user sudah login)
if (isset($_SESSION['username'])) {
    // Query untuk mengambil log aktivitas untuk user saat ini
    $select_logs = "SELECT * FROM activity_log WHERE username = '{$_SESSION['username']}' ORDER BY timestamp DESC";
    $result_logs = mysqli_query($conn, $select_logs);

    // Periksa apakah query berhasil
    // if ($result_logs) {
    //     echo "<h4>Activity Log</h4>";
    //     echo "<ul>";
        // Loop hasil query dan tampilkan entri log aktivitas
//         while ($row = mysqli_fetch_assoc($result_logs)) {
//             echo "<li>{$row['activity_description']} - {$row['timestamp']}</li>";
//         }
//         echo "</ul>";
//     } else {
//         echo "Error retrieving activity logs: " . mysqli_error($conn);
//     }
// } else {
    // Handle case where $_SESSION['username'] is not set (user is not logged in)
    // echo "User is not logged in.";
}
?>


<html><head><meta http-equiv="content-type" content="text/html;charset=utf-8"><!-- /Added by HTTrack -->

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
<meta name="author" content="Creative Tim">
<title>Argon Dashboard - Free Dashboard for Bootstrap 4</title>


<link rel="canonical" href="https://www.creative-tim.com/product/argon-dashboard">

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
<meta property="og:title" content="Argon - Free Dashboard for Bootstrap 4 by Creative Tim">
<meta property="og:type" content="article">
<meta property="og:url" content="https://demos.creative-tim.com/argon-dashboard/index.html">
<meta property="og:image" content="../../../s3.amazonaws.com/creativetim_bucket/products/96/original/opt_ad_thumbnail.jpg">
<meta property="og:description" content="Start your development with a Dashboard for Bootstrap 4.">
<meta property="og:site_name" content="Creative Tim">

<link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">

<link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
<link rel="stylesheet" href="../assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css" type="text/css">


<link rel="stylesheet" href="../assets/css/argon.min5438.css?v=1.2.0" type="text/css">
<style>
  
  .input-group .btn {
    display: block;
    width: 100%;
    height: 50%;
    padding: 15px 20px;
    text-align: center;
    border: none;
    background: #2207BA;
    outline: none;
    border-radius: 30px;
    font-size: 1.2rem;
    color: #FFF;
    cursor: pointer;
    transition: .3s;
}
.small-card {
    max-width: 200px; /* Set maximum width for the card */
    height: auto; /* Let the height adjust based on content */
    transition: transform 0.3s ease-in-out; /* Add transition for smooth hover effect */
}

.small-card:hover {
    transform: scale(1.05); /* Increase scale on hover */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add box shadow on hover */
}

.small-card .card-body {
    padding: 1rem; /* Add padding to the card body */
}


 
.input-group .btn:hover {
    transform: translateY(-5px);
    background: #e75c5c;
}
</style>

<script async="" src="../../../connect.facebook.net/en_US/fbevents.js"></script><script async="" src="../../../www.googletagmanager.com/gtm5445.html?id=GTM-NKDMSK6"></script><script async="" src="../../../connect.facebook.net/en_US/fbevents.js"></script><script async="" src="../../../www.googletagmanager.com/gtm5445.html?id=GTM-NKDMSK6"></script><script>
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
<body class="g-sidenav-show g-sidenav-pinned" style="min-height: 100vh;">

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>


<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
<div class="sidenav-header  align-items-center">
<a class="navbar-brand" href="javascript:void(0)">
<span style="font-weight: bold; font-size: 30px; color: #5e72e4;">Felice Area</span>
</a>
</div>
  <div class="navbar-inner">
  
  <div class="collapse navbar-collapse" id="sidenav-collapse-main">
  
  <ul class="navbar-nav">
  <li class="nav-item">
  <a class="nav-link active" href="index.php ">
  <i class="ni ni-tv-2 text-primary"></i>
  <span class="nav-link-text">Dashboard</span>
  </a>
  </li>

  
  <li class="nav-item">
  <a class="nav-link" href="produk.php">
  <i class="ni ni-bullet-list-67 text-default"></i>
  <span class="nav-link-text">Data Pelanggan</span>
  </a>
  </li>
  <li class="nav-item">
  <a class="nav-link" href="supplier.php">
  <i class="ni ni-bullet-list-67 text-default"></i>
  <span class="nav-link-text">Data Supplier</span>
  </a>
  </li>
  <!-- <li class="nav-item">
      <a class="nav-link" href="detaill.php">
      <i class="ni ni-bullet-list-67 text-default"></i>
      <span class="nav-link-text">Data Produk Pelanggan</span>
      </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="datapenjualan.php">
          <i class="ni ni-bullet-list-67 text-default"></i>
          <span class="nav-link-text">Data Produk</span>
          </a>
          </li> -->
      <br>
  
  </ul>
  </div>
  </div>
  </div><div class="scroll-element scroll-x"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar" style="width: 0px;"></div></div></div><div class="scroll-element scroll-y"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar" style="height: 0px;"></div></div></div></div><div class="scroll-element scroll-x"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar" style="width: 0px;"></div></div></div><div class="scroll-element scroll-y"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar" style="height: 0px;"></div></div></div></div>
  </nav>
<div class="main-content" id="panel">

  <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom" style="background-color: #d81a1a;">
    <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
    <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
    <div class="form-group mb-0">
    <div class="input-group input-group-alternative input-group-merge">
    <div class="input-group-prepend">
    <span class="input-group-text"><i class="fas fa-search"></i></span>
    </div>
    <input class="form-control" placeholder="Search" type="text">
    </div>
    </div>
    <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
    <span aria-hidden="true">×</span>
    </button>
    </form>
    
    <ul class="navbar-nav align-items-center  ml-md-auto ">
    <li class="nav-item d-xl-none">
    
    <div class="pr-3 sidenav-toggler sidenav-toggler-dark active" data-action="sidenav-pin" data-target="#sidenav-main">
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
    <!-- <i class="ni ni-user-run"></i>
    <span>Logout</span>
    </a>
     -->
    </div>
    </div>
    </nav>
    

<div class="header bg-primary pb-6">
<div class="container-fluid">
<div class="header-body">
<div class="row align-items-center py-4">
<div class="col-lg-6 col-7">
<h6 class="h2 text-white d-inline-block mb-0">Default</h6>
<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
<ol class="breadcrumb breadcrumb-links breadcrumb-dark">
<li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="#">Dashboards</a></li>
<li class="breadcrumb-item active" aria-current="page">Default</li>
</ol>
</nav>
</div>
<!-- <div class="col-lg-6 col-5 text-right">
<a href="#" class="btn btn-sm btn-neutral">New</a>
<a href="#" class="btn btn-sm btn-neutral">Filters</a>
</div> -->
</div>
<div class="container-logout">
        <form action="logout.php" method="POST" class="login-email">
           <center> <h1 class="text-white d-inline-block">Hello, Felice Employee!</h1></center>
           
        </form>
        
  </div><br>
<?php
include "config.php";

// Lakukan query SQL untuk menghitung jumlah data dalam tabel
$sql = "SELECT COUNT(*) AS total FROM pelanggan";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data dari setiap baris
    while($row = $result->fetch_assoc()) {
        $total_data = $row["total"];
    }
} else {
    $total_data = 0;
}
$sql = "SELECT COUNT(*) AS total FROM supplier";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data dari setiap baris
    while($row = $result->fetch_assoc()) {
        $total_data1 = $row["total"];
    }
} else {
    $total_data1 = 0;
}
// Tutup koneksi
$conn->close();
?>
<div class="row">
<div class="col-xl-3 col-md-6"><a href="produk.php">
<div class="card card-stats">

<div class="card-body">
<div class="row">
<div class="col">
<h5 class="card-title text-uppercase text-muted mb-0">DATA PELANGGAN</h5>
<span class="h2 font-weight-bold mb-0"><?php echo $total_data; ?></span>
</div>
<div class="col-auto">
<div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
  <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
</svg></div>
</div>
</div>
<p class="mt-3 mb-0 text-sm">
</p>
</div>
</div>
</div></a>
<div class="col-xl-3 col-md-6"><a href="supplier.php">
<div class="card card-stats">

<div class="card-body">
<div class="row">
<div class="col">
<h5 class="card-title text-uppercase text-muted mb-0">Data <br>Supplier</h5>
<span class="h2 font-weight-bold mb-0"><?php echo $total_data1; ?></span>
</div>
<div class="col-auto">
<div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
<i class="ni ni-chart-pie-35"></i>
</div>
</div>
</div>

</div>
</div>
</div></a>
<div class="col-xl-3 col-md-6"><a href="supplier.php">
<div class="card card-stats">

<div class="card-body">
<div class="row">
<div class="col">
<h5 class="card-title text-uppercase text-muted mb-0">Data Produk<br>Pelanggan</h5>
<span class="h2 font-weight-bold mb-0"><?php echo $total_data1; ?></span>
</div>
<div class="col-auto">
<div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003zM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z"/>
</svg>
</div>
</div>
</div>

</div>
</div>
</div></a><div class="col-xl-3 col-md-6"><a href="supplier.php">
<div class="card card-stats">

<div class="card-body">
<div class="row">
<div class="col">
<h5 class="card-title text-uppercase text-muted mb-0">Data Produk<br>Supplier</h5>
<span class="h2 font-weight-bold mb-0"><?php echo $total_data1; ?></span>
</div>
<div class="col-auto">
<div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box2-fill" viewBox="0 0 16 16">
  <path d="M3.75 0a1 1 0 0 0-.8.4L.1 4.2a.5.5 0 0 0-.1.3V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.5a.5.5 0 0 0-.1-.3L13.05.4a1 1 0 0 0-.8-.4zM15 4.667V5H1v-.333L1.5 4h6V1h1v3h6z"/>
</svg>
</div>
</div>
</div>

</div>
</div>
</div></a>
<div class="col-xl-8">
    <div class="card">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Aktivitas Pengguna</h3>
                </div>
                <div class="col text-right">
                </div>
                <div class="col text-right">

</div>
</div>
</div>
<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">Activity</th>
                <th scope="col">Timestamp</th>
            </tr>
        </thead>
        <tbody>
        <?php
        include "config.php"; // Include your database connection

        // Fetch activity logs for the logged-in user from the database
        $select_logs = "SELECT * FROM activity_log WHERE username = '{$_SESSION['username']}' ORDER BY timestamp DESC";
        $result_logs = mysqli_query($conn, $select_logs);

        // Check if there are logs available
        if ($result_logs && mysqli_num_rows($result_logs) > 0) {
            while ($row = mysqli_fetch_assoc($result_logs)) {
                echo "<tr>";
                echo "<td>";
                if ($row['activity_type'] == 'Login') {
                    echo "<span style='color: green;'>{$row['activity_description']}</span>";
                } elseif ($row['activity_type'] == 'Logout') {
                    echo "<span style='color: red;'>{$row['activity_description']}</span>";
                } else {
                    echo "{$row['activity_description']}";
                }
                echo "</td>";
                echo "<td>{$row['timestamp']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No activity logs found.</td></tr>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
        </tbody>
    </table>
</div>

<script>
document.getElementById('clear-all-btn').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default link behavior

    // Confirmation dialog before clearing logs
    if (confirm('Are you sure you want to clear all activity logs?')) {
        // Perform AJAX request or redirect to PHP script to clear logs
        // Example AJAX request:
        /*
        fetch('clear_logs.php', {
            method: 'POST',
            body: JSON.stringify({ username: '<?php echo $_SESSION['username']; ?>' })
        })
        .then(response => response.json())
        .then(data => {
            // Handle response, e.g., reload the page or update UI
            window.location.reload(); // Reload the page to reflect changes
        })
        .catch(error => {
            console.error('Error clearing logs:', error);
        });
        */

        // For demonstration, reloading the page
        window.location.href = 'clear_logs.php'; // Replace with your PHP script URL
    }
});
</script>

              
    </div>
</div>

<div class="col-xl-3 col-md-6">
<div class="card card-stats">







<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/js-cookie/js.cookie.js"></script>
<script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>

<script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>

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
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=111649226022273&amp;ev=PageView&amp;noscript=1">
  </noscript>
<script defer="" src="https://static.cloudflareinsights.com/beacon.min.js/v84a3a4012de94ce1a686ba8c167c359c1696973893317" integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA==" data-cf-beacon="{&quot;rayId&quot;:&quot;859dcc910dd15fa3&quot;,&quot;b&quot;:1,&quot;version&quot;:&quot;2024.2.1&quot;,&quot;token&quot;:&quot;1b7cbb72744b40c580f8633c6b62637e&quot;}" crossorigin="anonymous"></script>



</div></div></div></div><div class="backdrop d-xl-none" data-action="sidenav-unpin" data-target="undefined"></div><div style="left: -1000px; overflow: scroll; position: absolute; top: -1000px; border: none; box-sizing: content-box; height: 200px; margin: 0px; padding: 0px; width: 200px;"><div style="border: none; box-sizing: content-box; height: 200px; margin: 0px; padding: 0px; width: 200px;"></div></div><div class="backdrop d-xl-none" data-action="sidenav-unpin" data-target="undefined"></div><div style="left: -1000px; overflow: scroll; position: absolute; top: -1000px; border: none; box-sizing: content-box; height: 200px; margin: 0px; padding: 0px; width: 200px;"><div style="border: none; box-sizing: content-box; height: 200px; margin: 0px; padding: 0px; width: 200px;"></div></div></body><!-- Mirrored from demos.creative-tim.com/argon-dashboard-bs4/examples/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Feb 2024 07:36:58 GMT --></html>