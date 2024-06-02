
 <?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');
$id_pembayaran = $_POST['id_pembayaran'];
$id_siswa = $_POST['id_siswa'];
 	$nama_pembayaran = $_POST ['nama_pembayaran'];
 	$tanggal_dibayar = date("Y-m-d H:i:s");
 	$total_dibayar = $_POST ['total_dibayar'];
 	$dibayar = $_POST ['dibayar'];
     $status=$_POST['status'];
 	// $total_pembayaran = $_POST ['total_pembayaran'];

if ($id_pembayaran  ==  ""  or  $total_dibayar  == "" or  $nama_pembayaran  == "" or  $id_siswa  == ""
    or  $status  == "") {
    echo "Input Tidak Boleh Kosong";
} else {
    $sql = $conn->query("UPDATE pembayaran set tanggal_dibayar='$tanggal_dibayar', 
            total_dibayar='$total_dibayar', status='$status' where id_pembayaran='$id_pembayaran'");
    $sql2 = $conn->query("INSERT INTO pembayaranrecord set id_siswa='$id_siswa', tanggal_dibayar='$tanggal_dibayar', 
            total_dibayar='$total_dibayar',dibayar='$dibayar',nama_pembayaran='$nama_pembayaran', status='$status'");
    echo "Update Berhasil";
}
