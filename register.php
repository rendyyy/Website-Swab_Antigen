<?php
session_start();
include 'koneksi.php';
$alert = '';



if(isset($_POST['btn-daftar']))
{
 $nama = mysqli_real_escape_string($koneksi,$_POST['nama']);
 $email = mysqli_real_escape_string($koneksi,$_POST['email']);
 $password1 = mysqli_real_escape_string($koneksi,$_POST['password']);
 $password = sha1($password1);

 //cek apakah email sudah pernah digunakan
$lihat1 = mysqli_query($koneksi,"select * from user where email='$email'");
$lihat2 = mysqli_num_rows($lihat1);
 
if($lihat2 < 1){
    //email belum pernah digunakan
    $insert = mysqli_query($koneksi,"insert into user (nama_user,email,password,level) values ('$nama','$email','$password','user')");
        
        //eksekusi query
        if($insert){
            echo "<div class='text-center alert alert-success'>Berhasil mendaftar, silakan login.</div>
            <meta http-equiv='refresh' content='2; url= login.php'/>  ";
        } else {
            //daftar gagal
            die ('Gagal!' .mysqli_error($koneksi));
            echo "<div class='text-center alert alert-warning'>Gagal mendaftar, silakan coba lagi.</div>
            <meta http-equiv='refresh' content='2'>";
        }
    }
 else
    {
    //jika email sudah pernah digunakan
    $alert = '<strong><font color="red">Email sudah pernah digunakan</font></strong>';
    echo '<meta http-equiv="refresh" content="2">';
    }
 
};




?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pendaftaran Akun - Devi Lab</title>
    <link rel="icon" type="image/png" href="../images/logo_mindri.png">
    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body style="background: url(images/banner.png); background-size:cover; background-repeat:no-repeat;">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center" style="margin:100px 0">

            <div class="col-md-8">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-5">
                                    <div class="text-center">
										<h1 class="text-gray-900 mb-4"><b>PENDAFTARAN AKUN</h1>
                                    </div>
                                    <form method="post">
                                        <div class="form-group">
											<input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" autofocus required>
										</div>
										<div class="form-group">
											<input type="email" class="form-control" placeholder="Email" name="email"  required>
										</div>
										<div class="form-group">
											<input type="password" class="form-control" placeholder="Password" name="password" required>
										</div>
										<button type="submit" class="btn btn-danger btn-user btn-block" name="btn-daftar">DAFTAR</button>
                                    </form>
									<br>
                                    <div class="text-center">
										
                                        <a >Sudah Memiliki Akun ? <a href="login.php"> Klik Disini</a> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>