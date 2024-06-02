<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon ">
                    <i class="fas fa-warehouse"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SARANA PRASARANA</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- Nav Item - Dashboard -->
            <div id="myDIV">
            <li class="nav-item <?php if (isset($_GET["home"])){echo "active"; }?>">
                <a class="nav-link" href="<?= BASE_URL; ?>view/dashboard-sarpras.php?home">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>
            <?php if ($_SESSION['jabatan'] == "admin" OR $_SESSION['jabatan'] == "pengurus") {?>
            <li class="nav-item <?php if (isset($_GET["angkatan"])){echo "active"; }?> 
                            <?php if (isset($_GET["kelas"])){echo "active"; }?>
                            <?php if (isset($_GET["jurusan"])){echo "active"; }?> 
                            <?php if (isset($_GET["guru"])){echo "active"; }?>
                            <?php if (isset($_GET["user"])){echo "active"; }?>">


                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Data Master</span>
                </a>
                <div id="collapseTwo" class="collapse " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data:</h6>
                        <a class="collapse-item  <?php if (isset($_GET["angkatan"])){echo "active"; }?> 
                            <?php if (isset($_GET["kelas"])){echo "active"; }?>"
                            href="<?= BASE_URL; ?>view/sdata_angkatan.php?angkatan">Murid</a>
                        <a class="collapse-item <?php if (isset($_GET["jurusan"])){echo "active"; }?> 
                            <?php if (isset($_GET["guru"])){echo "active"; }?>" 
                            href="<?= BASE_URL; ?>view/sjurusan.php?jurusan">Guru</a>
                            <a class="collapse-item <?php if (isset($_GET["user"])){echo "active"; }?> 
                            <?php if (isset($_GET["user"])){echo "active"; }?>" 
                            href="<?= BASE_URL; ?>view/usersarpras.php?user">User</a>
                    </div>
                </div>
            </li>
           <?php } ?>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?php if (isset($_GET["barang"])){echo "active"; }?> ">
                <a class="nav-link " href="<?= BASE_URL; ?>view/barang.php?barang" data-toggle="" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-boxes"></i>
                    <span>Data Barang</span>
                </a> 
            </li>
            <?php if ($_SESSION['jabatan'] == "admin" OR $_SESSION['jabatan'] == "pengurus") { ?>
            <li class="nav-item <?php if (isset($_GET["pinjam"])){echo "active"; }?> ">
                <a class="nav-link " href="<?= BASE_URL; ?>view/pinjam_barang.php?pinjam" data-toggle="" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-exchange-alt"></i>
                    <span>Pinjam Barang</span>
                </a>
        </li>
    <?php } ?>
            </div>
            <!-- Divider -->
            
            <!-- Sidebar Toggler (Sidebar) -->
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" onclick="" id="sidebarToggle"></button>
            </div>
            


        </ul>