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
$spreadsheet->getActiveSheet()->mergeCells('A1:I1');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Data Peminjaman Barang');
 
 
//Font Color
$spreadsheet->getActiveSheet()->getStyle('A2:I2')
    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
 
// Background color
    $spreadsheet->getActiveSheet()->getStyle('A2:I2')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF0000');
// $spreadsheet->getNumberFormat()->setFormatCode('#,##0.00');
$sheet->setCellValue('A2', 'No');
$sheet->setCellValue('B2', 'Nama Siswa');
$sheet->setCellValue('C2', 'Judul');
$sheet->setCellValue('D2', 'Tanggal Pinjam');
$sheet->setCellValue('E2', 'Tanggal Kembali');
$sheet->setCellValue('F2', 'Tanggal Dikembalikan');
$sheet->setCellValue('G2', 'Kondisi Dipinjam');
$sheet->setCellValue('H2', 'Kondisi Dikembalikan');
$sheet->setCellValue('I2', 'Status');

// date_default_timezone_set('Asia/Jakarta');
// $tgl_pinjam = date('Y-m-d');
$query = mysqli_query($conn,"SELECT * FROM pbarang INNER JOIN barang ON pbarang.id_barang=barang.id_barang
");
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

	$sheet->setCellValue('B'.$i, $row['nama_barang']);
	
	$sheet->setCellValue('C'.$i, $row['nama_peminjam']);
	$sheet->setCellValue('D'.$i, $row['tgl_pinjam']);	
	$sheet->setCellValue('E'.$i, $row['tgl_kembali']);	
	$sheet->setCellValue('F'.$i, $row['barang_dikembalikan']);	
	$sheet->setCellValue('G'.$i, $row['kondisi_dipinjam']);	
	$sheet->setCellValue('H'.$i, $row['kondisi_dikembalikan']);	
	$sheet->setCellValue('I'.$i, $row['status']);	
	$i++;
}
$sheet->getStyle('A:I')->getAlignment()->setHorizontal('center');
foreach(range('A','I') as $columnID) {
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

$sheet->getStyle('A2:I'.$i)->applyFromArray($styleArray);
$writer = new Xlsx($spreadsheet);
date_default_timezone_set('Asia/Jakarta');
$writer->save('../../assets/uploads/report/pinjam_barang/'.'Report Data Pinjam Barang '.date('d-m-Y').'.xlsx');
header('location:../../assets/uploads/report/pinjam_barang/'.'Report Data Pinjam Barang '.date('d-m-Y').'.xlsx');
?>

