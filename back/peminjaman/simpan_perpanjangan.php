
 <?php
include '../koneksi.php';

    $tgl_pinjam = date("Y-m-d");
    $pinjam_hari = $_POST ['pinjam_hari'];
    $kembali_tgl = $_POST ['kembali_tgl'];
    $tgl_kembali = date("Y-m-d",strtotime(" +".$pinjam_hari." days",strtotime($kembali_tgl)));
    $id_peminjaman = $_POST ['id_peminjaman'];
 	$status = "Perpanjangan";


if ($pinjam_hari  ==  ""   or    $status == "") {
    echo "Hari Tidak Boleh Kosong";
}elseif ($id_peminjaman == "") {
    echo "ID pinjam kosong";
} else {
    $sql = $conn->query("UPDATE peminjaman set tgl_kembali='$tgl_kembali', status='$status'
     where id_peminjaman='$id_peminjaman'");
    echo "Update Berhasil";
}
