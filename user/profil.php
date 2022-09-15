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

if( isset($_POST['edit'])){
    
    if ( ubahData ($_POST) > 0 ) {
      echo "<div class='alert alert-success text-center ' >
      Data Berhasil Diubah
      </div>
      <meta http-equiv='refresh' content='1; url= profil.php'/> ";
    } else{
        echo "<div class='alert alert-danger text-center ' >
        Data Gagal Diubah
        </div>
        <meta http-equiv='refresh' content='1; url= profil.php'/> ";
    }
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
              <li class="active"><a href="profil.php"> <i class="fa fa-user"></i> Akun Saya</a></li>
              <li><a href="notifikasi.php"> <i class="fa fa-inbox"></i> Kotak Masuk <span class="label label-danger pull-right r-activity"><?php
              if($cek > 0){
                 echo $jumlah_hasil;} ?></span> </a></li>
              <li><a href="riwayat.php"> <i class="fa fa-file"></i> Riwayat Pemeriksaan </a></li>
          </ul>
      </div>
  </div>
  <div class="profile-info col-md-9">
      <div class="panel">
          <div class="bio-graph-heading" style="font-size: 40px;">
              Data Diri
          </div>
          <div class="panel-body bio-graph-info">
            <?php if($cek > 0){ ?>
              <div class="row">
                  <div class="bio-row">
                      <p><span>Nama</span>: <?= $data['Nama_Pasien']  ;?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>NIK </span>: <?= $data['NIK']  ;?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Tanggal Lahir </span>: <?= date('d-m-Y', strtotime($data["Tgl_Lahir"]))  ;?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Umur</span>: <?= $data['Umur']  ;?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Alamat </span>: <?= $data['Alamat']  ;?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Nomor HP </span>: <?= $data['No_Hp']  ;?></p>
                  </div>
              </div>
          </div>
            
          <?php } ?> 
      </div>
      <?php
                        $data1 = mysqli_query($koneksi, "SELECT * FROM pasien WHERE Email_Pasien = '$email'");
                        while($d = mysqli_fetch_array($data1)){
                        ?>
                            <a class="btn btn-primary my-2 my-sm-0 px-4 text-white" style="font-size:16px ;"  id="ubah"  data-toggle="modal" data-target="#editModal" data-id="<?=$d['Id_Pasien']; ?>" data-nama="<?=$d['Nama_Pasien']; ?>" data-nik="<?=$d['NIK']; ?>"  data-lahir="<?=$d['Tgl_Lahir']; ?>"  data-umur="<?=$d['Umur']; ?>"  data-alamat="<?=$d['Alamat']; ?>"  data-hp="<?=$d['No_Hp']; ?>" data-email="<?=$d['Email_Pasien']; ?>" >Ubah Data</a>
                    <?php 
                        }
                    ?>
  </div>
</div>
</div>

<!-- Edit Modal -->
            <div id="editModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Ubah Data </h4>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
						</div>
                        
                        <form method="POST">
						<div class="modal-body">
                            <input type="hidden" name="id_pasien" id="id_pasien">
                                <div class="form-group">
									<label>Nama </label>
									<input name="nama" id="nama" type="text" class="form-control" disabled>
								</div>
                                <div class="form-group">
									<label>NIK</label>
									<input name="nik" id="nik" type="text" class="form-control" disabled >
								</div>
                                <div class="form-group">
									<label>Tanggal Lahir</label>
									<input name="tgl"  id="tgl" type="date" class="form-control" disabled>
								</div>
                                <div class="form-group">
									<label>Umur</label>
									<input name="umur" id="umur" type="text" class="form-control" disabled>
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
								<button type="submit" class="btn btn-primary" name="edit">Ubah</button>
							</div>
						</form>
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

</style>


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
        <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="../js/jquery.min.js"></script>
      <script src="../js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
      <script src="../js/owl.carousel.min.js"></script>
      <script src="../js/custom.js"></script>
</body>
</html>