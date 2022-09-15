<?php
    require '../../koneksi.php';

    $idPemeriksaan = $_GET["id"];
    
    if ( hapusHasil($idPemeriksaan) > 0 ) {
      echo "    
                <script>
                    alert('Data Berhasil Dihapus!');
                    document.location.href = '../hasil.php';
                </script> 
            ";
    } else{
        echo " 
                <script>
                    alert('Data Gagal Dihapus!');
                    document.location.href = '../hasil.php';
                </script> 
            " ;
    }
?>