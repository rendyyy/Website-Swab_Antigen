<?php
include('koneksi.php');

if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			 echo "<div class='alert alert-danger text-center ' >
        Email dan password tidak sesuai
        </div>
        <meta http-equiv='refresh' content='2; url= login.php'/> ";
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

    <title>Login Akun - Devi Lab</title>
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
        <div class="row justify-content-center " style="margin:100px 0">

            <div class="col-md-7">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row" >
                          
                            <div class="col-md-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class=" text-gray-900 mb-4"><b>LOGIN</b></h1>
                                    </div>
                                    <form action="cek_login.php" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                name="email"
                                                placeholder="Masukkan Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                            name="password" placeholder="Masukkan Password">
                                        </div>
                                        
                                        <button type="submit" class="btn btn-danger btn-user btn-block" >Masuk</button>
                                    </form>
                                    <br>
                                    <div class="text-center">
                                        <a >Belum Memiliki Akun ? <a href="register.php"> Klik Disini</a> </a>
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
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin/js/sb-admin-2.min.js"></script>

</body>

</html>