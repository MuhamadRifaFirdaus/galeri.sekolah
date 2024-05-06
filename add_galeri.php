<?php
include 'koneksi.php';
session_start();
if (isset($_POST['submit'])) {
    $position = $_POST['position'];
    $status = $_POST['status'];
    $post_judul = $_POST['post']; //ambil judul galr dari form

    // Cari ID galeri berdasarkan judul galeri
    $query_post = "SELECT id FROM galery WHERE judul = '$post_judul'";
    $result_post = mysqli_query($conn, $query_post);
    $row_post = mysqli_fetch_assoc($result_post);
    $post_id = $row_post['id'];

    // Unggah gambar
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Insert the post into the database
        $sql = "INSERT INTO galery (post_id, position, status, image) VALUES ('$post_id', '$position', '$status', '$target_file')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('Galeri Berhasil di Tambahkan')</script>";
            $post_id = "";
            $position = "";
            $status = "";
            
        } else {
            echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
        }
    } else {
        echo "<script>alert('Maaf, terjadi kesalahan saat mengunggah file.')</script>";
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

    <title>Tambah Galeri</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/j.png">

</head>

<body id="page-top">
    <!-- Form untuk menambahkan galeri -->
<form method="POST" action="" enctype="multipart/form-data">
    <label class="m-2 font-weight-bold text-primary">Post</label>
    <select class="form-control" name="post" id="post" required>
        <option value="">Pilih Post</option>
        <?php 
        include 'koneksi.php';
        $sql = mysqli_query($conn, "SELECT * FROM posts") or die (mysqli_error($conn));
        while ($data = mysqli_fetch_array($sql)) {
            echo '<option value="'.$data['judul'].'">'.$data['judul'].'</option>';
        } 
        ?>
    </select>

    <div class="form-group mt-3">
        <label for="image">Gambar</label>
        <input type="file" class="form-control" id="image" name="image" required>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group mb-2">
                <label for="position">Posisi</label>
                <input type="number" name="position" class="form-control" id="position"  required>
                <small>Nilai posisi harus berupa angka</small>
            </div>
        </div>
        <div class="col">
            <div class="form-group mb-2">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="">Pilih Status</option>
                    <option value="aktif">Publish</option>
                    <option value="non-aktif">Draft</option>
                </select>
            </div>
        </div>
    </div>

    <button type="submit" name="submit" id="submit" class="btn btn-primary btn-md mb-3 mt-3">Tambah data</button>
    <a href="galeri.php" class="btn btn-secondary">
        <span class="text">Kembali</span>
    </a>
</form>

    <!-- Page Wrapper -->
    <div id="wrapper">
        
    <?php
    include 'sidebar.php'
    ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                include 'navbar.php'
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 font-weight-bold mb-0 text-gray-800">Add Galery</h1>
                    </div>
                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">     
                                <!-- Card Body -->
                                <div class="card-body"> 
                                <form method="POST" action="" id="formSearch">

                                <label class="m-2 font-weight-bold text-primary">Post</label>
                                <select class="form-control" name="post" id="post" required>
                                    <option value="">Pilih Post</option>
                                    <?php 
                                    include 'koneksi.php';
                                    $sql = mysqli_query($conn, "SELECT * FROM posts") or die (mysqli_error($conn));
                                    while ($data = mysqli_fetch_array($sql)) {
                                        echo '<option value="'.$data['judul'].'">'.$data['judul'].'</option>';
                                    } 
                                    ?>
                                </select>


                                <div class="row">
                    <div class="col">
                        <div class="form-group mb-2">
                            <label for="position">Posisi</label>
                            <input type="number" name="position" class="form-control" id="position"  required>
                            <small>Nilai posisi harus berupa angka</small>
                        </div>
                        
                    </div>
                    <div class="col">
                        <div class="form-group mb-2">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <option value="aktif">Publish</option>
                                <option value="non-aktif">Draft</option>
                            </select>
                        </div>
                    </div>
                </div>

                                <button name="submit" id="submit" class="btn btn-primary btn-md mb-3 mt-3">Tambah data</button>
                                <a href="galeri.php" class="btn btn-secondary">
                                        <span class="text">Kembali</span>
                                    </a>
                                
                                </div>
                                </form>  
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

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