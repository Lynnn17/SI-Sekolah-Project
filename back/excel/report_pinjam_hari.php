<?php
include '../koneksi.php';
error_reporting(0);
include "../../view/V_head.php";
require '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
$tgl1 = $_POST['tanggal1'];
$tgl2 = $_POST['tanggal2'];
$spreadsheet = new Spreadsheet();
$sheet =$spreadsheet->getActiveSheet();
$spreadsheet->getActiveSheet()->mergeCells('A1:H1');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Data Peminjaman Buku');
 
 
//Font Color
$spreadsheet->getActiveSheet()->getStyle('A2:H2')
    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
 
// Background color
    $spreadsheet->getActiveSheet()->getStyle('A2:H2')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF0000');
// $spreadsheet->getNumberFormat()->setFormatCode('#,##0.00');
$sheet->setCellValue('A2', 'No');
$sheet->setCellValue('B2', 'Nama Siswa');
$sheet->setCellValue('C2', 'Judul');
$sheet->setCellValue('D2', 'Tanggal Pinjam');
$sheet->setCellValue('E2', 'Tanggal Kembali');
$sheet->setCellValue('F2', 'Tanggal Dikembalikan');
$sheet->setCellValue('G2', 'Jumlah Denda');
$sheet->setCellValue('H2', 'Status');

date_default_timezone_set('Asia/Jakarta');
$tgl_pinjam = date('Y-m-d');
$query = mysqli_query($conn,"SELECT * FROM peminjaman INNER JOIN buku ON peminjaman.id_buku=buku.id_buku 
INNER JOIN siswa ON peminjaman.id_siswa=siswa.id_siswa where peminjaman.tgl_pinjam BETWEEN '$tgl1' AND '$tgl2'");
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

	$sheet->setCellValue('B'.$i, $row['nama_siswa']);
	
	$sheet->setCellValue('C'.$i, $row['judul']);
	$sheet->setCellValue('D'.$i, $row['tgl_pinjam']);	
	$sheet->setCellValue('E'.$i, $row['tgl_kembali']);	
	$sheet->setCellValue('F'.$i, $row['buku_dikembalikan']);	
	$sheet->setCellValue('G'.$i, $row['jumlah_denda']);	
	$sheet->setCellValue('H'.$i, $row['status']);	
	$i++;
}
$sheet->getStyle('A:H')->getAlignment()->setHorizontal('center');
foreach(range('A','H') as $columnID) {
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

$sheet->getStyle('A2:H'.$i)->applyFromArray($styleArray);
$writer = new Xlsx($spreadsheet);
date_default_timezone_set('Asia/Jakarta');
$writer->save('../../assets/uploads/report/pinjam_buku/'.'Report Data Pinjam Buku '.date('d-m-Y').'.xlsx');
header('location:../../assets/uploads/report/pinjam_buku/'.'Report Data Pinjam Buku '.date('d-m-Y').'.xlsx');
?>

