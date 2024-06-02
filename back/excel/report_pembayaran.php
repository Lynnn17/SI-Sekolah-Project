<?php
include '../koneksi.php';
error_reporting(0);
include "../../view/V_head.php";
require '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
date_default_timezone_set('Asia/Jakarta');
$tgl1 = date($_POST['tanggal1']." 1:00:00");
$tgl2 = date($_POST['tanggal2']." 23:00:00");
$tgla1 = date($_POST['tanggal1']);
$tgla2 = date($_POST['tanggal2']);
$id_kelas = $_POST['kelas'];
$nama_pembayaran = $_POST['bayar'];
$spreadsheet = new Spreadsheet();
$sheet =$spreadsheet->getActiveSheet();
$spreadsheet->getActiveSheet()->mergeCells('A1:I1');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Data Pembayaran Per Kelas '.$tgla1.' sampai '.$tgla2);

$query4 = mysqli_query($conn,"SELECT kelas.nama_kelas
FROM pembayaran
INNER JOIN siswa ON pembayaran.id_siswa = siswa.id_siswa
INNER JOIN kelas ON siswa.id_kelas= kelas.id_kelas WHERE kelas.id_kelas = '$id_kelas' AND pembayaran.nama_pembayaran LIKE '$nama_pembayaran' AND pembayaran.tanggal_dibayar BETWEEN '$tgl1' AND '$tgl2'");
while($row4 = mysqli_fetch_assoc($query4))
{
	$sheet->setCellValue('A'.'2',"Kelas:"." ".$row4['nama_kelas']);	
}

$query3 = mysqli_query($conn,"SELECT SUM(pembayaran.total_dibayar) AS bayar
FROM pembayaran
INNER JOIN siswa ON pembayaran.id_siswa = siswa.id_siswa
INNER JOIN kelas ON siswa.id_kelas= kelas.id_kelas WHERE kelas.id_kelas = '$id_kelas' AND pembayaran.nama_pembayaran LIKE '$nama_pembayaran' AND pembayaran.tanggal_dibayar BETWEEN '$tgl1' AND '$tgl2'");
while($row3 = mysqli_fetch_assoc($query3))
{
	$sheet->setCellValue('A'.'3',"Total:"."Rp".number_format($row3['bayar']));	
}
 
//Font Color
$spreadsheet->getActiveSheet()->getStyle('A4:I4')
    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
 
// Background color
    $spreadsheet->getActiveSheet()->getStyle('A4:I4')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF0000');
// $spreadsheet->getNumberFormat()->setFormatCode('#,##0.00');
$sheet->setCellValue('A4', 'No');
$sheet->setCellValue('B4', 'Nama Siswa');
$sheet->setCellValue('C4', 'Nama Pembayaran');
$sheet->setCellValue('D4', 'Total Pembayaran');
$sheet->setCellValue('E4', 'Total Membayar');
$sheet->setCellValue('F4', 'Sisa');
$sheet->setCellValue('G4', 'Tanggal Terakhir Dibayar');
$sheet->setCellValue('H4', 'Status');
$sheet->setCellValue('I4', 'Admin');



$query = mysqli_query($conn,"SELECT pembayaran.id_pembayaran,pembayaran.nama_pembayaran,
siswa.nama_siswa,kelas.nama_kelas,pembayaran.status,pembayaran.total_pembayaran,pembayaran.tanggal_dibayar,
pembayaran.total_dibayar,pembayaran.admin
FROM pembayaran
INNER JOIN siswa ON pembayaran.id_siswa = siswa.id_siswa
INNER JOIN kelas ON siswa.id_kelas= kelas.id_kelas WHERE kelas.id_kelas = '$id_kelas' AND pembayaran.nama_pembayaran LIKE '$nama_pembayaran' AND pembayaran.tanggal_dibayar BETWEEN '$tgl1' AND '$tgl2'");
$i = 5;
$no = 1;
while($row = mysqli_fetch_assoc($query))
{
	$sisa=$row['total_pembayaran'] - $row['total_dibayar'];
	$sheet->setCellValue('A'.$i, $no++);
	$sheet->setCellValue('B'.$i, $row['nama_siswa']);
	$sheet->setCellValue('C'.$i, $row['nama_pembayaran']);
	$sheet->setCellValue('D'.$i, "Rp".number_format($row['total_pembayaran']));	
	$sheet->setCellValue('E'.$i, "Rp".number_format($row['total_dibayar']));	
	$sheet->setCellValue('F'.$i, "Rp".number_format($sisa));	
	$sheet->setCellValue('G'.$i, $row['tanggal_dibayar']);	
	$sheet->setCellValue('H'.$i, $row['status']);	
	$sheet->setCellValue('I'.$i, $row['admin']);	
	$i++;
}
// $query2 = mysqli_query($conn,"SELECT SUM(pembayaran.total_dibayar) AS bayar
// FROM pembayaran
// INNER JOIN siswa ON pembayaran.id_siswa = siswa.id_siswa
// INNER JOIN kelas ON siswa.id_kelas= kelas.id_kelas WHERE kelas.id_kelas = '$id_kelas' AND pembayaran.nama_pembayaran LIKE '$nama_pembayaran' AND pembayaran.tanggal_dibayar BETWEEN '$tgl1' AND '$tgl2'");
// while($row2 = mysqli_fetch_assoc($query2))
// {
// 	$sheet->setCellValue('H'.'39',"Total:"."Rp".number_format($row2['bayar']));	
// }
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

$sheet->getStyle('A4:I'.$i)->applyFromArray($styleArray);
$writer = new Xlsx($spreadsheet);
$writer->save('../../assets/uploads/report/pembayaran/'.'Report Data Pembayaran Per Kelas '.date('d-m-Y').'.xlsx');
header('location:../../assets/uploads/report/pembayaran/'.'Report Data Pembayaran Per Kelas '.date('d-m-Y').'.xlsx');
?>

