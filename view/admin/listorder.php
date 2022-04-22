<?php
    include_once "../../controllers/OrderController.php";
    include_once "../../helpers/format.php";
    $fm = new Format();
    $order = new Order();
    if(isset($_GET["delete_id"])){
        $id = $_GET["delete_id"];
        $order_delete = $order->order_delete($id);
        
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liệt kê đơn hàng</title>

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
                    <h3 class="card-title">Liệt kê đơn hàng</h3>
                    <div class="text-center">
                        <?php
                            if(isset($order_delete)){
                                echo $order_delete;
                                
                            }
                        ?>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card m-1">

                    <div class="card-body p-0 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Id đơn hàng</th>
                                    <th>Tên khách hàng</th>
                                    <th>Email khách hàng</th>
                                    <th>Số điện thoại giao hàng</th>
                                    <th>Địa chỉ giao hàng</th>
                                    <th>Ghi chú khách hàng</th>
                                    <th>Tổng đơn hàng</th>
                                    <th>Ngày đặt hàng</th>
                                    <th>Trạng thái</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $show_order = $order->order_list();
                                    if($show_order){
                                        $i = 0;
                                        while($result = $show_order->fetch_assoc()){
                                            $i++;
                                            if($result['order_status'] == 1){
                                                $order_status = "<span class='badge badge-secondary'>Đã giao</span>";
                                            }else{
                                                $order_status = "<span class='badge badge-success'>Đơn mới</span>";
                                            }
                                            
                                            echo "<tr>
                                                    <td>".$i."</td>
                                                    <td>".$result['order_id']."</td>
                                                    <td>".$result['customer_name']."</td>
                                                    <td>".$result['customer_email']."</td>
                                                    <td>".$result['customer_phone']."</td>
                                                    <td>".$result['customer_address']."</td>
                                                    <td>".$fm->textShorten($result['customer_note'], 50)."</td>
                                                    <td>$".number_format($result['order_total'])."</td>
                                                    <td>".$result['order_date']."</td>
                                                    <td class='text-center'>".$order_status."</td>
                                                    <td>
                                                        <a href='editorder.php?order_id=".$result['order_id']."' class='btn btn-success btn-sm'>
                                                             <i class='far fa-edit'></i>
                                                             <span>Edit</span>
                                                        </a>
                                                        <a href='?delete_id=".$result['order_id']."' onclick='return confirm(`Bạn có chắc muốn xóa?`)'
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