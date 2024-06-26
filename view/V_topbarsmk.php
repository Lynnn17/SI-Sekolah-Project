<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->

    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

<!-- Topbar Search -->

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    

    <!-- Nav Item - Alerts -->
    
    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nama_user']; ?></span>
            <img class="img-profile rounded-circle"
                src="<?= BASE_URL; ?>assets/img/undraw_profile.svg">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profilModal">                               
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
            </a>
            <div class="dropdown-item"></div>
            <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
    </li>

</ul>

</nav>
 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Tekan "Logout" Untuk Keluar</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../back/login/handle_logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

     <!-- Profil Modal-->
     <div class="modal fade" id="profilModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="fw-bold" id="exampleModalLabel">Profil</h5>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Nama:</label>
                <input type="text" class="form-control form-control-user" id="nama_user" 
                placeholder="<?php echo $_SESSION['nama_user']; ?>" readonly>
        </div>       
        <div class="form-group">
            <label>Alamat:</label>
                <input type="text" class="form-control form-control-user" id="alamat"
                placeholder="<?php echo $_SESSION['alamat']; ?>" readonly>
        </div>        
        <div class="form-group">
            <label>Nomer Telpon:</label>
                <input type="text" class="form-control form-control-user" id="no_tlpn" 
                placeholder="<?php echo $_SESSION['no_tlpn']; ?>" readonly>
        </div>        
        <div class="form-group">
            <label>Jenis Kelamin:</label>
                <input type="text" class="form-control form-control-user" id="jenis_kelamin"
                placeholder="<?php echo $_SESSION['jenis_kelamin']; ?>" readonly>
        </div>        

      </div>
      <div class="modal-footer">
      <button class="btn btn-danger" type="button" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

