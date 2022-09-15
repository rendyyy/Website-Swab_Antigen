<?php

 include('../koneksi.php');
 require_once("../tcpdf/tcpdf.php");

        $tanggal = date("d-m-Y");
        $email = $_GET["email"];    
        $idHasil = $_GET["idHasil"];   
        $pasien = mysqli_query($koneksi, "SELECT * FROM pasien WHERE Email_Pasien = '$email'");
        $data = mysqli_fetch_array($pasien);
        $idPasien= $data['Id_Pasien'];
        $hasil = mysqli_query($koneksi, "SELECT * FROM hasil_pemeriksaan WHERE Id_Pasien = $idPasien and Id_Pemeriksaan = $idHasil");
        $data2 = mysqli_fetch_array($hasil);

        $tglLahir =  date('d-m-Y', strtotime($data["Tgl_Lahir"]));

        $tglPeriksa = date('d-m-Y', strtotime($data2['Tgl_Pemeriksaan']));
        

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo
		$image_file = '../images/icon/logo.png';
		$this->Image($image_file, 20, 10, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
        $this->Ln(3);
		$this->SetFont('helvetica', 'B', 20);
		// Title
		$this->Cell(0, 15, 'DEVI LAB', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(10);
        $this->SetFont('helvetica', '', 12);
        $this->Cell(0, 20, 'Jl. Cikunir Raya  Jaka Mulya, Kec. Bekasi Selatan', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	}

	
}

                    if($data2['Status'] == 'BK'){
							$status = 'Belum Keluar';
                            } else{
                            $status = 'Sudah Keluar';
                            }

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Devi Lab');
$pdf->SetTitle('Hasil Pemeriksaan '.$data['Nama_Pasien'].' '.$tglPeriksa.'');
$pdf->SetSubject('Hasil Pemeriksaan '.$data['Nama_Pasien'].' '.$tglPeriksa.'');
$pdf->SetKeywords('Pasien, Hasil, Swab , Antigen');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 12);

// add a page
$pdf->AddPage();
// set some text to print

$txt = '
<hr>
<h1 style="text-align:center; text-decoration:underline;">Surat Hasil Pemeriksaan</h1>
<div>
<table>
<br><br>
            <tr>
                <td style="width: 30%;">NIK</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;">'.$data['NIK'].'</td>
            </tr>
            <tr>
                <td style="width: 30%;">Nama</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;">'.$data['Nama_Pasien'].'</td>
            </tr>
            <tr>
                <td style="width: 30%;">Umur</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;">'.$data['Umur'].'</td>
            </tr>
            <tr>
                <td style="width: 30%;">Tanggal lahir</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;">'.$tglLahir.'</td>
            </tr>
            <tr>
                <td style="width: 30%; vertical-align: top;">Alamat</td>
                <td style="width: 5%; vertical-align: top;">:</td>
                <td style="width: 65%;">'.$data['Alamat'].'</td>
            </tr>
            <tr>
                <td style="width: 30%;">Nomor HP</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;">'.$data['No_Hp'].'</td>
            </tr>
</table>
        <br>
        <h4>Hasil Tes Swab Antigen Covid-19</h4>
        <br><br>

        <table border="1" cellpadding="2" style="text-align:center;">
        <tr style="background-color: #dedede; color: #333333; font-weight: bold; " >
            <td style="width:20%">Nama Pasien</td>
            <td style="width:20%">Nomor Lab</td>
            <td style="width:20%">Status</td>
            <td style="width:20%">Hasil Tes</td>
            <td style="width:20%">Tanggal</td>
        </tr>
        <tr >
            <td style="width:20%">'.$data2['Nama_Lengkap'].'</td>
            <td style="width:20%">'.$data2['No_Lab'].'</td>
            <td style="width:20%">'.$status.'</td>
            <td style="width:20%">'.$data2['Hasil_Tes'].'</td>
            <td style="width:20%">'.$tglPeriksa.'</td>
        </tr>
        
            
</table>


        <br><br>
        <b>Catatan :</b>
        <ul style="list-style-type:disc;">
          <li>Hasil negatif tidak menyingkirkan kemungkinan terinveksi Covid-19 sehingga masih beresiko menularkan ke orang lain.</li>
          <li>Hasil negatif terjadi pada kondisi kualitas antigen pada specimen di bawah level defeksi</li>
        </ul>

        <br><br><br><br> 
        <div></div>
        
        <div style=" text-align: right; ">Bekasi, '.$tanggal.'</div>
        <div style=" text-align: right; ">Dokter Pemeriksa,</div><br><br><br><br><br>
        <div style=" text-align: right; ">Dr. Devi Nur </div>
</div>
';

// print a block of text using Write()
$pdf->writeHTML($txt, true, false, true, false, '');



// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Hasil Pemeriksaan '.$data['Nama_Pasien'].' '.$tglPeriksa.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
