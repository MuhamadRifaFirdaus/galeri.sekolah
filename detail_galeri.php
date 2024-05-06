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
    $upload_dir = "img/"; // Ganti dengan direktori yang sesuai
    move_uploaded_file($file_tmp, $upload_dir . $file_name);

    // Simpan data ke dalam tabel database
    $query = "INSERT INTO foto (galery_id, file, judul) VALUES ('$galery_id', '$file_name', '$judul')";
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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link rel="shortcut icon" href="img/j.png">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

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
                        <h1 class="h3 font-weight-bold mb-0 text-gray-800">Add Post</h1>
                    </div>
                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">     
                                <!-- Card Body -->
                                <div class="card-body">
                                <?php 
                        include 'koneksi.php';
                            // Pastikan $_GET['id'] memiliki nilai
                        if(isset($_GET['id'])) 
                     $id = $_GET['id'];
                  $query = "SELECT galery_sekolah.*, posts.judul AS nama_posts, posts.created_at AS created_at FROM galery JOIN posts ON galery.post_id = posts.id WHERE galery.id = '$id'";
                          $data = mysqli_query($conn, $query);
                     if(mysqli_num_rows($data) > 0) {
                                            $d = mysqli_fetch_array($data);
                                            $post_id = $d['post_id'];
                                            $position = $d['position'];
                                            $status = $d['status'];
                                            // Lanjutkan ke bagian tampilan
                                ?>
                                <table class="table">
                                    
                                    <tr>
                                        <td>Judul Post</td>
                                        <td>:</td>
                                        <td><?php echo $d['nama_posts']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Posisi</td>
                                        <td>:</td>
                                        <td><?php echo $d['position']; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Status</td>
                                        <td>:</td>
                                        <td>
                                        <?php
                                            $status = $d['status'];
                                            if ($status == '1') {
                                                echo '<span class="p-2 badge bg-success text-light" >Publish</span>';
                                            } elseif ($status == '0') {
                                                echo '<span class="p-2 badge bg-primary text-light">Draft</span>';
                                            }
                                        ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Dibuat Pada</td>
                                        <td>:</td>
                                        <td><?php echo $d['created_at']; ?></td>
                                    </tr>

                                <?php 
                                    }
                                ?>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                    <h4 class="m-0 p-0"><i data-feather="image"></i>Foto</h4>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#foto">
                                        + Foto
                                    </button>
                                </div>

                                <?php
$datafoto = mysqli_query($conn, "SELECT * FROM foto order by galery_id DESC");
while ($row = mysqli_fetch_array($datafoto)) {
?>
<div class="col-md-12 row mb-5">
    <div class="col-md-3">
        <img src="uploads/<?php echo $row['file'] ?>" class="img-thumbnail" alt="<?php echo $row ?>">
        <!-- Tombol hapus -->
        <form action="hapus_foto.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button type="submit" class="btn btn-danger mt-2">Hapus</button>
        </form>
    </div>
</div>?>
<?php } ?>

                        <!-- The Modal -->
                        <div class="modal" id="foto">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Upload Foto</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <form action="add_foto.php" method="POST" enctype="multipart/form-data" class="modal-content">
                            <div class="modal-body text-secondary">
    <input type="hidden" name="galery_id" value="<?php echo $d['galery_id']; ?>">
        <div class="mb-3">
            <label for="file">Foto</label>
            <input type="file" class="form-control" id="file" name="file" required>
        </div>
        <div class="mb-3">
            <label for="title">Judul</label>
            <input type="text" class="form-control" id="title" name="judul" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
    </div>
    
</form>

                            </div>
                        </div>
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
                        <span>SMK 1 TRIPLE J</span>
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

    <script>
        // Panggil modal saat tombol ditekan
        document.getElementById('addImageButton').addEventListener('click', function() {
            $('#addImageModal').modal('show');
        });
    </script>

</body>

</html>