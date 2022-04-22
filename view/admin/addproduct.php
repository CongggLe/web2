<?php
    include_once "../../controllers/BrandController.php";
    include_once "../../controllers/CategoryController.php";
    include_once "../../controllers/ProductController.php";
    $brand = new Brand();
    $category = new Category();
    $product = new Product();
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        $product_insert = $product->product_add($_POST, $_FILES);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm sản phẩm</title>

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
                    <h3 class="card-title">Thêm sản phẩm</h3>
                    <div class="text-center">
                        <?php
                            if(isset($product_insert)){
                                echo $product_insert;
                            }
                        ?>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="addproduct.php" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="product_name">Tên sản phẩm</label>
                            <input type="text" class="product_name form-control" id="product_name" name="product_name"
                                placeholder="Nhập tên sản phẩm">
                        </div>

                        <div class="form-group">
                            <label for="product_img">Hình ảnh sản phẩm</label>
                            <input type="file" class="product_img form-control" id="product_img" name="product_img">
                        </div>
                        <div class="form-group">
                            <label for="product_price">Đơn giá sản phẩm</label>
                            <input type="text" class="product_price form-control" id="product_price"
                                name="product_price" placeholder="Đơn giá sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="product_quantity">Số lượng sản phẩm nhập kho</label>
                            <input type="number" class="product_quantity form-control" id="product_quantity"
                                name="product_quantity" placeholder="Số lượng nhập kho sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="product_desc">Mô tả sản phẩm</label>
                            <textarea name="product_desc" id="product_desc" class="form-control" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="product_keyword">Từ khóa sản phẩm</label>
                            <input type="text" class="product_keyword form-control" id="product_keyword"
                                name="product_keyword" placeholder="Từ khóa sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="category_id">Thuộc danh mục</label>
                            <select id="category_id" name="category_id" class="form-control custom-select">
                                >
                                <option>--- Chọn danh mục ---</option>
                                <?php
                                    $get_category = $category->getCategory();
                                    if($get_category){
                                        while($result = $get_category->fetch_assoc()){
                                            echo "<option value='".$result['category_id']."'>".$result['category_name']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="brand_id">Thuộc thương hiệu</label>
                            <select id="brand_id" name="brand_id" class="form-control custom-select">
                                <option>--- Chọn thương hiệu ---</option>
                                <?php
                                    $get_brand = $brand->getBrand();
                                    if($get_brand){
                                        while($result = $get_brand->fetch_assoc()){
                                            echo "<option value='".$result['brand_id']."'>".$result['brand_name']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="product_status">Trạng thái</label>
                            <select id="product_status" name="product_status" class="form-control custom-select">
                                <option value="1">Hiện</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <input type="hidden" id="product_type" name="product_type" value="2">
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