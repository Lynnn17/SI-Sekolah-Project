<?php
error_reporting(0);
include '../koneksi.php';
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
$id_angkatan = $_POST['angkatan'];
$nama_pembayaran = $_POST['bayar'];
$spreadsheet = new Spreadsheet();
$sheet =$spreadsheet->getActiveSheet();
$spreadsheet->getActiveSheet()->mergeCells('A1:J1');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Data Pembayaran Per Angkatan '.$tgla1.' sampai '.$tgla2);

$query4 = mysqli_query($conn,"SELECT angkatan.tahun_angkatan
FROM pembayaran
INNER JOIN siswa ON pembayaran.id_siswa = siswa.id_siswa
INNER JOIN kelas ON siswa.id_kelas= kelas.id_kelas 
INNER JOIN angkatan ON kelas.id_angkatan= angkatan.id_angkatan 
WHERE angkatan.id_angkatan = '$id_angkatan'");
while($row4 = mysqli_fetch_assoc($query4))
{
	$sheet->setCellValue('A'.'2',"Tahun Angkatan:"." ".$row4['tahun_angkatan']);
	$tahun = $row4['tahun_angkatan'];
}

$query3 = mysqli_query($conn,"SELECT SUM(pembayaran.total_dibayar) AS bayar
FROM pembayaran
INNER JOIN siswa ON pembayaran.id_siswa = siswa.id_siswa
INNER JOIN kelas ON siswa.id_kelas= kelas.id_kelas 
INNER JOIN angkatan ON kelas.id_angkatan= angkatan.id_angkatan
WHERE angkatan.id_angkatan = '$id_angkatan'  AND pembayaran.nama_pembayaran LIKE '$nama_pembayaran' AND pembayaran.tanggal_dibayar BETWEEN '$tgl1' AND '$tgl2'");
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
$sheet->setCellValue('E4', 'Total Pembayaran');
$sheet->setCellValue('F4', 'Total Membayar');
$sheet->setCellValue('G4', 'Sisa');
$sheet->setCellValue('H4', 'Tanggal Dibayar');
$sheet->setCellValue('I4', 'Status');
$sheet->setCellValue('J4', 'Admin');



$query = mysqli_query($conn,"SELECT pembayaran.id_pembayaran,pembayaran.nama_pembayaran,
siswa.nama_siswa,kelas.nama_kelas,pembayaran.status,pembayaran.total_pembayaran,pembayaran.tanggal_dibayar,
pembayaran.total_dibayar,pembayaran.admin,angkatan.tahun_angkatan 
FROM pembayaran
INNER JOIN siswa ON pembayaran.id_siswa = siswa.id_siswa
INNER JOIN kelas ON siswa.id_kelas= kelas.id_kelas
INNER JOIN angkatan ON kelas.id_angkatan= angkatan.id_angkatan
WHERE angkatan.id_angkatan = '$id_angkatan'  AND pembayaran.nama_pembayaran LIKE '$nama_pembayaran' AND pembayaran.tanggal_dibayar BETWEEN '$tgl1' AND '$tgl2'");
$i = 5;
$no = 1;
while($row = mysqli_fetch_assoc($query))
{
	$sisa=$row['total_pembayaran'] - $row['total_dibayar'];
	$sheet->setCellValue('A'.$i, $no++);
	$sheet->setCellValue('B'.$i, $row['nama_kelas']);
	$sheet->setCellValue('C'.$i, $row['nama_siswa']);
	$sheet->setCellValue('D'.$i, $row['nama_pembayaran']);	
	$sheet->setCellValue('E'.$i, "Rp".number_format($row['total_pembayaran']));	
	$sheet->setCellValue('F'.$i, "Rp".number_format($row['total_dibayar']));	
	$sheet->setCellValue('G'.$i, "Rp".number_format($sisa));	
	$sheet->setCellValue('H'.$i, $row['tanggal_dibayar']);	
	$sheet->setCellValue('I'.$i, $row['status']);	
	$sheet->setCellValue('J'.$i, $row['admin']);	
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
$writer->save('../../assets/uploads/report/pembayaran/'.'Report Data Pembayaran Per Angkatan '.date('d-m-Y').'.xlsx');
header('location:../../assets/uploads/report/pembayaran/'.'Report Data Pembayaran Per Angkatan '.date('d-m-Y').'.xlsx');
?>

