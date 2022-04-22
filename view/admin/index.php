<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard 2</title>

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

        <!----------------------------------------- /.content-wrapper ------------------------------------------>
        <div class="content-wrapper">
            <?php 
                include_once "../../controllers/OrderController.php";
                $order = new Order();
                $count_new_order = $order->countNewOrder();
                $i = 0;
                if($count_new_order){
                    while($result = $count_new_order->fetch_assoc()){
                        $i++;
                    }
                }

            ?>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-6 mt-2">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?php echo $i; ?></h3>
                                    <p>Đơn hàng mới</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="./listorder.php" class="small-box-footer">Đến xem<i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <?php 
                            $date = getdate();
                            switch($date['mon']){
                                case 1:
                                    $date_start = $date['year'].'-'.$date['mon'].'-01';
                                    $date_end = $date['year'].'-'.$date['mon'].'-31';
                                    break;
                                case 2:
                                    $date_start = $date['year'].'-'.$date['mon'].'-01';
                                    $date_end = $date['year'].'-'.$date['mon'].'-28';
                                    break;
                                case 3:
                                    $date_start = $date['year'].'-'.$date['mon'].'-01';
                                    $date_end = $date['year'].'-'.$date['mon'].'-31';
                                    break;
                                case 4:
                                    $date_start = $date['year'].'-'.$date['mon'].'-01';
                                    $date_end = $date['year'].'-'.$date['mon'].'-30';
                                    break;
                                case 5:
                                    $date_start = $date['year'].'-'.$date['mon'].'-01';
                                    $date_end = $date['year'].'-'.$date['mon'].'-31';
                                    break;
                                case 6:
                                    $date_start = $date['year'].'-'.$date['mon'].'-01';
                                    $date_end = $date['year'].'-'.$date['mon'].'-30';
                                    break;
                                case 7:
                                    $date_start = $date['year'].'-'.$date['mon'].'-01';
                                    $date_end = $date['year'].'-'.$date['mon'].'-31';
                                    break;
                                case 8:
                                    $date_start = $date['year'].'-'.$date['mon'].'-01';
                                    $date_end = $date['year'].'-'.$date['mon'].'-31';
                                    break;
                                case 9:
                                    $date_start = $date['year'].'-'.$date['mon'].'-01';
                                    $date_end = $date['year'].'-'.$date['mon'].'-30';
                                    break;
                                case 10:
                                    $date_start = $date['year'].'-'.$date['mon'].'-01';
                                    $date_end = $date['year'].'-'.$date['mon'].'-31';
                                    break;
                                case 11:
                                    $date_start = $date['year'].'-'.$date['mon'].'-01';
                                    $date_end = $date['year'].'-'.$date['mon'].'-30';
                                    break;
                                case 12:
$date_start = $date['year'].'-'.$date['mon'].'-01';
                                    $date_end = $date['year'].'-'.$date['mon'].'-31';
                                    break;           
                            }
                            $get_order_sales = $order->get_order_sales($date_start, $date_end);
                            $total_sales = 0;
                            if($get_order_sales){
                                while($result_sales = $get_order_sales->fetch_assoc()){
                                    $total_sales+= $result_sales['order_total'];
                                }
                            }
                        ?>
                         <div class="col-lg-3 col-6 mt-2">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?php echo  $total_sales.' $';?>
</h3>
                                    <p>Doanh thu trong tháng</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="./listorder.php" class="small-box-footer">Đến xem<i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div> 
                    </div>
                </div>
            </section>
        </div>

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