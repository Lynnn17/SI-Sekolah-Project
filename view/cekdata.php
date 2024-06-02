<h4>Peminjaman Buku</h4>
<table class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Nomor</th>
            
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
            
            <!-- <th>Buku Dikembalikan</th>
            <th>Jumlah Denda</th>
            <th>Status</th>
        </tr> -->
    </thead>
    <tbody>
        <?php
            include '../back/koneksi.php';
            // error_reporting(0);
            $s_keyword = $_POST['keyword'];
            $search_keyword = '%'. $s_keyword .'%';
            $no = 1;
            $query = "SELECT * FROM peminjaman 
            INNER JOIN siswa ON peminjaman.id_siswa = siswa.id_siswa
            INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
            INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas
            WHERE peminjaman.id_siswa LIKE ? AND status = 'Pinjam'";
            $dewan1 = $conn->prepare($query);
            $dewan1->bind_param('s', $search_keyword);
            $dewan1->execute();
            $res1 = $dewan1->get_result();
 
            if ($res1->num_rows > 0) {
                while ($row = $res1->fetch_assoc()) {
                    $id = $row['id_peminjaman'];
                    $nama_siswa = $row['nama_siswa'];
                    $judul = $row['judul'];
                    $kelas = $row['nama_kelas'];
                    $tgl_kembali = $row['tgl_kembali'];
                    $tgl_pinjam = $row['tgl_pinjam'];
                    $status = $row['status'];
                    
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $nama_siswa; ?></td>
                <td><?php echo  $kelas;?></td>
                <td><?php echo $judul; ?></td>
                <td><?php echo $tgl_pinjam; ?></td>
                <td><?php echo $tgl_kembali; ?></td>
                <td><?php echo $status; ?></td>
                
            </tr>
        <?php } } else { ?> 
            <tr>
                <td colspan='7'>Tidak ada data ditemukan</td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<h4>Pembayaran</h4>
<table class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Nomor</th>
            
            <th>Nama Siswa</th>
            <th>Nama Pembayaran</th>
            <th>Kelas</th>
            <th>Total Membayar</th>
            <th>Total Pembayaran</th>
            <th>Tanggal Dibayar</th>
            <th>Status</th>
            <th>Admin</th>
            <!-- <th>Buku Dikembalikan</th>
            <th>Jumlah Denda</th>
            <th>Status</th>
        </tr> -->
    </thead>
    <tbody>
        <?php
            // include '../back/koneksi.php';
            // error_reporting(0);
            // $s_keyword = $_POST['keyword'];
            // $search_keyword = '%'. $s_keyword .'%';
            $no1 = 1;
            $query2 = "SELECT * FROM pembayaran 
            INNER JOIN siswa ON pembayaran.id_siswa = siswa.id_siswa
            INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas
            WHERE pembayaran.id_siswa LIKE ? AND status = 'Angsur'";
            $dewan2 = $conn->prepare($query2);
            $dewan2->bind_param('s', $search_keyword);
            $dewan2->execute();
            $res2 = $dewan2->get_result();
            
            function Rupiah($angka){
            $hasil = "Rp " . number_format($angka,0,',','.');
            return $hasil;
            }
            if ($res2->num_rows > 0) {
                while ($row1 = $res2->fetch_assoc()) {
                    $id1 = $row1['id_pembayaran'];
                    $nama_siswa1 = $row1['nama_siswa'];
                    $nama_pembayaran = $row1['nama_pembayaran'];
                    $kelas1 = $row1['nama_kelas'];
                    $tgl_dibayar = $row1['tanggal_dibayar'];
                    $total_membayar = $row1['total_dibayar'];
                    $total_pembayaran = $row1['total_pembayaran'];
                    $status1 = $row1['status'];
                    $admin2 = $row1['admin'];
        ?>
            <tr>
                <td><?php echo $no1++; ?></td>
                <td><?php echo $nama_siswa1; ?></td>
                <td><?php echo $nama_pembayaran; ?></td>
                <td><?php echo $kelas1; ?></td>
               
                <td><?php echo Rupiah($total_membayar); ?></td>
                <td><?php echo $total_pembayaran; ?></td>
                <td><?php echo $tgl_dibayar; ?></td>
                <td><?php echo $status1; ?></td>
                <td><?php echo $admin2; ?></td>
            </tr>
        <?php } } else { ?> 
            <tr>
                <td colspan='7'>Tidak ada data ditemukan</td>
            </tr>
        <?php } ?>
    </tbody>
</table>