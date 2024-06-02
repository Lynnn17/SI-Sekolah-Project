
 <?php
include '../koneksi.php';

    $id_buku = $_POST['id_buku'];
    $judul = $_POST ['judul'];
 	$pengarang = $_POST ['pengarang'];
 	$penerbit = $_POST ['penerbit'];
 	$tahun = $_POST ['tahun'];
 	$isbn = $_POST ['isbn'];
 	$jumlah = $_POST ['jumlah'];
 	$lokasi = $_POST ['lokasi'];

if ($id_buku  ==  ""   or  $judul  == ""    or    $pengarang == ""    or    $penerbit  ==  ""  or  $tahun  == ""   
    or    $isbn == ""    or    $jumlah  ==  "" or $lokasi == "") {
    echo "Input Tidak Boleh Kosong";
} else {
    $sql = $conn->query("UPDATE buku set judul='$judul', pengarang='$pengarang', penerbit='$penerbit', 
            tahun='$tahun', isbn='$isbn', jumlah='$jumlah', lokasi='$lokasi' where id_buku='$id_buku'");
    echo "Update Berhasil";
}
