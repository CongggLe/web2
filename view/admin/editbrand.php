<?php
    include_once "../../controllers/BrandController.php";
    if(!isset($_GET["brand_id"]) || $_GET["brand_id"] == NULL){
        echo "<script>windown.location = 'listbrand.php'</script>";
    }else{
        $id = $_GET["brand_id"];
    }
    $brand = new Brand();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $brand_name = $_POST['brand_name'];
        $brand_desc = $_POST['brand_desc'];
        $brand_keyword = $_POST['brand_keyword'];
        $brand_status = $_POST['brand_status'];
        
        $brand_update = $brand->brand_update($brand_name, $brand_desc, $brand_keyword, $brand_status, $id);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cập nhật thương hiệu sản phẩm</title>

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
                    <h3 class="card-title">Cập nhật thương hiệu</h3>
                    <div class="text-center">
                        <?php
                            if(isset($brand_update)){
                                echo $brand_update;
                            }
                        ?>
                    </div>
                </div>
                <!-- /.card-header -->
                <?php
                    $get_brand = $brand->getBrandById($id);
                    if($get_brand){
                        
                        while($result = $get_brand->fetch_assoc()){
                            if($result['brand_status'] == 1){
                                $brand_status =  "<div class='form-group'>
                                    <label for='brand_status'>Trạng thái</label>
                                    <select id='brand_status' name='brand_status' class='form-control custom-select'>
                                        <option selected value='1'>Hiện</option>
                                        <option value='0'>Ẩn</option>
                                    </select>
                                </div>";
                            }else{
                                $brand_status =  "<div class='form-group'>
                                    <label for='brand_status'>Trạng thái</label>
                                    <select id='brand_status' name='brand_status' class='form-control custom-select'>
                                        <option  value='1'>Hiện</option>
                                        <option selected value='0'>Ẩn</option>
                                    </select>
                                </div>";
                            }
                    ?>
                <form action="" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="brand_name">Tên thương hiệu</label>
                            <input type="text" class="brand_name form-control" id="brand_name"
                                value="<?php echo $result['brand_name'] ?>" name="brand_name"
                                placeholder="Nhập tên thương hiệu">
                        </div>
                        <div class="form-group">
                            <label for="brand_desc">Mô tả thương hiệu</label>
                            <input type="text" class="brand_desc form-control" id="brand_desc"
                                value="<?php echo $result['brand_desc'] ?>" name="brand_desc"
                                placeholder="Mô tả thương hiệu">
                        </div>
                        <div class="form-group">
                            <label for="brand_keyword">Từ khóa thương hiệu</label>
                            <input type="text" class="brand_keyword form-control" id="brand_keyword"
                                value="<?php echo $result['brand_keyword'] ?>" name="brand_keyword"
                                placeholder="Từ khóa thương hiệu">
                        </div>
                        <?php echo $brand_status?>
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