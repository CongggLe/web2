<?php
    include_once "../../controllers/OrderController.php";
    if(!isset($_GET["order_id"]) || $_GET["order_id"] == NULL){
        echo "<script>windown.location = 'listorder.php'</script>";
    }else{
        $id = $_GET["order_id"];
    }
    $order_detail = new Order();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $order_status = $_POST['order_status'];
        $array_productId = $_POST['product_id'];
        $array_product_qty = $_POST['product_sale_qty'];
        $order_update = $order_detail->order_update($order_status, $id, $array_productId, $array_product_qty);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cập nhật đơn hàng</title>

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
                    <h3 class="card-title">Cập nhật đơn hàng</h3>
                    <div class="text-center">
                        <?php
                            if(isset($order_update)){
                                echo $order_update;
                            }
                        ?>
                    </div>
                </div>
                <!-- /.card-header -->
                <?php
                    $get_order = $order_detail->getorderById($id);
                    if($get_order){
                        
                        while($result = $get_order->fetch_assoc()){
                            if($result['order_status'] == 1){
                                $order_status =  "<div class='form-group'>
                                    <label for='order_status'>Trạng thái</label>
                                    <select id='order_status' name='order_status' class='form-control custom-select'>
                                        <option selected value='1'>Đã giao</option>
                                    </select>
                                </div>";
                            }else{
                                $order_status =  "<div class='form-group'>
                                    <label for='order_status'>Trạng thái</label>
                                    <select id='order_status' name='order_status' class='form-control custom-select'>
                                        <option  value='1'>Đã giao</option>
                                        <option selected value='0'>Đơn mới</option>
                                    </select>
                                </div>";
                            }
                ?>
                <form action="" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="customer_name">Tên khách hàng</label>
                            <input type="text" class="category_name form-control" id="customer_name"
                                value="<?php echo $result['customer_name'] ?>" name="customer_name" disabled>
                        </div>
                        <div class="form-group">
                            <label for="customer_email">Email khách hàng</label>
                            <input type="text" class="category_desc form-control" id="customer_email"
                                value="<?php echo $result['customer_email'] ?>" name="customer_email" disabled>
                        </div>
                        <div class="form-group">
                            <label for="customer_phone">Số điện thoại</label>
                            <input type="text" class="category_keyword form-control" id="customer_phone"
                                value="<?php echo $result['customer_phone'] ?>" name="customer_phone" disabled>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="customer_note">Ghi chú của khách hàng</label>
                                <textarea id="customer_note" class="form-control" rows="3"
                                    disabled><?php echo $result['customer_note'] ?></textarea>
                            </div>
                        </div>
                        <?php echo $order_status?>
                    </div>
                    <!-- /.card-body -->

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Tổng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $get_order_detail = $order_detail->getorderDetail($id);
                                $total = 0;
                                if($get_order_detail){
                                $i = 0;
                                    while($result_order = $get_order_detail->fetch_assoc()){
                                        $i++;
                                        $total+= $result_order['product_sale_qty']*$result_order['product_price_sale'];
                                        echo "<tr>
                                        <td>".$i."</td>
                                        <td>".$result_order['product_name']."</td>
                                        <td>".$result_order['product_sale_qty']."</td>
                                        <input type='hidden' name='product_id[]' value=".$result_order['product_id'].">
                                        <input type='hidden' name='product_sale_qty[]' value=".$result_order['product_sale_qty'].">
                                        <td>".number_format($result_order['product_price_sale'])."</td>
                                        <td>".number_format($result_order['product_sale_qty']*$result_order['product_price_sale'])."</td>
                                        </tr>";
                                    }
                                }
                                ?>
                            <td colspan="4" style="text-align: right">Tổng bill :</td>
                            <td> $<?php echo number_format($total) ?></td>
                        </tbody>
                    </table>
            </div>
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
    <script src="../../public/admin/plugins/jquery/jquery.min.js">
    < /scrip> <!--Bootstrap-- > <
    script src = "../../public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js" >
    </script>
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