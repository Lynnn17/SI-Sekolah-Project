<?php 
require '../../vendor/autoload.php';  
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\IReader;

$tanggal_dibayar         =    date("Y-m-d H:i:s");
$admin         =    $_POST["admin"];

$target_dir = "../../assets/uploads/";

$nama_file  = $_FILES["file"]["name"];
$target_file = $target_dir . basename($nama_file);


$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if ($imageFileType != "xlsx") {
    echo "File Harus Berformat Excel.";
    exit();
}


if ($_FILES["file"]["size"] > 500000) {
    echo "File Anda Terlalu Besar.";
    exit();

  }
  
$new_file = $target_dir.time().".".$imageFileType;
$uploaded = move_uploaded_file($_FILES["file"]["tmp_name"], $new_file);

$reader      = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
$reader->setReadDataOnly(true);
$spreadsheet = $reader->load($new_file);
$worksheet 				= $spreadsheet->getActiveSheet();


    // Hitung Baris number
    $highestRow 			= $worksheet->getHighestRow();
    // Highest Colom Alpabhet string
    $highestColumn 			= $worksheet->getHighestColumn();
   	// Highest index colom number
    $highestColumnIndex 	= \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); 
    $kolom_str                  = array("id_siswa","nama_siswa","nama_pembayaran","total_pembayaran","total_dibayar","status");
    // array output
    $hasil                  = array();
    for ($baris=1; $baris <= $highestRow ; $baris++) { 
        if ($baris == 1) {
            continue;
        }
        $hasil_baris    = array();
        // baris
        for($kolom=1;$kolom <= $highestColumnIndex; $kolom++){
            $hasil_baris[$kolom_str[$kolom-1]] = $worksheet->getCellByColumnAndRow($kolom, $baris)->getFormattedValue();
        }
        $hasil[]    = $hasil_baris;

    }
    include '../koneksi.php';
    foreach($hasil as $h) {
        $sql = $conn->query("INSERT INTO pembayaran(id_siswa,nama_pembayaran,total_pembayaran,total_dibayar,tanggal_dibayar,status,admin) VALUES 
        (\"".$h['id_siswa']."\",\"".$h['nama_pembayaran']."\",\"".$h['total_pembayaran']."\",\"".$h['total_dibayar']."\",'$tanggal_dibayar',\"".$h['status']."\",'$admin')");
    }
        
        
    //     $sql     =    $conn->query("UPDATE pembayaran SET 
    //   total_dibayar = \"".$h['total_dibayar']."\",tanggal_dibayar = '$tanggal_dibayar',status=\"".$h['status']."\",admin='$admin' WHERE id_siswa=\"".$h['id_siswa']."\" AND nama_pembayaran = \"".$h['nama_pembayaran']."\"");
    // }
    
    unlink($new_file);
    
    echo "Import Pembayaran Berhasil";
