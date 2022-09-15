<?php 
$koneksi = mysqli_connect("localhost","root","","app_swabantigen");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

function query ($query){
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambahHasil($data){
    global $koneksi;
    
    $pasien = $data["id_pasien"];
    $nama = $data["nama_pasien"];
	$lab = $data["nomor_lab"];
	$status = $data["status_pasien"];
    $periksa = $data["tgl_periksa"];


    $query ="INSERT INTO hasil_pemeriksaan (Id_Pasien, Nama_Lengkap, No_Lab, Status, Tgl_Pemeriksaan)
	VALUES ('$pasien', '$nama', '$lab', '$status', '$periksa') ";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}
function tambahPasien($data){
    global $koneksi;
    
    $nama = $data["nama_pasien"];
    $nik = $data["nik_pasien"];
	$tgl = $data["tgl_pasien"];
	$umur = $data["umur_pasien"];
	$alamat = $data["alamat_pasien"];
	$nomor = $data["no_pasien"];
	$email = $data["email_pasien"];


    $query ="INSERT INTO pasien (Nama_Pasien, NIK, Tgl_Lahir, Umur, Alamat, No_Hp, Email_Pasien)
	VALUES ('$nama', '$nik', '$tgl', '$umur', '$alamat', '$nomor', '$email' ) ";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function tambahPengguna($data){
    global $koneksi;
    
    $nama = $data["nama_user"];
    $email = $data["email_user"];
	$password = $data["password_user"];
	$level = $data["level_user"];



    $query ="INSERT INTO user (Nama_user, email, password, level)
	VALUES ('$nama', '$email', '$password', '$level') ";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function hapusHasil($idPemeriksaan){
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM hasil_pemeriksaan WHERE id_pemeriksaan = $idPemeriksaan");
    return mysqli_affected_rows($koneksi);
}
function hapusPasien($idPasien){
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM pasien WHERE Id_Pasien = $idPasien");
    return mysqli_affected_rows($koneksi);
}
function hapusPengguna($idUser){
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM user WHERE Id_user = $idUser");
    return mysqli_affected_rows($koneksi);
}

function ubahHasil($data){
    global $koneksi;
    
    $id = $data["id_pemeriksaan"];
    $pasien = $data["idpasien"];
    $nama = $data["nama"];
	$lab = $data["lab"];
	$status = $data["status"];
	$hasil = $data["hasil"];
    $periksa = $data["periksa"];

    
    $query = "UPDATE hasil_pemeriksaan SET 
                Id_Pasien = '$pasien',
                Nama_Lengkap = '$nama',
                No_Lab = '$lab',
                Status = '$status',
                Hasil_Tes = '$hasil',
                Tgl_Pemeriksaan = '$periksa'
                WHERE Id_Pemeriksaan = $id ";
    mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
    return mysqli_affected_rows($koneksi);
}
function ubahData($data){
    global $koneksi;
    
	$id =  $data["id_pasien"];
	$alamat = $data["alamat"];
	$nomor = $data["hp"];
	$email = $data["email"];
    
    $query = "UPDATE pasien SET 
				Alamat = '$alamat' ,
				No_Hp = '$nomor', 
				Email_Pasien = '$email' 
                WHERE Id_Pasien = $id ";
    mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
    return mysqli_affected_rows($koneksi);
}

function ubahPasien($data){
    global $koneksi;
    
	$id =  $data["id_pasien"];
    $nama = $data["nama"];
    $nik = $data["nik"];
	$tgl = $data["tgl"];
	$umur = $data["umur"];
	$alamat = $data["alamat"];
	$nomor = $data["hp"];
	$email = $data["email"];
    
    $query = "UPDATE pasien SET 
                Nama_Pasien = '$nama',
				NIK	= '$nik',
				Tgl_Lahir = '$tgl'  ,
				Umur = '$umur' ,
				Alamat = '$alamat' ,
				No_Hp = '$nomor', 
				Email_Pasien = '$email' 
                WHERE Id_Pasien = $id ";
    mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
    return mysqli_affected_rows($koneksi);
}

function ubahPengguna($data){
    global $koneksi;
    
    $id =  $data["id_user"];
	$nama = $data["nama"];
    $email = $data["email"];
	$password1 = $data["password"];

    $password = sha1($password1);
    
    $query = "UPDATE user SET 
                Nama_user = '$nama',
				email	= '$email',
				password = '$password'   
                WHERE Id_user = $id ";
    mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
    return mysqli_affected_rows($koneksi);
}


function tambahBerita($data){
    global $koneksi;
    
    $judul = $data["judul"];
    $deskripsi = $data["deskripsi"];
    $tanggal = date("Y-m-d");


    // Upload Gambar
    $gambar = uploadBerita(); 
    if(!$gambar){
        return false;
    }


    $query ="INSERT INTO berita (Judul_Berita, Gambar_Berita, Deskripsi_Berita, Tanggal)  VALUES ( '$judul', '$gambar', '$deskripsi', '$tanggal') ";
    mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
    return mysqli_affected_rows($koneksi);
}

function ubahBerita($data){
    global $koneksi;
    
    $id = $data["id_berita"];
    $judul = $data["judulBerita"];
    $deskripsi = $data["deskripsiBerita"];
    $tanggal = date("Y-m-d");

    
    $query = "UPDATE berita SET 
                Judul_Berita = '$judul',
                Deskripsi_Berita = '$deskripsi',
                Tanggal = '$tanggal'
                WHERE Id_Berita = $id ";
    mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
    return mysqli_affected_rows($koneksi);
}

function uploadBerita(){

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName= $_FILES['gambar']['tmp_name'];

    // cek ada gambar atau tidak
    if ($error === 4){
        echo "<script>
                alert('Masukkan Gambar terlebih dahulu');
            </script>";
        return false;
    }

    // cek yang diupload adalah gambar
    $extensiGambar = ['jpg', 'jpeg', 'png'];
    $x = explode('.',$namaFile); 
    $extensi = strtolower(end($x));

    if (!in_array($extensi, $extensiGambar)){
        echo "<script>
                alert('Yang anda upload bukan gambar');
            </script>";
        return false;
    }

    // Cek ukuran gambar
    if( $ukuranFile > 5000000){
        echo "<script>
                alert('Ukuran gambar terlalu besar');
            </script>";
        return false;
    }

    // upload gambar ke direktori
    move_uploaded_file($tmpName, '../images/berita/'. $namaFile);

    return $namaFile;
}

function hapusBerita($idBerita){
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM berita WHERE Id_Berita = $idBerita");
    return mysqli_affected_rows($koneksi);
}
 
?>