<?php
// Panggil file koneksi.php untuk melakukan koneksi ke database
include 'koneksi.php';

// Cek apakah parameter ID tersedia dalam URL
if(isset($_GET['id'])) {
    // Ambil ID yang dikirimkan melalui parameter GET
    $id = $_GET['id'];
    
    // Query untuk menghapus data dari tabel "petugas"
    $sql = "DELETE FROM kategori WHERE id = $id";
    
    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman sebelumnya setelah penghapusan berhasil
        header("Location: kategori.php");
        exit(); // Hentikan eksekusi skrip setelah melakukan redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "ID tidak ditemukan";
}

// Tutup koneksi
$conn->close();
?>
