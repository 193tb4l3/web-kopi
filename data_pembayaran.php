<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembayaran</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Data Pembayaran</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>WA</th>
                <th>Email</th>
                <th>Jumlah Gram Kopi</th>
                <th>Total Harga</th>
                <th>Metode Pembayaran</th>
                <th>Metode Pengiriman</th>
                <th>Tanggal Pembelian</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Buat koneksi ke database
            $host = "localhost"; // Sesuaikan dengan host Anda
            $user = "root"; // Ganti dengan username MySQL Anda
            $pass = ""; // Ganti dengan password MySQL Anda
            $dbname = "kopi_sangah"; // Nama database yang sudah dibuat
            
            $koneksi = mysqli_connect($host, $user, $pass, $dbname);

            // Periksa koneksi
            if (!$koneksi) {
                die("Koneksi gagal: " . mysqli_connect_error());
            }

            // Ambil data dari database
            $query = "SELECT * FROM pembayaran";
            $result = mysqli_query($koneksi, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nama_pelanggan'] . "</td>";
                    echo "<td>" . $row['alamat'] . "</td>";
                    echo "<td>" . $row['wa'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['jumlah_gram_kopi'] . "</td>";
                    echo "<td>Rp " . number_format($row['total_harga'], 0, ',', '.') . "</td>";
                    echo "<td>" . $row['metode_pembayaran'] . "</td>";
                    echo "<td>" . $row['metode_pengiriman'] . "</td>";
                    echo "<td>" . $row['tanggal_pembelian'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'>Tidak ada data pembayaran.</td></tr>";
            }

            // Tutup koneksi ke database
            mysqli_close($koneksi);
            ?>
        </tbody>
    </table>
</body>

</html>