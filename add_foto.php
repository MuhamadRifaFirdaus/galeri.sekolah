<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

// Pastikan koneksi ke database telah dibuat
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data yang dikirim melalui formulir
    $galery_id = $_POST['galery_id']; // Pastikan bahwa input dengan nama 'gallery_id' telah diberikan dalam formulir HTML
    $judul = $_POST['judul'];

    // Tangkap data file yang diunggah
    $file_name = $_FILES['file']['name']; // Perhatikan bahwa nama input file adalah 'file'
    $file_tmp = $_FILES['file']['tmp_name'];

    // Simpan file ke direktori tertentu
    $upload_dir = "/admin/img/"; // Ganti dengan direktori yang sesuai
    move_uploaded_file($file_tmp, $upload_dir . $file_name);

    // Simpan data ke dalam tabel database
    $query = "INSERT INTO foto (galery_id, file, judul) VALUES ('$galery_id', '$file', '$judul')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Jika data berhasil disimpan, arahkan pengguna kembali ke halaman sebelumnya
        header("Location: detail_galeri.php");
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>