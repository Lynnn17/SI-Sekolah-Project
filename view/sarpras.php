
<?php include "V_head.php";
session_start();
if (empty($_SESSION['id_user'])){
    header("location:login.php");
}

?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->

        <?php include "V_sidebarsarpras.php" ?>
        <!-- End of Sidebar -->
        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
            <?php include "V_topbar.php" ?>
            <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <img width="250" height="250" alt="logosmk" src="<?= BASE_URL; ?>assets/img/smklogo.png" class="smklogo" style=""><hr>
                    <h2 style="text-align: center;"><span style="color: #ff0000;">SMK Negeri Purwosari Bojonegoro</span></h2>
<p><strong>SMK Negeri Purwosari</strong> berdiri sesuai SK Bupati Nomor : 428 Tahun 2003.</p>
<p>Menyebut Nama Sekolah Menengah Kejuruan “SMK” identik dengan sebuah institusi yang diharapkan memenuhi :</p>
<p style="padding-left: 30px;"><span style="color: #34495e;"><strong>1. Bernilai Aset</strong></span><br />
<span style="color: #34495e;"><strong>2. Pengisi kebutuhan pembangunan</strong></span><br />
<span style="color: #34495e;"><strong>3. Menjadi factor keunggulan kompetitif</strong></span><br />
<span style="color: #34495e;"><strong>4. Kewirausahaan untuk menciptakan pelayanan</strong></span></p>
<p>Hal ini sejalan dengan pesan Presiden untuk SMK :</p>
<p>&nbsp;</p>
<div class="su-quote su-quote-style-default"><div class="su-quote-inner su-clearfix">Teruslah berprestasi, menghasilkan tenaga yang terampil dan professional&#8230;!</div></div>
<p>&nbsp;</p>
<p>Ini menjadikan komitmen SMKN PURWOSARI untuk selalu berupaya agar lulusan SMK Negeri Purwosari memiliki sebutan “BMW”. Lulusan SMK harus :</p>
<pre style="padding-left: 30px;">B      : Bekerja
M      : Melanjutkan
W      : Wirausaha</pre>
<p align="justify"><strong><br />
SMK Negeri Purwosari</strong> merupakan sebuah lembaga pendidikan yang mengedepankan kedisiplinan dalam kegiatan belajar mengajarnya, mengapa demikian karena dengan suatu kedisiplinan kita dapat meraih segala yang kita cita-citakan. SMK Negeri Purwosari berkembang dengan sangat pesat dari tahun ke tahun selalu menunjukkan peningkatan baik itu dari segi peminat atau jumlah siswanya, mutu pendidikannya, kualitas tenaga pendidiknya, maupun dari segi pembangunan yang meliputi peningkatan fasilitas-fasilitas penunjang pendidikan sesuai dengan jurusan masing-masing.</p>
<h3><span style="color: #ff0000;"><strong>SMK Negeri Purwosari memiliki 6 Jurusan :</strong></span></h3>
<p style="padding-left: 30px;">1. Rekayasa Perangkat Lunak (RPL)<br />
2. Teknik Kendaraan Ringan (TKR)<br />
3. Teknik Pemesinan (TPm)<br />
4. Akuntansi (AK)<br />
5. Desain Komunikasi Visual (DKV)<br />
6. Teknik Las (TL)</p>
<p align="justify">Di harapkan siswa/siswi <em>SMK Negeri Purwosari</em> mampu untuk menghadapi segala tantangan yang ada dalam kehidupan dan dunia kerja di era saat ini serta mampu memberikan keahlian bagi para siswanya yang sesuai dengan kebutuhan dunia kerja saat ini.</p>
<p align="justify">Dengan memberikan pelayanan pendidikan yang sesuai dengan standar pendidikan saat ini, SMK Negeri Purwosari mampu di jadikan tolak ukur bagi sekolahan-sekolahan yang lain serta mampu menjadi salah satu sekolahan yang menjadi favorit.</p>
                           
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Rekayasa Perangkat Lunak</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

   

    <!-- Bootstrap core JavaScript-->
    

</body>

