<?php
include('koneksi.php');

?>

<!DOCTYPE html>
<html lang="en">
   <?php include('head.php');?>

   <?php

   
if( isset($_POST['findNama']) && isset($_POST['findNik'])){
   $nama = $_POST['findNama'];
   $nik = $_POST['findNik'];

   $hasil = mysqli_query($koneksi, "SELECT * FROM hasil_pemeriksaan WHERE Nama_Lengkap = '$nama'");
   $data1 = mysqli_fetch_array($hasil);
   $jumlah_hasil = mysqli_num_rows($hasil);

   $periksa = mysqli_query($koneksi, "SELECT * FROM hasil_pemeriksaan INNER JOIN pasien ON hasil_pemeriksaan.Nama_Lengkap = pasien.Nama_Pasien WHERE hasil_pemeriksaan.Nama_Lengkap = '$nama'");
   $data = mysqli_fetch_array($periksa);



   if($jumlah_hasil > 0){
      echo '<script>$(document).ready(function(){$("#myModal").modal("show"); }); </script>';

   }else{
        echo '<script>alert("Data Tidak Ditemukan"); </script>';
    }

}
   

?>


   <!-- body -->
   <body class="main-layout">
      
      <!-- top -->
                    <!-- header -->
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
   <div class="container">
     <a class="navbar-brand" href="index.php"><span>Devi</span>Lab</a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
       <span class="oi oi-menu"></span> Menu
   </button>

   <div class="collapse navbar-collapse" id="ftco-nav">
       <ul class="navbar-nav ml-auto">
         <li class="nav-item"><a href="#" class="nav-link">Beranda</a></li>
         <li class="nav-item"><a href="berita.php" class="nav-link">Berita</a></li>
         <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
     </ul>
 </div>
</div>
</nav>
      <!-- end header -->
        <div class="full_bg">
            <div class="container">
                           <div class="row">
                              <div class="col-md-8">
                                 <div class="photog">
                                    <h1>Peduli <br>Virus Corona</h1>
                                 </div>
                              </div>
                           </div>
                        </div>
         <!-- find section -->
  <section class="find_section ">
    <div class="container">
      <form method="POST"  id="myForm" > 
        <div class=" form-row">
          <div class="col-md-5">
            <input type="text" class="form-control" name="findNama" placeholder="Masukkan Nama Lengkap " required>
          </div>
          <div class="col-md-5">
            <input type="text" class="form-control" name="findNik" placeholder="Masukkan NIK " required>
          </div>
          <div class="col-md-2">
            <button type="submit" name="submit" onClick="find()" class="findButton"
            >
              Cari
            </button>
          </div>
        </div>

      </form>
    </div>
  </section>

  <!-- Detail Modal -->
            <div id="myModal" class="modal fade "  >
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title text-bold">Hasil Pemeriksaan</h2>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
						</div>
						<div class="modal-body">
                     <ul class="jss32">
                        <li>
                           <div class="jss33">Nama </div>
                           <span style="padding-right: 10px;padding-left: 22px;">:</span>
                           <div class="jss34" id="nama"><?= $data['Nama_Pasien']  ;?></div>
                        </li>
                        <li>
                           <div class="jss33">NIK </div>
                           <span style="padding-right: 10px; padding-left:40px;">:</span>
                           <div class="jss34" id="nik"><?= $data['NIK']  ;?></div>
                        </li>
                     </ul>
                     <div style="margin-top:15px ;">
                        <div class="jss38 jss39"><?= $data['Hasil_Tes']  ;?></div>
                     </div>
						</div>
					</div>
				</div>
			</div>

  <!-- end find section -->
        </div>
      <!-- end banner -->
      <!-- about -->
      <div class="about" id="tentang">
         <div class="container_width">
            <div class="row d_flex">
                   <div class="col-md-7">
                  <div class="titlepage text_align_left">
                     <h2>Mengenai Virus Corona </h2>
                     <p>Virus Corona atau severe acute respiratory syndrome coronavirus 2 (SARS-CoV-2) adalah virus yang menyerang sistem pernapasan. Penyakit akibat infeksi virus ini disebut COVID-19. Virus Corona bisa menyebabkan gangguan ringan pada sistem pernapasan, infeksi paru-paru yang berat, hingga kematian.
                     </p>
                  </div>
               </div>
               <div class="col-md-5">
                  <div class="about_img text_align_center">
                     <figure><img src="images/about.png" alt="#"/></figure>
                  </div>
               </div>
              
            </div>
         </div>
      </div>
      <!-- end about -->

      <!-- update -->
<div class="update mt-5 pt-5" id="info">
   <div class="cevery_white mt-5">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Dapatkan Info Terbaru </h2>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="cevery_bg">
      <div class="container">
         <div class="row text-center covid">
            <div class="col-md-4">
               <h1>Positif</h1>
               <p id="data-positif">1000</p>
               <p>Orang</p>
            </div>
            <div class="col-md-4">
               <h1>Meninggal</h1>
               <p id="data-meninggal">1000</p>
               <p>Orang</p>
            </div>
             <div class="col-md-4">
               <h1>Sembuh</h1>
               <p id="data-sembuh">1000</p>
               <p>Orang</p>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- update -->

     <!-- coronata -->
      <div class="coronata mt-5" id="gejala">
         <div class="container">
            <div class="row d_flex grid">
               <div class="col-md-7">
                  <div class="coronata_img text_align_center">
                     <figure><img src="images/corona.png" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-5 oder1">
                  <div class="titlepage text_align_left">
                     <h2>Apa Saja Gejala Virus Corona ?</h2>
                     <p>Orang yang terinfeksi memiliki gejala seperti demam, batuk, dan kesulitan bernafas.
Gejala dapat berkembang menjadi pneumonia berat
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end coronata -->
   
        <!-- protect -->
      <div class="protect mt-5" id="pencegahan">
         <div class="container">
            <div class="row mt-5">
               <div class="col-md-12">
                  <div class="titlepage text_align_center">
                     <h2>Cara Melindungi Diri Sendiri</h2>
                     <p>when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using  
                     </p>
                  </div>
               </div>
            </div>
         </div>
           <div class="protect_bg">
         <div class="container">
             <div class="row">
               <div class="col-md-12">
                  <!--  Demos -->
                  <div class="owl-carousel owl-theme">
                     <div class="item">
                        <div class="protect_box text_align_center">
                          <div class="desktop">
                             <i><img src="images/pro1.png" alt="#"/></i>
                           <h3> Memakai Masker</h3>
                           <span> Kenakan masker di ruang publik, terutama di dalam ruangan atau jika pembatasan fisik tidak dimungkinkan.</span>
                          </div>
                        </div>
                     </div>
                     <div class="item">
                          <div class="protect_box text_align_center">
                          <div class="desktop">
                             <i><img src="images/pro2.png" alt="#"/></i>
                           <h3>Mencuci Tangan</h3>
                           <span> Mencuci tangan sampai bersih selain dapat membunuh virus yang mungkin ada di tangan kita . </span>
                          </div>
                        </div>
                     </div>
                     <div class="item">
                         <div class="protect_box text_align_center">
                          <div class="desktop">
                             <i><img src="images/pro3.png" alt="#"/></i>
                           <h3>Tetap Dirumah</h3>
                           <span> Hindari bepergian ke luar rumah saat Anda merasa kurang sehat, terutama jika Anda merasa demam, batuk dan sulit bernapas</span>
                          </div>
                        </div>
                     </div>
                     <div class="item">
                         <div class="protect_box text_align_center">
                          <div class="desktop">
                             <i><img src="images/pro4.png" alt="#"/></i>
                           <h3>Menjaga Jarak</h3>
                           <span> Jaga jarak setidaknya 2 meter. Jika anda terlalu dekat, anda dapat menghirup droplet dari orang yang mungkin menderita COVID-19.</span>
                          </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
          </div>
      </div>
         </div>
      </div>
      <!-- end protect -->

      <!-- Harga-->
      <div class="update mt-5 pt-5" >
   <div class="cevery_white mt-5">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Info Harga Terkini </h2>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div >
         <div class="container">
            <div class="row d_flex grid">
               <div class="col-12">
                  <div class="coronata_img text_align_center mb-5">
                     <figure><img src="images/harga.jpg" alt="#"/></figure>
                  </div>
               </div>
               </div>
            </div>
         </div>
      </div>
</div>
      
      <!-- end Harga -->
    <!-- cases -->
      <div class="cases" id="kasus">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage text_align_center ">
                     <h2>Berita Terkini</h2>
                  </div>
               </div>
            </div>
            <div class="row d_flex">
               <?php
               function limit_words($string, $word_limit){
                  $words = explode(" ",$string);
                  return implode(" ",array_splice($words,0,$word_limit));
               }
                  $berita= mysqli_query($koneksi, "SELECT * FROM berita ORDER BY Id_Berita DESC LIMIT 3");
                  while($b = mysqli_fetch_array($berita)){
               ?>
               <div class=" col-md-4">
                  <div class="latest text-justify">
                     <figure><?= "<img src='images/berita/".$b['Gambar_Berita']."'style= width:auto;'>"?></figure>
                     <div class="nostrud">
                       <a href="berita-detail.php?id=<?php echo $b['Id_Berita'];?>"> <h3 class="text-center"><?= $b['Judul_Berita'];?></h3></a>
                        <p> <?php echo limit_words($b['Deskripsi_Berita'],45).' ........';?> </p>
                     </div>
                  </div>
               </div>
               <?php 
                  }
               ?>
            </div>
         </div>
      </div>
      <!-- end cases -->
         <a href="https://api.whatsapp.com/send?phone=6287882329138&text=Halo%20Kak%20Saya%20mau%20cek%20Swab%20Antigen,%20Apakah%20bisa%20dibantu?" target="blank">
		   <button class="btn-floating whatsapp">
			<img src="images/icon/whatsapp-white.png" alt="whatsapp" class="img-floating">
			<span class="text-floating">Konsultasi Disini</span>
		   </button>
	      </a>

      <!--  footer -->
      <footer>
         <div class="footer ">
            <div class="container ">
               <div class="row">
                        <div class="col-6">
                           <div class="hedingh3 ">
                             <h3>Tentang</h3>
                              <p>Devi Lab ini memberikan informasi secara real time kepada pasien yang melakukan swab antigen, dan pasien dapat menemukan informasi-informasi seputar covid di Indonesia. </p>
                           </div>
                        </div>
                       
                        <div class="col-6">
                           <div class="hedingh3  ">
                              <h3>Hubungi Kami</h3>
                                <ul class="top_infomation">
                        <li><i class="fa fa-phone" aria-hidden="true"></i>
                           Call : +821234567
                        </li>
                        <li><i class="fa fa-envelope" aria-hidden="true"></i>
                           <a href="#">Email : devilab@gmail.com</a>
                        </li>
                     </ul>
                            
                           
                     </div>
                  </div>
                    
               </div>
            </div>
            <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-8 offset-md-2">
                        <p>© 2022 Devi Lab</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script>
      // Covid js
jQuery(document).ready(function () {
  dataNegara();

  function dataNegara() {
    $.ajax({
      url: 'https://coronavirus-19-api.herokuapp.com/countries',
      success: function (data) {
        try {
          var json = data;
          var html = [];

          if (json.length > 0) {
            var i;
            for (i = 0; i < json.length; i++) {
              var dataNegara = json[i];
              var namaNegara = dataNegara.country;

              if (namaNegara === 'Indonesia') {
                var kasus = dataNegara.cases;
                var mati = dataNegara.deaths;
                var sembuh = dataNegara.recovered;

                $('#data-positif').html(kasus);
                $('#data-meninggal').html(mati);
                $('#data-sembuh').html(sembuh);
              }
            }
          }
        } catch {
          alert("Error");
        }
      },
    });
  }
});
</script>

 <script>

//    $('#myForm').on('submit', function(e){
//   $('#myModal').modal('show');
//   e.preventDefault();
// });
    </script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
      <script src="js/owl.carousel.min.js"></script>
      <script src="js/custom.js"></script>

   </body>
</html>