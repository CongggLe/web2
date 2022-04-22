<?php
    include_once "../../controllers/CategoryController.php";
    $category = new Category();
    if(isset($_GET["delete_id"])){
        $id = $_GET["delete_id"];
        $category_delete = $category->category_delete($id);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liệt kê danh mục sản phẩm</title>

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
                    <h3 class="card-title">Liệt kê danh mục</h3>
                    <div class="text-center">
                        <?php
                            if(isset($category_delete)){
                                echo $category_delete;
                            }
                        ?>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card m-1">

                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Tên danh mục</th>
                                    <th style="width: 50%">Mô tả danh mục</th>
                                    <th>Trạng thái</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $show_category = $category->category_list();
                                    if($show_category){
                                        $i = 0;
                                        while($result = $show_category->fetch_assoc()){
                                            $i++;
                                            if($result['category_status'] == 1){
                                                $category_status = "<span class='badge badge-success'>Hiện</span>";
                                            }else{
                                                $category_status = "<span class='badge badge-secondary'>Ẩn</span>";
                                            }
                                            echo "<tr>
                                                     <td>".$i."</td>
                                                     <td>".$result['category_name']."</td>
                                                     <td>".$result['category_desc']."</td>
                                                    <td class='text-center'>".$category_status."</td>
                                                    <td>
                                                        <a href='editcategory.php?category_id=".$result['category_id']."' class='btn btn-success btn-sm'>
                                                             <i class='far fa-edit'></i>
                                                             <span>Edit</span>
                                                        </a>
                                                        <a href='?delete_id=".$result['category_id']."' onclick='return confirm(`Bạn có chắc muốn xóa?`)'
                                                             class='btn btn-danger btn-sm'>
                                                             <i class='far fa-trash-alt'></i>
                                                             <span>Delete</span>
                                                        </a>
                                                     </td>
                                                 </tr>";
                                        }
                                    
                                    }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
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