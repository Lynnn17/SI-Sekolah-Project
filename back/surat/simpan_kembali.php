

<?php
include '../koneksi.php';

    $barang_dikembalikan = date("Y-m-d");
    $id_pbarang = $_POST['id_pbarang'];
    $id_barang = $_POST['id_barang'];
 	$status = "Kembali";
    $kondisi_dikembalikan   ="null";



if ($barang_dikembalikan  ==  ""   or  $id_pbarang  == ""    or    $status == "" or  $kondisi_dikembalikan == "") {
    echo "Input Tidak Boleh Kosong";
} else {
    $sql = $conn->query("UPDATE pbarang set barang_dikembalikan='$barang_dikembalikan', status='$status',
    kondisi_dikembalikan='$kondisi_dikembalikan' where id_pbarang='$id_pbarang'");
     $sql1 = $conn->query("UPDATE barang set jumlah=(jumlah+1)  where id_barang='$id_barang'");
    echo "Update berhasil";
}

        