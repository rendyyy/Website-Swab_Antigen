<?php
    require '../../koneksi.php';

    $idUser = $_GET["id"];
    
    if ( hapusPengguna($idUser) > 0 ) {
      echo "    
                <script>
                    alert('Data Berhasil Dihapus!');
                    document.location.href = '../pengguna.php';
                </script> 
            ";
    } else{
        echo " 
                <script>
                    alert('Data Gagal Dihapus!');
                    document.location.href = '../pengguna.php';
                </script> 
            " ;
    }
?>