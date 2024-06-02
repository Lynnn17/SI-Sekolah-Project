 
 <?php
include '../koneksi.php';
    $id_siswa = $_POST ['id_siswa'];
    $tgl_pinjam = date("Y-m-d");
    $pinjam_hari = "3";
    $tgl_kembali = date("Y-m-d",strtotime(" +".$pinjam_hari." days"));
    $id_buku = $_POST ['id_buku'];
    $status = "Pinjam";

    

    if ($id_siswa  == ""    or    $tgl_pinjam == ""    or    $tgl_kembali  ==  ""  or  $id_buku  == ""   
    or    $status == "") {
    echo "Input Tidak Boleh Kosong";
}
$query=$conn->query("SELECT * FROM buku WHERE id_buku = '$id_buku'");
		while ($hasil=$query->fetch_assoc()) {
			$sisa=$hasil['jumlah'];
if ($sisa == 0) {
    echo "Stok buku telah habis";
}else {
    $sql = $conn->query("INSERT INTO peminjaman(id_siswa,tgl_pinjam,tgl_kembali,id_buku,status) VALUES 
            ('$id_siswa','$tgl_pinjam','$tgl_kembali','$id_buku','$status')");
    $min = $conn->query("UPDATE buku SET jumlah=(jumlah-1) WHERE id_buku=$id_buku ");
    echo "Insert Berhasil";
    echo $conn->error;
}
        }