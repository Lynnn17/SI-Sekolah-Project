
 <?php
include '../koneksi.php';

    $buku_dikembalikan = date("Y-m-d");
    $id_peminjaman = $_POST ['id_peminjaman'];
    $id_buku = $_POST['id_buku'];
 	$status = $_POST['status'];
    $jumlah_denda = $_POST['jumlah_denda'];



if ($buku_dikembalikan  ==  ""   or  $id_peminjaman  == ""    or    $status == "" or $jumlah_denda == "") {
    echo "Input Tidak Boleh Kosong";
} else {
    $sql = $conn->query("UPDATE peminjaman set buku_dikembalikan='$buku_dikembalikan', status='$status' , 
    jumlah_denda='$jumlah_denda' where id_peminjaman='$id_peminjaman'");
     $sql1 = $conn->query("UPDATE buku set jumlah=(jumlah+1)  where id_buku='$id_buku'");
    echo "Update berhasil";
}

        