
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penjualan</title>
 
    <style>
body {
    background-color: #f0f8ff; /* biru muda */
    font-family: Arial, sans-serif;
}

.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    color: #007bff; /* biru */
}

form input[type="text"] {
    width: 300px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 10px;
}

form button {
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    background-color: #007bff; /* biru */
    color: #fff;
    cursor: pointer;
}

form button:hover {
    background-color: #0056b3; /* biru tua */
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th, table td {
    padding: 8px;
    border: 1px solid #ccc;
    text-align: left;
}

table th {
    background-color: #007bff; /* biru */
    color: #fff;
}

table tr:nth-child(even) {
    background-color: #f2f2f2;
}

a {
    color: #007bff; /* biru */
    text-decoration: none;
}

a:hover {
    color: #0056b3; /* biru tua */
}
</style>

</head>
<body>
<div class="container">
        <h2>Detail Penjualan</h2>
        <form action="" method="GET">
            <input type="text" name="search_query" placeholder="Cari yang dibutuhkan">
            <button type="submit" name="search">Search</button><br>
            <div>
                <a href="formpenjualan.php"><button type="button">Tambah Penjualan</button></a>
                <a href="detailpenjualan.php"><button type="button">Tampilkan Semua</button></a>
                <a href="menu.php"><button type="button">Kembali</button></a>
            </div>
        </form>
        <table>
            <thead><br>
                <tr>
                    <th>PenjualanID</th>
                    <th>DetailID</th>
                    <th>ProdukID</th>
                    <th>JumlahProduk</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
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
                            echo "<a href='edit_detail_penjualan.php?DetailID=".$row["DetailID"]."'>Edit</a> | ";
                            echo "<a href='delete_detail_penjualan.php?id=".$row["DetailID"]."' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data?\")'>Delete</a>";
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
            </tbody>
        </table>
    </div>
</body>
</html>