<?php
include('koneksi.php');
?>

<!DOCTYPE html>
<html lang="en">
   <?php include('head.php');?>

   <!-- body -->
   <body class="main-layout">
      <!-- top -->
      <!-- header -->
      <?php include('navbar.php');?>
      <!-- end header -->
       
    <!-- Berita -->
      <div class="cases mt-5" id="kasus">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage text_align_center ">
                     <h2>Berita Terlengkap</h2>
                  </div>
               </div>
            </div>
            <div class="row d_flex">
               <?php
               function limit_words($string, $word_limit){
                  $words = explode(" ",$string);
                  return implode(" ",array_splice($words,0,$word_limit));
               }
                  $berita= mysqli_query($koneksi, "SELECT * FROM berita");
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
      <!-- end Berita -->
         

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
     
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
      <script src="js/owl.carousel.min.js"></script>
      <script src="js/custom.js"></script>

   </body>
</html>