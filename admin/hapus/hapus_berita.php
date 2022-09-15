<?php
    require '../../koneksi.php';

    $idBerita = $_GET["id"];
    
    if ( hapusBerita($idBerita) > 0 ) {
      echo "    
                <script>
                    alert('Data Berhasil Dihapus!');
                    document.location.href = '../berita.php';
                </script> 
            ";
    } else{
        echo " 
                <script>
                    alert('Data Gagal Dihapus!');
                    document.location.href = '../berita.php';
                </script> 
            " ;
    }
?>