
 <?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');
$id_surat      =   $_POST['id_surat'];
$no_surat      =   $_POST['no_surat'];
$nama_surat      =   $_POST['nama_surat'];
$jenis_surat          =   $_POST['jenis_surat'];
$diperuntukkan          =   $_POST['diperuntukkan'];
$tanggal         =    date("Y-m-d H:i:s");
$admin       =   $_POST['admin'];

$foto = $_FILES['file']['name'];
    $ext = pathinfo($foto, PATHINFO_EXTENSION);
    // if($ext != 'jpeg' or $ext != 'png' or $ext != 'pdf'){
    //     echo "File Harus berformat jpg/png/pdf";
    //     exit;
    // }
    $filename = date('dmyhis').'.'.$ext;
    $lokasi = $_FILES['file']['tmp_name'];
    $folder = "../../assets/uploads/surat/";
    $upload = move_uploaded_file($lokasi, $folder.$filename);

$oldfilename    =   $_POST['fileedit'];
$folder = "../../assets/uploads/surat";

if ($admin  ==  ""  or  $no_surat  == "" or  $jenis_surat  == "" or  $nama_surat  == ""
or  $filename  == "" or  $diperuntukkan  == "") {
    echo "Input Tidak Boleh Kosong";
} else {
    $sql = $conn->query("UPDATE surat set no_surat='$no_surat',nama_surat='$nama_surat',jenis_surat='$jenis_surat',
     file='$filename',diperuntukkan = '$diperuntukkan', tanggal='$tanggal',admin ='$admin' where id_surat='$id_surat'");
     echo "Update Berhasil";
     unlink($folder.$oldfilename);
}
