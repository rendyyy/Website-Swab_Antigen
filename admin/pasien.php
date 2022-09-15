<?php 
session_start();

  // cek apakah yang mengakses halaman ini sudah login
        if($_SESSION['level']==""){
        header("location:../login.php");
        }

include('../koneksi.php');

if( isset($_POST["tambah"])){
    
    if ( tambahPasien ($_POST) > 0 ) {
      echo "<div class='alert alert-success text-center ' >
      Insert Data Berhasil
      </div>
      <meta http-equiv='refresh' content='2; url= pasien.php'/> ";
    } else{
        echo "<div class='alert alert-danger text-center ' >
        Insert Data Gagal
        </div>
        <meta http-equiv='refresh' content='2; url= pasien.php'/> ";
    }
}

if( isset($_POST['editPasien'])){
    
    if ( ubahPasien ($_POST) > 0 ) {
      echo "<div class='alert alert-success text-center ' >
      Data Berhasil Diubah
      </div>
      <meta http-equiv='refresh' content='2; url= pasien.php'/> ";
    } else{
        echo "<div class='alert alert-danger text-center ' >
        Data Gagal Diubah
        </div>
        <meta http-equiv='refresh' content='2; url= pasien.php'/> ";
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
                    <h1 class="h3 mb-2 text-gray-800">Data Pasien</h1>
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
                                        <tr class="text-center">
                                            <th>ID Pasien</th>
                                            <th>Nama Pasien</th>
                                            <th>NIK</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Umur</th>
                                            <th>Alamat</th>
                                            <th>Nomor HP</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
                                    $data = mysqli_query($koneksi, "SELECT * FROM pasien");
                                    while($d = mysqli_fetch_array($data)){
                                    ?>
                                        <tr class="text-center">
                                            <td><?= $d['Id_Pasien'];?></td>
                                            <td><?= $d['Nama_Pasien'];?></td>
                                            <td><?= $d['NIK'];?></td>
                                            <td><?= $d['Tgl_Lahir'];?></td>
                                            <td><?= $d['Umur'];?></td>
                                            <td><?= $d['Alamat'];?></td>
                                            <td><?= $d['No_Hp'];?></td>
                                            <td><?= $d['Email_Pasien'];?></td>
                                            <td>
                                            <a class="btn btn-info my-2 my-sm-0 px-4" id="ubah"  data-toggle="modal" data-target="#editModal" data-id="<?=$d['Id_Pasien']; ?>" data-nama="<?=$d['Nama_Pasien']; ?>" data-nik="<?=$d['NIK']; ?>"  data-lahir="<?=$d['Tgl_Lahir']; ?>"  data-umur="<?=$d['Umur']; ?>"  data-alamat="<?=$d['Alamat']; ?>"  data-hp="<?=$d['No_Hp']; ?>" data-email="<?=$d['Email_Pasien']; ?>" >Edit</a>
                                            <a href="hapus/hapus_pasien.php?id=<?= $d['Id_Pasien'] ?>" class="btn btn-danger my-2 my-sm-0 px-3" onclick="return confirm ('Apa kamu yakin ingin menghapus data tersebut ?')" >Hapus</a>
                                            
                                            </td>
                                            
                                        </tr>
                                    </tbody>
                                    <?php 
                                    }
                                    ?>
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
							<h4 class="modal-title"> Tambah Data Pasien</h4>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
						</div>
                        
                        <form method="POST">
						<div class="modal-body">
                                <div class="form-group">
									<label>Nama Pasien</label>
									<input name="nama_pasien" type="text" class="form-control" >
								</div>
                                <div class="form-group">
									<label>NIK</label>
									<input name="nik_pasien" type="text" class="form-control" >
								</div>
                                <div class="form-group">
									<label>Tanggal Lahir</label>
									<input name="tgl_pasien" type="date" class="form-control" >
								</div>
                                <div class="form-group">
									<label>Umur</label>
									<input name="umur_pasien" type="text" class="form-control" >
								</div>
                                <div class="form-group">
									<label>Alamat</label>
									<input name="alamat_pasien" type="text" class="form-control" >
								</div>
                                <div class="form-group">
									<label>Nomor HP</label>
									<input name="no_pasien" type="text" class="form-control" >
								</div>
                                <div class="form-group">
									<label>Email</label>
									<input name="email_pasien" type="email" class="form-control" >
								</div>
                                					
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
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
							<h4 class="modal-title">Ubah Data Pasien</h4>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
						</div>
                        
                        <form method="POST">
						<div class="modal-body">
                            <input type="hidden" name="id_pasien" id="id_pasien">
                                <div class="form-group">
									<label>Nama Pasien</label>
									<input name="nama" id="nama" type="text" class="form-control" >
								</div>
                                <div class="form-group">
									<label>NIK</label>
									<input name="nik" id="nik" type="text" class="form-control" >
								</div>
                                <div class="form-group">
									<label>Tanggal Lahir</label>
									<input name="tgl"  id="tgl" type="date" class="form-control" >
								</div>
                                <div class="form-group">
									<label>Umur</label>
									<input name="umur" id="umur" type="text" class="form-control" >
								</div>
                                <div class="form-group">
									<label>Alamat</label>
									<input name="alamat" id="alamat" type="text" class="form-control" >
								</div>
                                <div class="form-group">
									<label>Nomor HP</label>
									<input name="hp" id="hp" type="text" class="form-control" >
								</div>
                                <div class="form-group">
									<label>Email</label>
									<input name="email" id="email" type="email" class="form-control" >
								</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<button type="submit" class="btn btn-primary" name="editPasien">Ubah</button>
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
            let nama = $(this).data('nama');
            let nik = $(this).data('nik');
            let lahir = $(this).data('lahir');
            let umur = $(this).data('umur');
            let alamat = $(this).data('alamat');
            let hp = $(this).data('hp');
            let email = $(this).data('email');

            $(".modal-body #id_pasien").val(id);
            $(".modal-body #nama").val(nama);
            $(".modal-body #nik").val(nik);
            $(".modal-body #tgl").val(lahir);
            $(".modal-body #umur").val(umur);
            $(".modal-body #alamat").val(alamat);
            $(".modal-body #hp").val(hp);
            $(".modal-body #email").val(email);

        });
    </script>

</html>