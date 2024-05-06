<?php
$targetDirectory = "uploads/";
$targetFile = $targetDirectory . "nama_file_yang_dihapus.jpg";

if(isset($_POST["submit"])) {
    if (file_exists($targetFile)) {
        unlink($targetFile);
        echo "File berhasil dihapus.";
    } else {
        echo "Maaf, file tersebut tidak ditemukan.";
    }
}
?>