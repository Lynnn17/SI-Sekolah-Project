<?php
error_reporting(0);
session_start();
$koneksi = new mysqli("localhost","root","","esemkasari");
// $tgl1 = $_POST['tanggal1'];
// $tgl2 = $_POST['tanggal2'];
date_default_timezone_set('Asia/Jakarta');
$tanggalan = date('d-m-Y');
$id_siswa = $_GET['siswa'];
$content ='

<style type="text/css">
	
	.tabel{text-align:center;border-collapse: collapse;font-size:12px;}
	.tabel th{padding: 1px 1px;  background-color:  #cccccc;  }
	.tabel td{padding: 1px 1px;  }
	.total {margin-left:40px;}
</style>


';


 $content .= '
<page>';
$sl = $koneksi->query("SELECT * FROM siswa WHERE id_siswa = '$id_siswa'");
	while ($tampil3=$sl->fetch_assoc()) {
$content .='
<h3>BUKTI PEMBAYARAN SMK NEGERI PURWOSARI</h3>
<h5>Nama Siswa: '.$tampil3['nama_siswa'].'</h5>
<h5>Tanggal: '.$tanggalan.'</h5>';
}
$content .= '

<table border="1px" class="tabel"  >
<tr>
<th>No</th>
<th>Nama Pembayaran</th>
<th>Bayar</th>
<th>Total Dibayar</th>
<th>Status</th>

</tr>';
	$tanggal1 = date('Y-m-d 1:00:00');
$tanggal2 = date('Y-m-d 23:00:00');
	$no = 1;
	$sql = $koneksi->query("SELECT pembayaran.nama_pembayaran,siswa.nama_siswa, pembayaranrecord.tanggal_dibayar,pembayaranrecord.dibayar,
        pembayaranrecord.total_dibayar,pembayaranrecord.status FROM pembayaranrecord INNER JOIN pembayaran ON 
        pembayaran.id_pembayaran=pembayaranrecord.id_pembayaran INNER JOIN siswa ON siswa.id_siswa = pembayaranrecord.id_siswa
        WHERE pembayaranrecord.id_siswa = '$id_siswa' AND pembayaranrecord.tanggal_dibayar BETWEEN '$tanggal1' AND '$tanggal2'");
	while ($tampil=$sql->fetch_assoc()) {

	$content .='
		<tr>
			<td align="center">'.$no++.'</td>
			<td align="center">'.$tampil['nama_pembayaran'].'</td>
			<td align="center">Rp.'.number_format($tampil['dibayar']).'</td>
			<td align="center">Rp.'.number_format($tampil['total_dibayar']).'</td>
			<td align="center">'.$tampil['status'].'</td>
		</tr>
		
	';
	
}


$content .='


</table>
';
$sq = $koneksi->query("SELECT SUM(dibayar)
         FROM pembayaranrecord WHERE id_siswa = '$id_siswa' AND tanggal_dibayar BETWEEN '$tanggal1' AND '$tanggal2'");
	while ($tampil2=$sq->fetch_assoc()) {
$content .='<h5 style="margin-left:40px;">Total:Rp.'.number_format($tampil2['SUM(dibayar)']).'</h5>';
}
// $adm = $koneksi->query("SELECT * FROM useriuran WHERE id_user = 1");
// 	while ($tampil4=$adm->fetch_assoc()) {
$content .='<h5 style="margin-left:40px;">Admin:'.$_SESSION['nama_user'].'</h5>
</page>';
// }
require_once('../../assets/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('P','A6','fr');
$html2pdf->WriteHTML($content);
$html2pdf->Output('Kwitansi'.date('d-m-Y H:i:s').'.pdf');
?>
