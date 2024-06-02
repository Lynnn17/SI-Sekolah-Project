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
$spreadsheet->getActiveSheet()->mergeCells('A1:E1');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Data Barang');
 
 
//Font Color
$spreadsheet->getActiveSheet()->getStyle('A2:E2')
    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
 
// Background color
    $spreadsheet->getActiveSheet()->getStyle('A2:E2')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF0000');
// $spreadsheet->getNumberFormat()->setFormatCode('#,##0.00');
$sheet->setCellValue('A2', 'No');
$sheet->setCellValue('B2', 'Kode Barang');
$sheet->setCellValue('C2', 'Nama Barang');
$sheet->setCellValue('D2', 'Jumlah');
$sheet->setCellValue('E2', 'Sumber');

$query = mysqli_query($conn,"SELECT * FROM barang");
$i = 3;
$no = 1;
while($row = mysqli_fetch_assoc($query))
{
	$sheet->setCellValue('A'.$i, $no++);
	$val = $row['kode_barang']; // Any long numerical text.

	$rt = new RichText();
	$rt->createText($val);

	// Adding the above to a cell
	// $col = 'A'; $row = 2;
	$sheet->setCellValue('B'.$i, $rt);
	
	$sheet->setCellValue('C'.$i, $row['nama_barang']);
	$sheet->setCellValue('D'.$i, $row['jumlah']);	
	$sheet->setCellValue('E'.$i, $row['sumber']);	
	$i++;
}
$sheet->getStyle('A:E')->getAlignment()->setHorizontal('center');
foreach(range('A','E') as $columnID) {
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

$sheet->getStyle('A2:E'.$i)->applyFromArray($styleArray);
$writer = new Xlsx($spreadsheet);
date_default_timezone_set('Asia/Jakarta');
$writer->save('../../assets/uploads/report/barang/Report Data Barang '.date('d-m-Y').'.xlsx');
header('location:../../assets/uploads/report/barang/'.'Report Data Barang '.date('d-m-Y').'.xlsx');
?>

<!-- <script>Swal.fire({
  title: 'Sukses!',
  icon: 'success',
  html:'Laporan berhasil dibuat!',
  focusConfirm: false,
  confirmButtonText:
    '<a style="color:white;" href="<?= BASE_URL; ?>view/buku.php?buku">Kembali</a>',
})</script> -->