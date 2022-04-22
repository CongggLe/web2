<?php
    include_once "../../libs/database.php";
    include_once "../../helpers/format.php";
    include_once '../utils/FileUtils.php';
    include_once '../utils/MySQLUtils.php';
    include_once '../model/SanPham.php';

    class Order
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function order_list(){
            $query = "SELECT * FROM tbl_order ORDER BY order_id DESC";
            $result = $this->db->select($query);

            return $result;
        }

        public function order_update($order_status, $id, $array_productId, $array_productQty){
            $order_status = $this->fm->validation($order_status);
            $order_status = mysqli_real_escape_string($this->db->link, $order_status);
            $order_product_id = $array_productId;
            $order_product_qty = $array_productQty;
            $query = "UPDATE tbl_order SET order_status = '$order_status' WHERE order_id = '$id'";
            
            $result = $this->db->update($query);

            if ($result) {

                if($order_status == 1){
                    for($i=0; $i< count($order_product_id); $i++){
                        $get_product_query = "SELECT * FROM tbl_product WHERE product_id = '$order_product_id[$i]'";
                        $get_product_result = $this->db->select($get_product_query);
                        while($get_product = $get_product_result->fetch_assoc()){
                            $product_saled = $get_product['product_quantity'] - $order_product_qty[$i];
                            $update_product_query = "UPDATE tbl_product SET product_quantity = '$product_saled' WHERE product_id = '$order_product_id[$i]'";
                        }
                        $result = $this->db->update($update_product_query);
                    }
                }
            
                

                $alert = "<span class='alert alert-success'>Cập nhật đơn hàng thành công.</span>";

                return $alert;
            } else {
                $alert = "<span class='alert alert-danger'>Cập nhật đơn hàng không thành công.</span>";

                return $alert;
            }
        }

        public function order_delete($id){
            
            $query = "DELETE FROM tbl_order WHERE order_id = '$id'";
            $order_detail = "DELETE FROM tbl_order_detail WHERE order_id = '$id'";

            $result = $this->db->delete($query);
            if ($result) {
                $result = $this->db->delete($order_detail);
                $alert = "<span class='alert alert-success'>Xóa đơn hàng thành công.</span>";

                return $alert;
            } else {
                $alert = "<span class='alert alert-danger'>Xóa đơn hàng không thành công.</span>";

                return $alert;
            }
            return $result;
        }

        public function getorderById($id){
            $query = "SELECT tbl_order.* FROM tbl_order WHERE order_id = '$id'";
            $result = $this->db->select($query);

            return $result;
        }

        public function getorderDetail($id){
            $query = "SELECT  * FROM tbl_order_detail WHERE order_id = '$id'";
            $result = $this->db->select($query);

            return $result;
        }

        public function countNewOrder(){
            $query = "SELECT * FROM tbl_order WHERE order_status = '0'";
            $result = $this->db->select($query);
            if($result){
                
                return $result;
            }

            return false;
        }
        public function get_order_sales($date_start, $date_end){
            $query = "SELECT * FROM tbl_order WHERE (order_status = '1' AND order_date BETWEEN '$date_start' AND '$date_end')"; 
            $result = $this->db->select($query);
            if($result){
                
                return $result;
            }

            return false;
        }
    }
?>