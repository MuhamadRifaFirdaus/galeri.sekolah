<?php
include 'koneksi.php';
session_start();

// Periksa apakah parameter ID tersedia dalam URL
if(isset($_GET['id'])) {
    // Ambil ID yang dikirimkan melalui parameter GET
    $id = $_GET['id'];
    
    // Query untuk mengambil data kategori berdasarkan ID
    $sql = "SELECT * FROM kategori WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    // Periksa apakah data kategori ditemukan
    if(mysqli_num_rows($result) > 0) {
        // Ambil data kategori
        $kategori = mysqli_fetch_assoc($result);
    } else {
        echo "Kategori tidak ditemukan.";
        exit();
    }
} else {
    echo "ID tidak ditemukan";
    exit();
}

// Proses form jika tombol submit ditekan
if(isset($_POST['submit'])) {
    // Ambil nilai judul yang dikirimkan melalui form
    $judul = $_POST['judul'];
    
    // Query untuk melakukan update data kategori
    $sql_update = "UPDATE kategori SET judul='$judul' WHERE id=$id";
    
    // Eksekusi query update
    if(mysqli_query($conn, $sql_update)) {
        // Redirect kembali ke halaman kategori setelah update berhasil
        header("Location: kategori.php");
        exit();
    } else {
        echo "Error: " . $sql_update . "<br>" . mysqli_error($conn);
    }
}

// Tutup koneksi ke database
mysqli_close($conn);
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/j.png">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include 'sidebar.php' ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'navbar.php' ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 font-weight-bold mb-0 text-gray-800">Edit Kategori</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="form-group">
                                            <label for="judul">Judul Kategori</label>
                                            <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $kategori['judul']; ?>" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="submit">Update</button>
                                        <a href="kategori.php" class="btn btn-secondary">Kembali</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
