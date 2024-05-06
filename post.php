<?php 
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
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

                <!-- Topbar -->
                <?php
                include 'navbar.php'
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 font-weight-bold mb-0 text-gray-800">Post</h1>
                    </div>

                    <!-- Content Row -->
<div class="card">
    <div class="card-body">
    <div class="mb-3">
        <a href="add_post.php" class="btn btn-primary">+Post</a>
    </div>
        
        <table class="table">
            <tr>
                <th>No</th>
                <th>judul</th>
                <th>kategori</th>
                <th>petugas</th>
                <th>status</th>
                <th>Aksi</th>
            </tr>
            
            <?php 
		include 'koneksi.php';
		$no = 1;
		$data = mysqli_query($conn, "SELECT posts.*, kategori.judul AS nama_kategori, petugas.username AS nama_petugas FROM posts JOIN kategori ON posts.kategori_id = kategori.id JOIN petugas ON posts.petugas_id = petugas.id");
                    while($d = mysqli_fetch_array($data)){
            
			?>
            <tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $d['judul']; ?></td>
				<td><?php echo $d['nama_kategori'] ?></td>
				<td><?php echo $d['nama_petugas']; ?></td>
                <td>
    <?php
    $status = $d['status'];
    if ($status == 'publish') {
        echo '<span class="badge bg-primary text-white">Publish</span>';
    } elseif ($status == 'draft') {
        echo '<span class="badge bg-warning text-white">Draft</span>';
    }
    ?>
</td>


                <td class="d-flex">
                <a href="#" class="btn btn-primary btn-md mb-3 mr-2" data-toggle="modal" data-target="#modalView<?php echo $d['id'];?>"><i class="fa fa-info" aria-hidden="true"></i>
            </a>
        <!-- Modal detail post-->
                <div class="modal fade" id="modalView<?php echo $d['id'];?>" tabindex="-1" aria-labelledby="modalViewLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
    <h5 class="modal-title" id="modalViewLabel"> <i class="fas fa-info-circle"></i> Detail Post</h5>
</div>

                        <div class="modal-body">
                           <table class="table text-sm">
                                <tr>
                                    <td>Judul</td>
                                    <td>:</td>
                                    <td> <?php echo $d['judul']; ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal dibuat</td>
                                    <td>:</td>
                                    <td> <?php echo $d['created_at']; ?></td>
                                </tr>
                                <tr>
                                    <td>dibuat oleh</td>
                                    <td>:</td>
                                    <td><?php echo $d['nama_petugas']; ?></td>
                                </tr>
                                <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>
                                    <?php
                                    $status = $d['status'];
                                    $badge_class = '';
                                    $status_text = '';

                                    if ($status == 'publish') {
                                        $badge_class = 'badge bg-primary text-white';
                                        $status_text = 'Publish';
                                    } elseif ($status == 'draft') {
                                        $badge_class = 'badge bg-warning text-white';
                                        $status_text = 'Draft';
                                    }
                                    ?>
                                    <span class="<?php echo $badge_class; ?>"><?php echo $status_text; ?></span>
                                </td>
                            </tr>
                                <tr>
                                    <td>Kategori</td>
                                    <td>:</td>
                                    <td> <?php echo $d['nama_kategori'] ?></td>
                                </tr>
                                <tr>
                                    <td>Isi</td>
                                    <td>:</td>
                                    <td><?php echo $d['isi']; ?></td>
                                </tr>
                           </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">Close</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <a href="edit_post.php?id=<?php echo $d['id']; ?>" class="btn btn-warning btn-md mb-3 mr-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                        
                    <a href="hapus_post.php?id=<?php echo $d['id']; ?>" class="btn btn-danger btn-md mb-3" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');"><i class="fas fa-trash"></i></a>
                    
            </tr>
            <?php 
		}
		?>
        </table>
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