<?php
include 'koneksi.php';
session_start();

if (isset($_POST['submit'])) {
    $position = $_POST['position'];
    $status = $_POST['status'];
    $post_judul = $_POST['post'];

    // Cari ID kategori berdasarkan judul kategori
    $query_post = "SELECT id FROM posts WHERE judul = ?";
    $stmt = $conn->prepare($query_post);
    $stmt->bind_param('s', $post_judul);
    $stmt->execute();
    $result_post = $stmt->get_result();
    $row_post = $result_post->fetch_assoc();
    $post_id = $row_post['id'];

    // Insert the post into the database
    $sql = "INSERT INTO galery (post_id, position, status) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $post_id, $position, $status);
    $result = $stmt->execute();

    if ($result) {
        echo "<script>alert('Galeri Berhasil di Tambahkan')</script>";
        $post_id = "";
        $position = "";
        $status = "";
        // Perbarui tabel dengan AJAX
        echo "<script>$('#tableContainer').load('galeri_table.php');</script>";
    } else {
        echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
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
                
            <?php
            include 'navbar.php'
            ?>
            
                <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 font-weight-bold mb-0 text-gray-800">Galeri</h1>
                    </div>
                </div>
                <!-- /.container-fluid -->
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">  

    <div class="card-body">
        <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary btn-md mb-3" data-toggle="modal" data-target="#galeri">
    +Tambah Galeri
    </button>
    
    <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Post</th>
                                        <th>Posisi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $hasil = mysqli_query($conn, "SELECT galery.*, posts.judul AS post_judul FROM galery 
                                    INNER JOIN posts ON galery.post_id = posts.id");
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($hasil)) :
                                    ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['post_judul']; ?></td>
                                        <td><?php echo $row['position']; ?></td>
                                        <td>                                        <?php
                                            $status = $row['status'];
                                            if ($status == '1') {
                                                echo '<span class="p-2 badge bg-success text-light" >Publish</span>';
                                            } elseif ($status == '0') {
                                                echo '<span class="p-2 badge bg-primary text-light">Draft</span>';
                                            }
                                        ?></td>
                                        <td>
                                        <a href="detail_galeri.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-md mx-2 mb-3">
                                                <i class="fas fa-circle"></i>
                                        <a href="hapus_galeri.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-md mb-3" onclick="return confirm('Apakah anda yakin ingin menghapus?')">
                                                <i class="fas fa-trash"></i>        
                                                </a>
                                        <a href="edit_galeri.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-md mx-2 mb-3">
                                                <i class="fas fa-edit"></i>
                                                </a>
                                            
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
            </div>
            <!-- End of Main Content -->


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
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
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

<!-- The Modal -->
<div class="modal" id="galeri">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah Galeri</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

                          <!-- Area Chart -->

                                
                              
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

                                <label class="m-2 font-weight-bold text-primary" name = "position">Position</label>
                                <input type="number" class="form-control bg-light border-1 small" placeholder="Masukan data" name="position" required>

                                <div class="form-group mb-2">
                                    <label class="m-2 font-weight-bold text-primary" for="status">status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="">Pilih status</option>
                                        <option value="1">Publish</option>
                                        <option value="0">Draft</option>
                                    </select>
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

</html>