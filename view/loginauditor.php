<?php include "V_head.php";
session_start(); ?>
<body class="bg-gradient-primary">
<div id="wrapper">

        <!-- Sidebar -->
        <?php include "V_sidebar.php" ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include "V_topbar1.php" ?>
    <div class="container-fluid">

        <!-- Outer Row -->
        
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block text-center pt-4"><br><img src="<?= BASE_URL; ?>assets/img/logosmk.png" width="200" height ="200"><hr><h3>AUDITOR SMK NEGERI PURWOSARI</h3><h6>Jl. Ngambon No.Km. 1.5, Pojok, Purwosari, Kabupaten Bojonegoro, Jawa Timur 62161 </h6></div>
                            <div class="col-lg-6" style="border-left:1px solid lightgrey;">

                                <div class="p-5" >
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4" >Selamat Datang</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="username" aria-describedby="emailHelp"
                                                placeholder="Masukkan Username" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" placeholder="Masukkan Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Ingatkan Saya</label>
                                            </div>
                                        </div>
                                        <a href="#" onclick="getLogin()" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </a>     
                                </div>
                            </div>
                        </div>

                    </div>
                    <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Rekayasa Perangkat Lunak</span>
                    </div>
                </div>
            </footer>
                </div>

            </div>

        </div>
</div>
</div>
</div>
    </div>
    <script >
        function getLogin () {
            var username = $('#username').val();
            var password = $('#password').val();
            if (username == "") {
            Swal.fire("Peringatan","Username tidak boleh kosong","warning");
            return;
            }
            else if(password == ""){
            Swal.fire("Peringatan","Password tidak boleh kosong","warning");
            return;
            }
            $.ajax({
                url:"<?= BASE_URL; ?>/back/login/handle_loginaudit.php/",
                type:"post",
                data:{
                    username:username,
                    password:password
                },
                success:(res) => {
                    console.log(res)
                    if (res == "Username tidak ditemukkan") {
                        Swal.fire("Oopss...","Username Yang Anda Masukkan Tidak Dapat Ditemukkan!!!","error");
                    }
                    else if (res == "Password Salah") {
                        Swal.fire("Oopss...","Password Yang Anda Masukkan Salah!!!","error");
                    }
                    else if (res == "Login Berhasil") {
                        location.replace ("<?= BASE_URL; ?>view/dashboard-audit.php?home")
                    }
                },
                error: () => {
                    Swal.fire("Eror!!!","Login Gagal","error");
                }

            })
        }
    </script>

</body>
