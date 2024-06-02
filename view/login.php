<?php include "V_head.php"; ?>
<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center" style="margin-top: 12vh;">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block text-center pt-4"><br><img src="<?= BASE_URL; ?>assets/img/logosmk.png" width="200" height ="200"><hr><h3>SMK NEGERI PURWOSARI</h3><h6>Jl. Ngambon No.Km. 1.5, Pojok, Purwosari, Kabupaten Bojonegoro, Jawa Timur 62161 </h6></div>
                            <div class="col-lg-6" style="border:1px solid auto;background-color:lightgray;">

                                <div class="p-5" >
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4" >Selamat Datang</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="username" aria-describedby="emailHelp"
                                                placeholder="Masukkan Username">
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
                </div>

            </div>

        </div>

    </div>
    <script >
        function getLogin () {
            var username = $('#username').val();
            var password = $('#password').val();
            $.ajax({
                url:"http://localhost/project/back/login/handle_login.php/",
                type:"post",
                data:{
                    username:username,
                    password:password
                },
                success:(res) => {
                    console.log(res)
                    if (res == "Username tidak ditemukkan") {
                        Swal.fire("Oopss...","Usarname Yang Anda Masukkan Tidak Dapat Ditemukkan!!!","error");
                    }
                    else if (res == "Password Salah") {
                        Swal.fire("Oopss...","Password Yang Anda Masukkan Salah!!!","error");
                    }
                    else if (res == "Login Berhasil") {
                        location.replace ("<?= BASE_URL; ?>view/dashboardsmk.php?home")
                    }
                },
                error: () => {
                    swal.fire("Eror!!!","Login Gagal","error");
                }

            })
        }
    </script>
</body>
