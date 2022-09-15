<?php
include('koneksi.php');
 
$nama = $_POST['findNama'];
$nik = $_POST['findNik'];
 
$sql = "SELECT * FROM pasien INNER JOIN hasil_pemeriksaan ON pasien.id_pasien = hasil_pemeriksaan.id_pasien where Nama_Pasien= '{$nama}' AND NIK = '{$nik}'";
$result = mysqli_query($conn,$sql);
while( $row = mysqli_fetch_array($result) ){
?>
<ul class="jss32">
                        <li>
                           <div class="jss33">Nama </div>
                           <span style="padding-right: 10px;">:</span>
                           <div class="jss34" id="nama"><?php echo $row['Nama_Pasien']; ?></div>
                        </li>
                        <li>
                           <div class="jss33">NIK </div>
                           <span style="padding-right: 10px; padding-left:20px;">:</span>
                           <div class="jss34" id="nik"><?php echo $row['NIK']; ?></div>
                        </li>
                     </ul>
                    <div style="margin-top:15px ;">
                        <div class="jss38 jss39"><?php echo $row['Hasil_Tes']; ?></div>
                     </div>
<?php } ?>