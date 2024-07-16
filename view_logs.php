<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Log</title>
</head>
<body>
    <h1>Activity Log</h1>
    <div>
        <?php
        $logFile = 'activity_log.txt'; // Lokasi file log
        $logContent = file_get_contents($logFile); // Baca isi file log
        echo nl2br(htmlspecialchars($logContent)); // Tampilkan isi log dengan pemisah baris
        ?>
    </div>
</body>
</html>
