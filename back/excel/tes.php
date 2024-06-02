<?php
include '../koneksi.php';
error_reporting(0);
include "../../view/V_head.php";
require '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;

$spreadsheet = new Spreadsheet();
$sheet =$spreadsheet->getActiveSheet();

// $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Data Siswa');

//  $query4 = mysqli_query($conn,"SELECT kelas.nama_kelas
// FROM siswa
// INNER JOIN kelas ON siswa.id_kelas= kelas.id_kelas WHERE kelas.id_kelas = '$id_kelas'");
// while($row4 = mysqli_fetch_assoc($query4))
// {
// 	$sheet->setCellValue('A'.'2',"Kelas:"." ".$row4['nama_kelas']);	
// }
 
//Font Color
// $spreadsheet->getActiveSheet()->getStyle('A3:B3')
//     ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
 
// // Background color
//     $spreadsheet->getActiveSheet()->getStyle('A3:B3')->getFill()
//     ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
//     ->getStartColor()->setARGB('FFFF0000');
// $spreadsheet->getNumberFormat()->setFormatCode('#,##0.00');
$sheet->setCellValue('A1', 'id_siswa');
$sheet->setCellValue('B1', 'nama_siswa');
$sheet->setCellValue('C1', 'nama_kelas');
$sheet->setCellValue('D1', 'jenis_kelamin');
$sheet->setCellValue('E1', 'nama_pembayaran');
$sheet->setCellValue('F1', 'total_pembayaran');
$sheet->setCellValue('G1', 'total_dibayar');
$sheet->setCellValue('H1', 'status');

$query = mysqli_query($conn,"SELECT * FROM siswa");
$i = 2;

while($row = mysqli_fetch_assoc($query))
{
	$sheet->setCellValue('A'.$i, $row['id_siswa']);
	$sheet->setCellValue('B'.$i, $row['nama_siswa']);
	$sheet->setCellValue('C'.$i, $row['nama_kelas']);
	$sheet->setCellValue('E'.$i, $row['jenis_kelamin']);
	$i++;
}
$sheet->getStyle('A:H')->getAlignment()->setHorizontal('center');
foreach(range('A','H') as $columnID) {
    $sheet->getColumnDimension($columnID)
        ->setAutoSize(true);
}
// $styleArray = [
// 			'borders' => [
// 				'allBorders' => [
// 					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
// 				],
// 			],
// 		];
// $i = $i - 1;

// $sheet->getStyle('A3:B'.$i)->applyFromArray($styleArray);
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