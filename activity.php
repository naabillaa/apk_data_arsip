<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Fitur Aktivitas</title>
<style>
.activity-item {
    margin-bottom: 10px;
    padding: 10px;
    background-color: #f9f9f9;
    border: 1px solid #ccc;
}
.timestamp {
    font-size: 12px;
    color: #999;
}
</style>
</head>
<body>

<div id="activity-feed">
    <!-- Aktivitas akan ditambahkan secara real-time di sini -->
</div>

<script>
function muatAktivitas() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("activity-feed").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "ambil_aktivitas.php", true);
    xmlhttp.send();
}

// Memuat aktivitas setiap 5 detik
setInterval(function() {
    muatAktivitas();
}, 5000);
</script>

</body>
</html>
