<?php
    include_once "../../controllers/CategoryController.php";
    if(!isset($_GET["category_id"]) || $_GET["category_id"] == NULL){
        echo "<script>windown.location = 'listcategory.php'</script>";
    }else{
        $id = $_GET["category_id"];
    }
    $category = new Category();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $category_name = $_POST['category_name'];
        $category_desc = $_POST['category_desc'];
        $category_keyword = $_POST['category_keyword'];
        $category_status = $_POST['category_status'];
        
        $category_update = $category->category_update($category_name, $category_desc, $category_keyword, $category_status, $id);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cập nhật danh mục sản phẩm</title>

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
                    <h3 class="card-title">Cập nhật danh mục</h3>
                    <div class="text-center">
                        <?php
                            if(isset($category_update)){
                                echo $category_update;
                            }
                        ?>
                    </div>
                </div>
                <!-- /.card-header -->
                <?php
                    $get_category = $category->getCategoryById($id);
                    if($get_category){
                        
                        while($result = $get_category->fetch_assoc()){
                            if($result['category_status'] == 1){
                                $category_status =  "<div class='form-group'>
                                    <label for='category_status'>Trạng thái</label>
                                    <select id='category_status' name='category_status' class='form-control custom-select'>
                                        <option selected value='1'>Hiện</option>
                                        <option value='0'>Ẩn</option>
                                    </select>
                                </div>";
                            }else{
                                $category_status =  "<div class='form-group'>
                                    <label for='category_status'>Trạng thái</label>
                                    <select id='category_status' name='category_status' class='form-control custom-select'>
                                        <option  value='1'>Hiện</option>
                                        <option selected value='0'>Ẩn</option>
                                    </select>
                                </div>";
                            }
                    ?>
                <form action="" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="category_name">Tên danh mục</label>
                            <input type="text" class="category_name form-control" id="category_name"
                                value="<?php echo $result['category_name'] ?>" name="category_name"
                                placeholder="Nhập tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="category_desc">Mô tả danh mục</label>
                            <input type="text" class="category_desc form-control" id="category_desc"
                                value="<?php echo $result['category_desc'] ?>" name="category_desc"
                                placeholder="Mô tả danh mục">
                        </div>
                        <div class="form-group">
                            <label for="category_keyword">Từ khóa danh mục</label>
                            <input type="text" class="category_keyword form-control" id="category_keyword"
                                value="<?php echo $result['category_keyword'] ?>" name="category_keyword"
                                placeholder="Từ khóa danh mục">
                        </div>
                        <?php echo $category_status?>
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
    <script>
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
    </script>
</body>

</html>