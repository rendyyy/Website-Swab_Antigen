<?php 
// mengaktifkan session php
session_start();
 
// menghapus semua session
session_destroy();
 
// mengalihkan halaman ke halaman Utama
echo "<script>alert('Anda telah berhasil keluar.'); window.location = 'index.php'</script>";
?>