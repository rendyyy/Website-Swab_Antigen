<?php 
session_start();
 
        // cek apakah yang mengakses halaman ini sudah login
        if($_SESSION['level']==""){
        header("location:../login.php");
        }

include('../koneksi.php');

if( isset($_POST["submit"])){
    

    if ( tambahBerita ($_POST) > 0 ) {
      echo "<div class='alert alert-success text-center ' >
      Insert Data Berhasil
      </div>
      <meta http-equiv='refresh' content='2; url= berita.php'/> ";
    } else{
        echo "<div class='alert alert-danger text-center ' >
        Insert Data Gagal
        </div>
        <meta http-equiv='refresh' content='2; url= berita.php'/> ";
    }
}

if( isset($_POST["edit"])){
    

    if ( ubahBerita ($_POST) > 0 ) {
      echo "<div class='alert alert-success text-center ' >
      Update Data Berhasil
      </div>
      <meta http-equiv='refresh' content='2; url= berita.php'/> ";
    } else{
        die ('Gagal!' .mysqli_error($koneksi));
        echo "<div class='alert alert-danger text-center ' >
        Update Data Gagal
        </div>
        <meta http-equiv='refresh' content='2; url= berita.php'/> ";
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

    <title>Admin Devi Lab</title>
      <link rel="icon" type="image/png" href="../images/icon/logo.png">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include('sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <a class="btn btn-outline-danger my-2 my-sm-0"  href="" data-toggle="modal" data-target="#logoutModal" >Logout</a>


                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tabel Berita</h1>
                    <br><br>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal" >Tambah Data</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Gambar</th>
                                            <th>Judul</th>
                                            <th width="550px">Deskripsi</th>
                                            <th>Tanggal</th>
                                            <th width="170px">Aksi</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
                                    $data = mysqli_query($koneksi, "SELECT * FROM berita");
                                    while($d = mysqli_fetch_array($data)){
                                    ?>
                                        <tr>
                                            <td><?= "<img src='../images/berita/".$d['Gambar_Berita']."'style= width:150px;'>"?></td>
                                            <td><?= $d['Judul_Berita'];?></td>
                                            <td><?= $d['Deskripsi_Berita'];?></td>
                                            <td><?= $d['Tanggal'];?></td>
                                            <td>
                                            <a class="btn btn-info my-2 my-sm-0" id="ubah"  data-toggle="modal" data-target="#editModal" data-id="<?=$d['Id_Berita']; ?>" data-judul="<?=$d['Judul_Berita']; ?>" data-gambar="<?=$d['Gambar_Berita']; ?>" data-deskripsi="<?=$d['Deskripsi_Berita']; ?>" >Edit</a>
                                            <a href="hapus/hapus_berita.php?id=<?= $d['Id_Berita'] ?>" class="btn btn-danger my-2 my-sm-0" onclick="return confirm ('Apa kamu yakin ingin menghapus data tersebut ?')" >Hapus</a>
                                            </td>
                                        </tr>
                                        <?php 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <!-- Tambah Modal -->
            <div id="tambahModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Tambah Berita</h4>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
						</div>
                        
                        <form method="POST" enctype="multipart/form-data">
						<div class="modal-body">
                         
                                <div class="form-group">
									<label>Judul</label>
									<input name="judul" type="text" class="form-control" >
								</div>
                                
								<div class="form-group">
									<label>Gambar (maksimal 5 MB)</label>
									<input name="gambar" type="file" class="form-control" >
								</div>

                                <div class="form-group">
									<label>Deskripsi</label>
									<textarea class="form-control" name="deskripsi" rows="13" ></textarea>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<input type="submit" class="btn btn-primary" value="Submit" name="submit">
							</div>
						</form>
					</div>
				</div>
			</div>
            <!-- Edit Modal -->
            <div id="editModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Edit Data Berita</h4>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
						</div>
                        
                        <form method="post">
						<div class="modal-body">
                        <input type="hidden" name="id_berita" id="id_berita">  
                                <div class="form-group">
									<label>Judul</label>
									<input name="judulBerita" id="judulBerita" type="text" class="form-control" >
								</div>

                                <div class="form-group">
									<label>Deskripsi</label>
									<textarea class="form-control" name="deskripsiBerita" id="deskripsiBerita"  rows="13" ></textarea>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<input type="submit" class="btn btn-primary" value="Submit" name="edit">
							</div>
						</form>
					</div>
				</div>
			</div>
             <!-- Logout Modal-->
             <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-danger" href="../logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Admin Devi Lab</span>
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

</body>

    <!-- jquery -->
    <script src="vendor/jquery/jquery-2.2.4.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        $(document).on("click", "#ubah", function(){
            let id = $(this).data('id');
            let judul = $(this).data('judul');
            let deskripsi = $(this).data('deskripsi');

            $(".modal-body #id_berita").val(id);
            $(".modal-body #judulBerita").val(judul);
            $(".modal-body #deskripsiBerita").val(deskripsi);           

        });
    </script>

</html>