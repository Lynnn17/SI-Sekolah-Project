
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon ">
                    <i class="fas fa-school"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SMKN PURWOSARI</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- Nav Item - Dashboard -->
            <div id="myDIV">
            <li class="nav-item <?php if (isset($_GET["home"])){echo "active"; }?>">
                <a class="nav-link" href="<?= BASE_URL; ?>view/dashboardsmk.php?home">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            
            <li class="nav-item <?php if (isset($_GET["angkatan"])){echo "active"; }?> 
                            <?php if (isset($_GET["kelas"])){echo "active"; }?>
                            <?php if (isset($_GET["jurusan"])){echo "active"; }?> 
                            <?php if (isset($_GET["guru"])){echo "active"; }?>">
                            
                            
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Data Master</span>
                </a>
                <div id="collapseTwo" class="collapse <?php if (isset($_GET["angkatan"])){echo "show"; }?> 
                            <?php if (isset($_GET["kelas"])){echo "show"; }?>
                            <?php if (isset($_GET["jurusan"])){echo "show"; }?> 
                            <?php if (isset($_GET["guru"])){echo "show"; }?>"
                             aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data:</h6>
                        <a class="collapse-item  <?php if (isset($_GET["angkatan"])){echo "active"; }?> 
                            <?php if (isset($_GET["kelas"])){echo "active"; }?>"
                            href="<?= BASE_URL; ?>view/data_angkatan.php?angkatan">Murid</a>
                        <a class="collapse-item <?php if (isset($_GET["jurusan"])){echo "active"; }?> 
                            <?php if (isset($_GET["guru"])){echo "active"; }?>" 
                            href="<?= BASE_URL; ?>view/jurusan.php?jurusan">Guru</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <!-- <li class="nav-item <?php if (isset($_GET["perpus"])){echo "active"; }?> ">
                <a class="nav-link " href="<?= BASE_URL; ?>view/loginperpustakaan.php?perpus" data-toggle="" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-book-reader"></i>
                    <span>PERPUSTAKAAN</span>
                </a>
            </li>
            <li class="nav-item <?php if (isset($_GET["sarpras"])){echo "active"; }?> ">
                <a class="nav-link " href="<?= BASE_URL; ?>view/loginsarpras.php?sarpras" data-toggle="" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-warehouse"></i>
                    <span>SARPRAS</span>
                </a>
            </li> -->
            </div>
            <!-- Divider -->
            
            <!-- Sidebar Toggler (Sidebar) -->
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" onclick="" id="sidebarToggle"></button>
            </div>
            


        </ul>

