 
 <?php
include '../koneksi.php';
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST ['nama_barang'];
    $jumlah = $_POST ['jumlah'];
    $sumber = $_POST ['sumber'];
    $kode_barang = $_POST ['kode_barang'];

    if ($nama_barang  == ""    or    $jumlah == ""    or    $sumber  ==  ""  or $kode_barang == "") {
    echo "Input Tidak Boleh Kosong";
} else {
    $sql = $conn->query("UPDATE barang set nama_barang='$nama_barang', kode_barang='$kode_barang',
     jumlah='$jumlah', sumber='$sumber' where id_barang='$id_barang'");
echo "Update Berhasil";
}