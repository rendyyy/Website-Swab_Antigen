<?php
    require '../../koneksi.php';

    $idPasien = $_GET["id"];
    
    if ( hapusPasien($idPasien) > 0 ) {
      echo "    
                <script>
                    alert('Data Berhasil Dihapus!');
                    document.location.href = '../pasien.php';
                </script> 
            ";
    } else{
        echo " 
                <script>
                    alert('Data Gagal Dihapus!');
                    document.location.href = '../pasien.php';
                </script> 
            " ;
    }
?>