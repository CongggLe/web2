<?php
    include_once "../../controllers/BrandController.php";

    $brand = new Brand();
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $brand_name = $_POST["brand_name"];
        $brand_desc = $_POST["brand_desc"];
        $brand_keyword = $_POST["brand_keyword"];
        $brand_status = $_POST["brand_status"];
        
        $brand_insert = $brand->brand_add($brand_name, $brand_desc, $brand_keyword, $brand_status);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm thương hiệu sản phẩm</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../../public/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../public/admin/dist/css/adminlte.min.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!----------------------------------------- Header -------------------------------------------------->
        <?php require_once "./inc/header.php" ?>
        <!----------------------------------------- /.Header ------------------------------------------------->
        <!------------------------------------------ Main Sidebar Container ----------------------------------->
        <?php require_once "./inc/sidebar.php" ?>
        <!------------------------------------------ /.Main Sidebar Container --------------------------------->
        <!---------------------------------------- Content Wrapper. Contains page content ---------------------->
        <div class="content-wrapper">
            <div class="card card-primary m-3 bg-light">
                <div class="card-header">
                    <h3 class="card-title">Thêm thương hiệu</h3>
                    <div class="text-center">
                        <?php
                            if(isset($brand_insert)){
                                echo $brand_insert;
                            }
                        ?>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="addbrand.php" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="brand_name">Tên thương hiệu</label>
                            <input type="text" class="brand_name form-control" id="brand_name" name="brand_name"
                                placeholder="Nhập tên thương hiệu">
                        </div>
                        <div class="form-group">
                            <label for="brand_desc">Mô tả thương hiệu</label>
                            <input type="text" class="brand_desc form-control" id="brand_desc" name="brand_desc"
                                placeholder="Mô tả thương hiệu">
                        </div>
                        <div class="form-group">
                            <label for="brand_keyword">Từ khóa thương hiệu</label>
                            <input type="text" class="brand_keyword form-control" id="brand_keyword"
                                name="brand_keyword" placeholder="Từ khóa thương hiệu">
                        </div>

                        <div class="form-group">
                            <label for="brand_status">Trạng thái</label>
                            <select id="brand_status" name="brand_status" class="form-control custom-select">
                                <option value="1">Hiện</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
        <!----------------------------------------- /.content-wrapper ------------------------------------------>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-------------------------------------------- Footer ------------------------------------>
        <?php require_once "./inc/footer.php" ?>
        <!------------------------------------------ /.Footer ----------------------------------->
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="../../public/admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../../public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../public/admin/dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="../../public/admin/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="../../public/admin/plugins/raphael/raphael.min.js"></script>
    <script src="../../public/admin/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="../../public/admin/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="../../public/admin/plugins/chart.js/Chart.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="../../public/admin/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../../public/admin/dist/js/pages/dashboard2.js"></script>
</body>

</html>