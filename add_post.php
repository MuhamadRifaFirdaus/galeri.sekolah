<?php
include 'koneksi.php';
session_start();
if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $status = $_POST['status'];
    $kategori_judul = $_POST['kategori']; // Ambil judul kategori dari form

    // Ambil ID kategori berdasarkan judul
    $query_kategori = "SELECT id FROM kategori WHERE judul = '$kategori_judul'";
    $result_kategori = mysqli_query($conn, $query_kategori);
    $row_kategori = mysqli_fetch_assoc($result_kategori);
    $kategori_id = $row_kategori['id'];

    $petugas_id = $_POST['petugas'];
    $isi = $_POST['isi'];

    // Check if the post already exists
    $sql = "SELECT * FROM posts WHERE judul = '$judul'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Woops! Judul Sudah Terdaftar.')</script>";
    } else {
        // Insert the post into the database
        $sql = "INSERT INTO posts (judul, status, kategori_id, petugas_id, isi) VALUES ('$judul', '$status', '$kategori_id', '$petugas_id', '$isi')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('Post Berhasil ditambahkan.')</script>";
            $judul = "";
            $status = "";
            $kategori_id = "";
            $petugas_id = "";
            $isi = "";
        } else {
            echo "<script>alert('Woops! Terjadi kesalahan: " . mysqli_error($conn) . "')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SMK 1 TRIPLE J</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/j.png">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include 'sidebar.php'; ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include 'navbar.php'; ?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 font-weight-bold mb-0 text-gray-800">Add Post</h1>
                    </div>
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form method="POST" action="#">
                                        <h5 class="m-2 font-weight-bold text-primary">Judul</h5>
                                        <input type="text" class="form-control bg-light border-1 small" placeholder="Masukan data" name="judul" required>
                                        <label class="m-2 font-weight-bold text-primary">Kategori</label>
                                        <select class="form-control" name="kategori" id="kategori" required>
                                            <option value="">Pilih Kategori</option>
                                            <?php 
                                            include 'koneksi.php';
                                            $sql = mysqli_query($conn, "SELECT * FROM kategori") or die (mysqli_error($conn));
                                            while ($data = mysqli_fetch_array($sql)) {
                                                echo '<option value="'.$data['judul'].'">'.$data['judul'].'</option>';
                                            } 
                                            ?>
                                        </select>
                                        <label class="m-2 font-weight-bold text-primary">Isi</label>
                                        <textarea name="isi" class="form-control" required></textarea>
                                        <label class="m-2 font-weight-bold text-primary">Petugas</label>
                                        <select class="form-control" name="petugas" id="petugas" required>
                                            <option value="">Pilih petugas</option>
                                            <?php 
                                            include 'koneksi.php';
                                            $sql = mysqli_query($conn, "SELECT * FROM petugas") or die (mysqli_error($conn));
                                            while ($data = mysqli_fetch_array($sql)) {
                                                echo '<option value="'.$data['id'].'">'.$data['username'].'</option>';
                                            } 
                                            ?>
                                        </select>
                                        <div class="form-group mb-2">
                                            <label class="m-2 font-weight-bold text-primary" for="status">Status</label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="">Pilih Status</option>
                                                <option value="publish">Publish</option>
                                                <option value="draft">Draft</option>
                                            </select>
                                        </div>
                                        <button name="submit" class="btn btn-primary btn-md mb-3 mt-3">Tambah data</button>
                                        <a href="post.php" class="btn btn-secondary">
                                            <span class="text">Kembali</span>
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->

    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
