<?php
if(isset($_GET['proposal'])) {
    // Mendapatkan nama file proposal dari parameter URL
    $proposal = $_GET['proposal'];

    // Menentukan direktori tempat file disimpan
    $fileDir = 'proposal/';  // Sesuaikan dengan nama direktori tempat file proposal disimpan

    // Membuat path lengkap ke file
    $filePath = $fileDir . $proposal;

    // Tampilkan nilai dari $filePath (untuk debugging)
    echo "Path file: $filePath <br>";

    // Memeriksa apakah file proposal tersebut ada di direktori
    if(file_exists($filePath)) {
        // Menentukan ekstensi file proposal
        $fileExt = pathinfo($proposal, PATHINFO_EXTENSION);

        // Menampilkan file berdasarkan ekstensi
        if($fileExt == 'pdf') {
            // Jika file adalah PDF, gunakan embed tag untuk menampilkan PDF
            echo "<embed src='$filePath' type='application/pdf' width='100%' height='600px' />";
        } elseif(in_array($fileExt, array('doc', 'docx', 'txt'))) {
            // Jika file adalah dokumen (doc, docx, txt), gunakan Google Docs Viewer
            echo "<iframe src='https://docs.google.com/gview?url=".urlencode($filePath)."&embedded=true' width='100%' height='600px' style='border: none;'></iframe>";
        } elseif(in_array($fileExt, array('jpg', 'jpeg', 'png', 'gif'))) {
            // Jika file adalah gambar (jpg, jpeg, png, gif), tampilkan gambar
            echo "<img src='$filePath' alt='File Proposal' style='max-width: 100%; height: auto;' />";
        } else {
            // Jika ekstensi file tidak didukung, tampilkan pesan
            echo "Jenis file tidak didukung.";
        }
    } else {
        // Jika file tidak ditemukan, tampilkan pesan dengan path yang diinginkan
        echo "File tidak ditemukan. Path: $filePath";
    }
} else {
    // Jika parameter 'proposal' tidak ada dalam URL, tampilkan pesan
    echo "Tidak ada file yang dipilih untuk ditampilkan.";
}
?>
