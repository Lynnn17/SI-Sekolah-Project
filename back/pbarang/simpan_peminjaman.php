 
 <?php
include '../koneksi.php';
    $nama_peminjam = $_POST ['nama_peminjam'];
    $tgl_pinjam = date("Y-m-d");
    $pinjam_hari = $_POST['pinjam_hari'];
    $tgl_kembali = date("Y-m-d",strtotime(" +".$pinjam_hari." days"));
    $id_barang = $_POST['id_barang'];
    $status = "Pinjam";
    $kondisi_dipinjam   =   $_POST["kondisi_dipinjam"];

    

    if ($nama_peminjam  == ""    or    $pinjam_hari == ""    or    $tgl_kembali  ==  ""  or  $id_barang  == ""   
    or    $status == "" or    $kondisi_dipinjam == "") {
    echo "Input Tidak Boleh Kosong";
}
$query=$conn->query("SELECT * FROM barang WHERE id_barang = '$id_barang'");
		while ($hasil=$query->fetch_assoc()) {
			$sisa=$hasil['jumlah'];
if ($sisa == 0) {
    echo "Stok barang telah habis";
}else {
    $sql = $conn->query("INSERT INTO pbarang(nama_peminjam,tgl_pinjam,tgl_kembali,id_barang,status,
    kondisi_dipinjam) VALUES ('$nama_peminjam','$tgl_pinjam','$tgl_kembali','$id_barang','$status',
    '$kondisi_dipinjam')");
    $min = $conn->query("UPDATE barang SET jumlah=(jumlah-1) WHERE id_barang=$id_barang ");
    echo "Insert Berhasil";
    echo $conn->error;
}
        }