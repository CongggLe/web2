<?php
include "../../controllers/AdminController.php";

$class = new AdminLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_email = $_POST['admin_email'];
    $admin_password = ($_POST['admin_password']);
    $login_check = $class->admin_login($admin_email, $admin_password);
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
        <div class="login-box">
            <div class="card">
                <div class="card-body login-card-body d-flex flex-column align-items-center">
                    <p class="login-box-msg">Trang Đăng Nhập</p>
                    <?php
                        if (isset($login_check)) {
                            echo "<span class='alert alert-danger'>$login_check</span>";
                        }
                    ?>
                    <form action="login.php" method="post" class="mb-2">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" name="admin_email" placeholder="Email" require>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control input-password" name="admin_password"
                                placeholder="Password" require>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-7">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">
                                        Hiện mật khẩu
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <!-- <p class="mb-1">
                        <a href="forgot-password.html">Quên mật khẩu</a>
                    </p> -->
                    <!-- <p class="mb-0">
                        <a href="register.php" class="text-center">Đăng ký tài khoản mới</a>
                    </p> -->
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
    </div>


    <!-- jQuery -->
    <script src="../../public/admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../public/admin/dist/js/adminlte.min.js"></script>
    <!-- Main js -->
    <script src="../../public/admin/js/admin-main.js"></script>
</body>

</html>