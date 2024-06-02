 
 <?php
include '../koneksi.php';
    $nama_barang = $_POST ['nama_barang'];
    $jumlah = $_POST ['jumlah'];
    $sumber = $_POST ['sumber'];
    $kode_barang = $_POST ['kode_barang'];

    if ($nama_barang  == ""    or    $jumlah == ""    or    $sumber  ==  ""  or $kode_barang == "") {
    echo "Input Tidak Boleh Kosong";
} else {
    $sql = $conn->query("INSERT INTO barang(nama_barang,jumlah,sumber,kode_barang) VALUES 
            ('$nama_barang','$jumlah','$sumber','$kode_barang')");
    echo "Insert Berhasil";
}
