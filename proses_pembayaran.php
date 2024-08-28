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

// Ambil data dari formulir
$metodePembayaran = $_POST['metode_pembayaran'];
$namaPelanggan = $_POST['nama_pelanggan'];
$alamat = $_POST['alamat'];
$wa = $_POST['wa'];
$email = $_POST['email'];
$jumlahGramKopi = $_POST['jumlah_barang'];

// Hitung total harga berdasarkan jumlah gram kopi yang dipesan
if ($jumlahGramKopi == 100) {
    $totalHarga = 15000;
} elseif ($jumlahGramKopi == 300) {
    $totalHarga = 45000;
} elseif ($jumlahGramKopi == 500) {
    $totalHarga = 75000;
} else {
    // Jika jumlah gram kopi tidak valid, beri nilai default
    $totalHarga = 0;
}

// Masukkan data ke dalam database
$query = "INSERT INTO pembayaran (nama_pelanggan, alamat, wa, email, jumlah_gram_kopi, total_harga, metode_pembayaran, metode_pengiriman, tanggal_pembelian) 
          VALUES ('$namaPelanggan', '$alamat', '$wa', '$email', '$jumlahGramKopi', '$totalHarga', '$metodePembayaran', 'COD/Tempe', CURRENT_TIMESTAMP)";

// Eksekusi query
if (mysqli_query($koneksi, $query)) {
    echo "Pembayaran berhasil. Total yang harus dibayar: Rp " . number_format($totalHarga, 0, ',', '.') . "<br>";
    echo "Terima kasih, pesanan Anda sedang diproses.";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

// Tutup koneksi ke database jika sudah selesai
mysqli_close($koneksi);
?>
