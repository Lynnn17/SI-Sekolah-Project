
 <?php
include '../koneksi.php';

    $tgl_pinjam = date("Y-m-d");
    $pinjam_hari = $_POST ['pinjam_hari'];
    $tgl_kembali = date("Y-m-d",strtotime(" +".$pinjam_hari." days"));
    $id_pbarang = $_POST ['id_pbarang'];
 	$status = "Perpanjangan";

if ($pinjam_hari  ==  ""   or    $status == "") {
    echo "Hari Tidak Boleh Kosong";
}elseif ($id_pbarang == "") {
    echo "ID pinjam kosong";
} else {
    $sql = $conn->query("UPDATE pbarang set tgl_kembali='$tgl_kembali', status='$status'
     where id_pbarang='$id_pbarang'");
    echo "Update Berhasil";
}
