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
$id_angkatan = $_POST['angkatan'];
$nama_pembayaran = $_POST['bayar'];
$spreadsheet = new Spreadsheet();
$sheet =$spreadsheet->getActiveSheet();
$spreadsheet->getActiveSheet()->mergeCells('A1:J1');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Data Pembayaran '.$tgl1.'-'.$tgl2);

$query4 = mysqli_query($conn,"SELECT angkatan.tahun_angkatan
FROM pembayaranrecord
INNER JOIN siswa ON pembayaranrecord.id_siswa = siswa.id_siswa
INNER JOIN kelas ON siswa.id_kelas= kelas.id_kelas 
INNER JOIN angkatan ON kelas.id_angkatan= angkatan.id_angkatan 
WHERE angkatan.id_angkatan = '$id_angkatan' AND pembayaranrecord.nama_pembayaran LIKE '$nama_pembayaran' AND pembayaranrecord.tanggal_dibayar BETWEEN '$tgl1' AND '$tgl2'");
while($row4 = mysqli_fetch_assoc($query4))
{
	$sheet->setCellValue('A'.'2',"Tahun Angkatan:"." ".$row4['tahun_angkatan']);	
}

$query3 = mysqli_query($conn,"SELECT SUM(pembayaranrecord.dibayar) AS bayar
FROM pembayaranrecord
INNER JOIN siswa ON pembayaranrecord.id_siswa = siswa.id_siswa
INNER JOIN kelas ON siswa.id_kelas= kelas.id_kelas 
INNER JOIN angkatan ON kelas.id_angkatan= angkatan.id_angkatan
WHERE angkatan.id_angkatan = '$id_angkatan'  AND pembayaranrecord.nama_pembayaran LIKE '$nama_pembayaran' AND pembayaranrecord.tanggal_dibayar BETWEEN '$tgl1' AND '$tgl2'");
while($row3 = mysqli_fetch_assoc($query3))
{
	$sheet->setCellValue('A'.'3',"Total:"."Rp".number_format($row3['bayar']));	
}
 
//Font Color
$spreadsheet->getActiveSheet()->getStyle('A4:J4')
    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
 
// Background color
    $spreadsheet->getActiveSheet()->getStyle('A4:J4')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF0000');
// $spreadsheet->getNumberFormat()->setFormatCode('#,##0.00');
$sheet->setCellValue('A4', 'No');
$sheet->setCellValue('B4', 'Kelas');
$sheet->setCellValue('C4', 'Nama Siswa');
$sheet->setCellValue('D4', 'Nama Pembayaran');
$sheet->setCellValue('E4', 'Membayar');
$sheet->setCellValue('F4', 'Total Membayar');
$sheet->setCellValue('G4', 'Sisa');
$sheet->setCellValue('H4', 'Total Pembayaran');
$sheet->setCellValue('I4', 'Tanggal Membayar');
$sheet->setCellValue('J4', 'Status');

date_default_timezone_set('Asia/Jakarta');

$query = mysqli_query($conn,"SELECT pembayaranrecord.nama_pembayaran,
siswa.nama_siswa,kelas.nama_kelas,pembayaranrecord.status,pembayaran.total_pembayaran,pembayaranrecord.tanggal_dibayar,
pembayaranrecord.total_dibayar,pembayaranrecord.dibayar,pembayaranrecord.admin
FROM pembayaranrecord
INNER JOIN pembayaran ON pembayaranrecord.id_pembayaran = pembayaran.id_pembayaran
INNER JOIN siswa ON pembayaranrecord.id_siswa = siswa.id_siswa
INNER JOIN kelas ON siswa.id_kelas= kelas.id_kelas
INNER JOIN angkatan ON kelas.id_angkatan= angkatan.id_angkatan
WHERE angkatan.id_angkatan = '$id_angkatan'  AND pembayaranrecord.nama_pembayaran LIKE '$nama_pembayaran' AND pembayaranrecord.tanggal_dibayar BETWEEN '$tgl1' AND '$tgl2'");
$i = 5;
$no = 1;
while($row = mysqli_fetch_assoc($query))
{
	$sisa=$row['total_pembayaran'] - $row['dibayar'];
	$sheet->setCellValue('A'.$i, $no++);
	$sheet->setCellValue('B'.$i, $row['nama_kelas']);
	$sheet->setCellValue('C'.$i, $row['nama_siswa']);
	$sheet->setCellValue('D'.$i, $row['nama_pembayaran']);	
	$sheet->setCellValue('E'.$i, "Rp".number_format($row['dibayar']));	
	$sheet->setCellValue('F'.$i, "Rp".number_format($row['total_dibayar']));
	$sheet->setCellValue('G'.$i, "Rp".number_format($sisa));	
	$sheet->setCellValue('H'.$i, "Rp".number_format($row['total_pembayaran']));	
	$sheet->setCellValue('I'.$i, $row['tanggal_dibayar']);	
	$sheet->setCellValue('J'.$i, $row['status']);
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
$sheet->getStyle('A:J')->getAlignment()->setHorizontal('center');
foreach(range('A','J') as $columnID) {
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

$sheet->getStyle('A4:J'.$i)->applyFromArray($styleArray);
$writer = new Xlsx($spreadsheet);
date_default_timezone_set('Asia/Jakarta');
$writer->save('../../assets/uploads/report/pembayaran/'.'Report Data Pembayaran'.date('d-m-Y').'.xlsx');
header('location:../../assets/uploads/report/pembayaran/'.'Report Data Pembayaran'.date('d-m-Y').'.xlsx');
?>

