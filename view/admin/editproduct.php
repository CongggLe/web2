<?php
    include_once "../../controllers/CategoryController.php";
    include_once "../../controllers/BrandController.php";
    include_once "../../controllers/ProductController.php";
    if(!isset($_GET["product_id"]) || $_GET["product_id"] == NULL){
        echo "<script>windown.location = 'listproduct.php'</script>";
    }else{
        $id = $_GET["product_id"];
    }
    $category = new Category();
    $brand = new Brand();
    $product = new product();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $product_update = $product->product_update($_POST, $_FILES, $id);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cập nhật sản phẩm sản phẩm</title>

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
                    <h3 class="card-title">Cập nhật sản phẩm</h3>
                    <div class="text-center">
                        <?php
                            if(isset($product_update)){
                                echo $product_update;
                            }
                        ?>
                    </div>
                </div>
                <!-- /.card-header -->
                <?php
                    $get_product = $product->getproductById($id);
                    if($get_product){
                        
                        while($result = $get_product->fetch_assoc()){
                            if($result['product_status'] == 1){
                                $product_status =  "<div class='form-group'>
                                    <label for='product_status'>Trạng thái</label>
                                    <select id='product_status' name='product_status' class='form-control custom-select'>
                                        <option selected value='1'>Hiện</option>
                                        <option value='0'>Ẩn</option>
                                    </select>
                                </div>";
                            }else{
                                $product_status =  "<div class='form-group'>
                                    <label for='product_status'>Trạng thái</label>
                                    <select id='product_status' name='product_status' class='form-control custom-select'>
                                        <option  value='1'>Hiện</option>
                                        <option selected value='0'>Ẩn</option>
                                    </select>
                                </div>";
                            }


                            if($result['product_type'] == 2){
                                $product_type = "<div class='form-group'>
                                    <label for='product_type'>Loại sản phẩm</label>
                                    <select id='product_type' name='product_type' class='form-control custom-select'>
                                        <option value='0'>Sản phẩm hết Hot</option>
                                        <option value='1'>Sản phẩm nổi bật</option>
                                        <option value='2' selected>Sản phẩm mới</option>
                                    </select>
                                </div>";
                            }elseif($result['product_type'] == 1){
                                $product_type = "<div class='form-group'>
                                    <label for='product_type'>Loại sản phẩm</label>
                                    <select id='product_type' name='product_type' class='form-control custom-select'>
                                        <option value='0'>Sản phẩm hết Hot</option>
                                        <option value='1' selected>Sản phẩm nổi bật</option>
                                        <option value='2'>Sản phẩm mới</option>
                                    </select>
                                </div>";
                            }else{
                                $product_type = "<div class='form-group'>
                                    <label for='product_type'>Loại sản phẩm</label>
                                    <select id='product_type' name='product_type' class='form-control custom-select'>
                                        <option value='0' selected>Sản phẩm hết Hot</option>
                                        <option value='1'>Sản phẩm nổi bật</option>
                                        <option value='2'>Sản phẩm mới</option>
                                    </select>
                                </div>";
                            }

                    ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="product_name">Tên sản phẩm</label>
                            <input type="text" class="product_name form-control" id="product_name"
                                value="<?php echo $result['product_name'] ?>" name="product_name"
                                placeholder="Nhập tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="product_name">Hình ảnh sản phẩm</label>
                            <img src="../../public/uploads/<?php echo $result['product_img'] ?>" alt="" width="80px"
                                height="80px" class="img-responsive m-3">
                            <input type="file" class="product_img form-control" id="product_img" name="product_img"
                                placeholder="Nhập tên sản phẩm">
                            <input type="hidden" value="../../public/uploads/<?php echo $result['product_img'] ?>"
                                name="old_img">
                        </div>
                        <div class="form-group">
                            <label for="product_name">Đơn giá sản phẩm</label>
                            <input type="text" class="product_price form-control" id="product_price"
                                value="<?php echo $result['product_price'] ?>" name="product_price"
                                placeholder="Nhập đơn giá sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="product_name">Số lượng sản phẩm</label>
                            <input type="number" min="1" class="product_quantity form-control" id="product_quantity"
                                value="<?php echo $result['product_quantity'] ?>" name="product_quantity">
                        </div>
                        <div class="form-group">
                            <label for="product_desc">Mô tả sản phẩm</label>
                            <textarea name="product_desc" id="product_desc" class="form-control"
                                rows="10"><?php echo $result['product_desc'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="product_keyword">Từ khóa sản phẩm</label>
                            <input type="text" class="product_keyword form-control" id="product_keyword"
                                value="<?php echo $result['product_keyword'] ?>" name="product_keyword"
                                placeholder="Từ khóa sản phẩm">
                        </div>

                        <div class="form-group">
                            <label for="category_id">Thuộc danh mục</label>
                            <select id="category_id" name="category_id" class="form-control custom-select">
                                >
                                <?php
                                    $get_category = $category->getCategory();
                                    if($get_category){
                                        while($result_category = $get_category->fetch_assoc()){
                                            if($result['category_id'] == $result_category['category_id']){
                                                $selected = "selected";
                                            }else{
                                                $selected = "";
                                            }
                                            echo "<option value='".$result_category['category_id']."' ".$selected.">".$result_category['category_name']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="brand_id">Thuộc thương hiệu</label>
                            <select id="brand_id" name="brand_id" class="form-control custom-select">
                                <?php
                                    $get_brand = $brand->getBrand();
                                    if($get_brand){
                                        while($result_brand = $get_brand->fetch_assoc()){
                                            if($result['brand_id'] == $result_brand['brand_id']){
                                                $selected = "selected";
                                            }else{
                                                $selected = "";
                                            }
                                            echo "<option value='".$result_brand['brand_id']."' ".$selected.">".$result_brand['brand_name']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>

                        <?php echo $product_status?>
                        <?php echo $product_type?>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>

                </form>
                <?php
                        }
                    }
                ?>


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
    <!-- My script -->
    <!-- <script src="../../public/admin/js/admin-main.js"></script> -->
    <!-- <script>
    function ChangeToKeyword() {

        let keyword;
        keyword = document.getElementById("input-name").value;
        keyword = keyword.toLowerCase();
        // Đổi ký tự thành không dấu.
        keyword = keyword.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, "a");
        keyword = keyword.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, "e");
        keyword = keyword.replace(/i|í|ì|ỉ|ĩ|ị/gi, "i");
        keyword = keyword.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, "o");
        keyword = keyword.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, "u");
        keyword = keyword.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, "y");
        keyword = keyword.replace(/đ/gi, "d");
        //Xóa các ký tự đặt biệt
        keyword = keyword.replace(
            /\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi,
            ""
        );
        //Đổi khoảng trắng thành ký tự gạch ngang
        keyword = keyword.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        keyword = keyword.replace(/\-\-\-\-\-/gi, "-");
        keyword = keyword.replace(/\-\-\-\-/gi, "-");
        keyword = keyword.replace(/\-\-\-/gi, "-");
        keyword = keyword.replace(/\-\-/gi, "-");
        //Xóa các ký tự gạch ngang ở đầu và cuối
        keyword = "@" + keyword + "@";
        keyword = keyword.replace(/\@\-|\-\@|\@/gi, "");
        //In keyword ra textbox có id “keyword”
        document.getElementById("input-keyword").value = keyword;
    }
    </script> -->
</body>

</html>