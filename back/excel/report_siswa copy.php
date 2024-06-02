<?php
include '../koneksi.php';
error_reporting(0);
include "../../view/V_head.php";
require '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
$id_kelas = $_GET['id_kelas'];
$spreadsheet = new Spreadsheet();
$sheet =$spreadsheet->getActiveSheet();
$spreadsheet->getActiveSheet()->mergeCells('A1:C1');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Data Siswa');

 $query4 = mysqli_query($conn,"SELECT kelas.nama_kelas,angkatan.tahun_angkatan
FROM siswa
INNER JOIN kelas ON siswa.id_kelas= kelas.id_kelas
INNER JOIN angkatan ON kelas.id_angkatan = angkatan.id_angkatan
WHERE kelas.id_kelas = '$id_kelas'");
while($row4 = mysqli_fetch_assoc($query4))
{
	$sheet->setCellValue('A'.'2',"Kelas:"." ".$row4['nama_kelas']);	
	$sheet->setCellValue('A'.'3',"Tahun Angkatan:"." ".$row4['tahun_angkatan']);	
}
 
//Font Color
$spreadsheet->getActiveSheet()->getStyle('A4:C4')
    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
 
// Background color
    $spreadsheet->getActiveSheet()->getStyle('A4:C4')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF0000');
// $spreadsheet->getNumberFormat()->setFormatCode('#,##0.00');
$sheet->setCellValue('A4', 'No');
$sheet->setCellValue('B4', 'NISN');
$sheet->setCellValue('C4', 'Nama Siswa');


$query = mysqli_query($conn,"SELECT siswa.nama_siswa,siswa.nisn,kelas.nama_kelas,angkatan.tahun_angkatan FROM siswa
INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas
INNER JOIN angkatan ON kelas.id_angkatan = angkatan.id_angkatan
 WHERE siswa.id_kelas = '$id_kelas'");

$i = 5;
$no = 1;
while($row = mysqli_fetch_assoc($query))
{
	$sheet->setCellValue('A'.$i, $no++);
	$sheet->setCellValue('B'.$i, $row['nisn']);
	$sheet->setCellValue('C'.$i, $row['nama_siswa']);
	$i++;
  
}
$sheet->getStyle('A:C')->getAlignment()->setHorizontal('center');
foreach(range('A','C') as $columnID) {
    $sheet->getColumnDimension($columnID)
        ->setAutoSize(true);
}
$styleArray = [
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		];
$i = $i - 1;

$sheet->getStyle('A4:C'.$i)->applyFromArray($styleArray);
$writer = new Xlsx($spreadsheet);
date_default_timezone_set('Asia/Jakarta');
$writer->save('../../assets/uploads/report/siswa/'.'Data Siswa'.date('d-m-Y').'.xlsx');
header('location:../../assets/uploads/report/siswa/'.'Data Siswa'.date('d-m-Y').'.xlsx');
?>

<!-- <script>Swal.fire({
  title: 'Sukses!',
  icon: 'success',
  html:'Laporan berhasil dibuat!',
  focusConfirm: false,
  confirmButtonText:
    '<a style="color:white;" href="<?= BASE_URL; ?>view/buku.php?buku">Kembali</a>',
})</script> -->