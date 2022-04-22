<?php
include "../../controllers/RegisterController.php";

$class = new AdminRegister();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    if($admin_password == $_POST['admin_confirm_password']){
        $admin_password = md5($_POST['admin_password']);
        $admin_insert = $class->admin_register($admin_name, $admin_email, $admin_password);
    }else{
        $alert = "<span class='alert alert-danger'>Trường mật khẩu không khớp.</span>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../public/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../public/admin/dist/css/adminlte.min.css">
    <!-- My style -->
    <link rel="stylesheet" href="../../public/admin/css/style.css">
</head>

<body class="hold-transition login-page position-relative">
    <video src="../../public/admin/videos/video_background.mkv" class="video-background position-relative" autoplay
        muted loop></video>
    <div class="overplay">
        <div class="register-box">
            <div class="card">
                <div class="card-body register-card-body d-flex flex-column align-items-center">
                    <p class="login-box-msg">Đăng Ký Mới</p>

                    <?php
                        if (isset($admin_insert)) {

                            echo $admin_insert;
                        }
                        if(isset($alert)){
                            echo $alert;
                        }
                        
                    ?>
                    <form action="register.php" method="POST" class="mb-2">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="admin_name" placeholder="Tên">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" name="admin_email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="admin_password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="admin_confirm_password"
                                placeholder="Retype password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <!-- <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                    <label for="agreeTerms">
                                        Tôi đồng ý với <a href="#">điền khoản</a>
                                    </label>
                                </div>
                            </div> -->
                            <!-- /.col -->
                            <div class="col-6 ">
                                <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <a href="login.php" class="text-center">Tôi đã có tài khoản</a>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
        <!-- /.register-box -->
    </div>


    <!-- jQuery -->
    <script src="../../public/admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../public/admin/dist/js/adminlte.min.js"></script>
</body>

</html>