<?php
include('../koneksi.php');


$query = mysqli_query($koneksi, "SELECT * FROM berita WHERE Id_Berita='$_GET[id]'");
$b  = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
   <?php include('head.php');?>
   <!-- body -->
   <body class="main-layout">
      <!-- top -->
      <!-- header -->
      <?php include('navbar.php');?>
     <!-- coronata -->
      <div class="coronata mt-5" id="gejala">
         <div class="container">
            <div class="row d_flex grid">
               <div class="col-md-12">
                  <div class="coronata_img text_align_center">
                     <figure><?= "<img src='../images/berita/".$b['Gambar_Berita']."'style= width:auto;'>"?></figure>
                  </div>
               </div>
               <div class="col-md-12 oder1">
                  <div class="titlepage ">
                     <h2 class="mt-5 pt-5"><?= $b['Judul_Berita'];?></h2>
                     <p class="mt-2 text-justify"><?= $b['Deskripsi_Berita'];?>
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end coronata -->

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
   
       
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
      <script src="js/owl.carousel.min.js"></script>
      <script src="js/custom.js"></script>

   </body>
</html>