<?php 
require '../../vendor/autoload.php';  
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\IReader;


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
    $kolom_str                  = array("kode_barang","nama_barang","jumlah","sumber");
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
        $sql = $conn->query("INSERT INTO barang(kode_barang,nama_barang,jumlah,sumber) VALUES 
        (\"".$h['kode_barang']."\",\"".$h['nama_barang']."\",\"".$h['jumlah']."\",\"".$h['sumber']."\")");
    }
    
    unlink($new_file);
    
    echo "Import Barang Berhasil";
