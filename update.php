<?php
$targetDirectory = "uploads/";
$targetFile = $targetDirectory . basename($_FILES["fileToChange"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
    if (!file_exists($targetFile)) {
        echo "Maaf, file tersebut tidak ditemukan.";
        $uploadOk = 0;
    }
}

if ($_FILES["fileToChange"]["size"] > 500000) {
    echo "Maaf, ukuran file terlalu besar.";
    $uploadOk = 0;
}

if (!in_array($imageFileType, array("jpg", "png", "jpeg", "gif"))) {
    echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Maaf, file tidak diunggah.";
} else {
    if (move_uploaded_file($_FILES["fileToChange"]["tmp_name"], $targetFile)) {
        echo "File ". basename( $_FILES["fileToChange"]["name"]). " berhasil diunggah.";
    } else {
        echo "Maaf, terjadi kesalahan saat mengunggah file.";
    }
}
?>