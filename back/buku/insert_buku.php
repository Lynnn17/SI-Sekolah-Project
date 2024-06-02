 
 <?php
include '../koneksi.php';
    $judul = $_POST ['judul'];
    $pengarang = $_POST ['pengarang'];
    $penerbit = $_POST ['penerbit'];
    $tahun = $_POST ['tahun'];
    $isbn = $_POST ['isbn'];
    $jumlah = $_POST ['jumlah'];
    $lokasi = $_POST ['lokasi'];

    if ($judul  == ""    or    $pengarang == ""    or    $penerbit  ==  ""  or  $tahun  == ""   
    or    $isbn == ""    or    $jumlah  ==  "" or $lokasi == "") {
    echo "Input Tidak Boleh Kosong";
} else {
    $sql = $conn->query("INSERT INTO buku(judul,pengarang,penerbit,tahun,isbn,jumlah,lokasi) VALUES 
            ('$judul','$pengarang','$penerbit','$tahun','$isbn','$jumlah','$lokasi')");
    echo "Insert Berhasil";
}
