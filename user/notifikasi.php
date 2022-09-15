<?php
include('../koneksi.php');
session_start();
 
        // cek apakah yang mengakses halaman ini sudah login
        if($_SESSION['level']==""){
        header("location:../login.php");
        }

        $email = $_SESSION['email'];
        $login = mysqli_query($koneksi,"select * from user where email='$email' ");
        $dataUser = mysqli_fetch_array($login);
        $pasien = mysqli_query($koneksi, "SELECT * FROM pasien WHERE Email_Pasien = '$email' ");
        $data = mysqli_fetch_array($pasien);
        $cek = mysqli_num_rows($pasien);
        if($cek > 0){
        $idPasien= $data['Id_Pasien'];
        $hasil = mysqli_query($koneksi, "SELECT * FROM hasil_pemeriksaan WHERE Id_Pasien = $idPasien");
        $jumlah_hasil = mysqli_num_rows($hasil);
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Devi Lab</title>
    <link rel="icon" type="image/png" href="../images/icon/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="../css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="../css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="../css/responsive.css">
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<?php include('navbar.php');?>
<div class="container bootstrap snippets bootdey">
<div class="row">
  <div class="profile-nav col-md-3">
      <div class="panel">
          <div class="user-heading round">
              <a href="#">
                  <img src="../images/user.png" alt="">
              </a>
              <h1><?= $dataUser['nama_user']  ;?></h1>
              <p><?= $dataUser['email']  ;?></p>
          </div>

          <ul class="nav nav-pills nav-stacked" style="display: block!important;">
              <li ><a href="profil.php"> <i class="fa fa-user"></i> Akun Saya</a></li>
              <li class="active"><a href="notifikasi.php"> <i class="fa fa-inbox"></i> Kotak Masuk <span class="label label-danger pull-right r-activity"><?php
              if($cek > 0){
                 echo $jumlah_hasil;} ?></span> </a></li>
              <li><a href="riwayat.php"> <i class="fa fa-file"></i> Riwayat Pemeriksaan </a></li>
          </ul>
      </div>
  </div>
  <div class="profile-info col-md-9">
      <div class="panel">
          <div class="bio-graph-heading" style="font-size: 40px;">
              Kotak Masuk
          </div>
          <div class="panel-body bio-graph-info">
              <div >
                <?php if($cek > 0){ ?>
                <?php
                    $id_pasien= $data['Id_Pasien'];
                    $data1 = mysqli_query($koneksi, "SELECT * FROM hasil_pemeriksaan WHERE Id_Pasien = $id_pasien");
                    while($d = mysqli_fetch_array($data1)){
                ?>
<ul class="responsive-table">
    <li class="table-row">
      <div class="col col-3" >Hasil Pemeriksaan</div>
      <div class="col col-2" ><?= $d['Nama_Lengkap']  ;?></div>
      <div class="col col-2" ><?= $d['No_Lab']  ;?></div>
      <div class="col col-2" ><span class="label label-danger"><?= date('d-m-Y', strtotime($d['Tgl_Pemeriksaan'] )) ;?></span>'</div>
      <div class="col col-2" >
        <?php if($d['Status'] == 'BK'){
								echo '<span class="label label-danger">Hasil Belum Keluar</span>';

                            } else{
                                echo '<span class="label label-success">Hasil Sudah Keluar</span>';
                            }
        ?>
        </div>
    </li>
  </ul>
  </ul>
    <?php 
        }
    ?>
    <?php 
        }
    ?>
              </div>
          </div>
      </div>
      
  </div>
</div>
</div>

<style type="text/css">
body {
    color: #797979;
    background: #f1f2f7;
    font-family: 'Open Sans', sans-serif;
    padding: 0px !important;
    margin: 0px !important;
    font-size: 13px;
    text-rendering: optimizeLegibility;
    -webkit-font-smoothing: antialiased;
    -moz-font-smoothing: antialiased;
}

.responsive-table li {
    border-radius: 3px;
    padding: 25px 30px;
    display: flex;
    justify-content: space-between;
    margin-bottom: 25px;
  }
  .responsive-table .table-header {
    background-color: grey;
    color: #ffffff;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.03em;
  }
  .responsive-table .table-row {
    background-color: #ffffff;
    box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);
  }
  .responsive-table .col-1 {
    flex-basis: 10%;
  }
  .responsive-table .col-2 {
    flex-basis: 40%;
  }
  .responsive-table .col-3 {
    flex-basis: 25%;
  }
  .responsive-table .col-4 {
    flex-basis: 25%;
  }
</style>


</body>
</html>