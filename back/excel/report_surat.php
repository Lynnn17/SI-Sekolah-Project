<?php
include '../koneksi.php';
error_reporting(0);
include "../../view/V_head.php";
require '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
$tgl1 = date($_POST['tanggal1']." 1:00:00");
$tgl2 = date($_POST['tanggal2']." 23:00:00");
$spreadsheet = new Spreadsheet();
$sheet =$spreadsheet->getActiveSheet();
$spreadsheet->getActiveSheet()->mergeCells('A1:G1');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Data Surat '.$_POST['tanggal1'].' sampai '.$_POST['tanggal2']);
 
 
//Font Color
$spreadsheet->getActiveSheet()->getStyle('A2:G2')
    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
 
// Background color
    $spreadsheet->getActiveSheet()->getStyle('A2:G2')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF0000');
// $spreadsheet->getNumberFormat()->setFormatCode('#,##0.00');
$sheet->setCellValue('A2', 'No');
$sheet->setCellValue('B2', 'Nomer Surat');
$sheet->setCellValue('C2', 'Nama Surat');
$sheet->setCellValue('D2', 'Jenis Surat');
$sheet->setCellValue('E2', 'Diperuntukkan');
$sheet->setCellValue('F2', 'Tanggal');
$sheet->setCellValue('G2', 'Admin');


date_default_timezone_set('Asia/Jakarta');
$tgl_pinjam = date('Y-m-d');
$query = mysqli_query($conn,"SELECT * FROM surat where tanggal  BETWEEN '$tgl1' AND '$tgl2'");
$i = 3;
$no = 1;
while($row = mysqli_fetch_assoc($query))
{
	$sheet->setCellValue('A'.$i, $no++);
	// $val = $row['isbn']; // Any long numerical text.

	// $rt = new RichText();
	// $rt->createText($val);

	// Adding the above to a cawaitell
	// $col = 'A'; $row = 2;

	$sheet->setCellValue('B'.$i, $row['no_surat']);
	
	$sheet->setCellValue('C'.$i, $row['nama_surat']);
	$sheet->setCellValue('D'.$i, $row['jenis_surat']);	
	$sheet->setCellValue('E'.$i, $row['diperuntukkan']);	
	$sheet->setCellValue('F'.$i, $row['tanggal']);	
	$sheet->setCellValue('G'.$i, $row['admin']);		
	$i++;
}
$sheet->getStyle('A:G')->getAlignment()->setHorizontal('center');
foreach(range('A','G') as $columnID) {
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

$sheet->getStyle('A2:G'.$i)->applyFromArray($styleArray);
$writer = new Xlsx($spreadsheet);
date_default_timezone_set('Asia/Jakarta');
$writer->save('../../assets/uploads/report/surat/'.'Report Data Surat '.date('d-m-Y').'.xlsx');
header('location:../../assets/uploads/report/surat/'.'Report Data Surat '.date('d-m-Y').'.xlsx');
?>

