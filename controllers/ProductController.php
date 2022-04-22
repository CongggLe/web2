<?php
    include_once "../../libs/database.php";
    include_once "../../helpers/format.php";

    class Product
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function product_add($data, $files)
        {
            $product_name = mysqli_real_escape_string($this->db->link, $data["product_name"]);
            $product_price = mysqli_real_escape_string($this->db->link, $data["product_price"]);
            $product_quantity = mysqli_real_escape_string($this->db->link, $data["product_quantity"]);
            $product_desc = mysqli_real_escape_string($this->db->link, $data["product_desc"]);
            $product_keyword = mysqli_real_escape_string($this->db->link, $data["product_keyword"]);
            $category_id = mysqli_real_escape_string($this->db->link, $data["category_id"]);
            $brand_id = mysqli_real_escape_string($this->db->link, $data["brand_id"]);
            $product_status = mysqli_real_escape_string($this->db->link, $data["product_status"]);
            $product_type = mysqli_real_escape_string($this->db->link, $data["product_type"]);
            // Kiểm tra hình ảnh và lấy hình ảnh vào forder
            $permited = array("jpg", "jpeg", "png", "gif");
            $file_name = $_FILES["product_img"]["name"];
            $file_size = $_FILES["product_img"]["size"];
            $file_temp = $_FILES["product_img"]["tmp_name"];

            $div = explode(".", $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).".".$file_ext;
            $uploaded_image = "../../public/uploads/".$unique_image;

            if (empty($product_name) || empty($product_desc) || empty($product_status) || empty($product_keyword) || empty($product_price) || empty($product_quantity) || empty($category_id) || empty($brand_id) || empty($product_type) || $file_name == "") {
                $alert = "<span class='alert alert-danger'>Các trường không được để trống.</span>";

                return $alert;
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_product(product_name, product_img, product_price, product_quantity, product_desc, product_keyword, category_id, brand_id, product_status, product_type) VALUES('$product_name', '$unique_image', '$product_price', '$product_quantity', '$product_desc', '$product_keyword','$category_id', '$brand_id', '$product_status', '$product_type')";
                $result = $this->db->insert($query);

                if ($result) {
                    $alert = "<span class='alert alert-success'>Thêm sản phẩm thành công.</span>";

                    return $alert;
                } else {
                    $alert = "<span class='alert alert-danger'>Thêm sản phẩm không thành công.</span>";

                    return $alert;
                }
            }
        }

        public function product_list(){
            $query = "SELECT tbl_product.*, tbl_category.category_name, tbl_brand.brand_name 
            FROM tbl_product INNER JOIN tbl_category ON tbl_product.category_id = tbl_category.category_id 
            INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id 
            ORDER BY tbl_product.product_id DESC";
            $result = $this->db->select($query);

            return $result;
        }

        public function product_update($data, $files, $id){

            $product_name = mysqli_real_escape_string($this->db->link, $data["product_name"]);
            $product_price = mysqli_real_escape_string($this->db->link, $data["product_price"]);
            $product_quantity = mysqli_real_escape_string($this->db->link, $data["product_quantity"]);
            $product_desc = mysqli_real_escape_string($this->db->link, $data["product_desc"]);
            $product_keyword = mysqli_real_escape_string($this->db->link, $data["product_keyword"]);
            $category_id = mysqli_real_escape_string($this->db->link, $data["category_id"]);
            $brand_id = mysqli_real_escape_string($this->db->link, $data["brand_id"]);
            $product_status = mysqli_real_escape_string($this->db->link, $data["product_status"]);
            $product_type = mysqli_real_escape_string($this->db->link, $data["product_type"]);
            $old_img = mysqli_real_escape_string($this->db->link, $data["old_img"]);
            // Kiểm tra hình ảnh và lấy hình ảnh vào forder
            $permited = array("jpg", "jpeg", "png", "gif");
            $file_name = $_FILES["product_img"]["name"];
            $file_size = $_FILES["product_img"]["size"];
            $file_temp = $_FILES["product_img"]["tmp_name"];

            $div = explode(".", $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).".".$file_ext;
            $uploaded_image = "../../public/uploads/".$unique_image;

            if (empty($product_name) || empty($product_desc) || empty($product_status) || empty($product_keyword) || empty($product_price) || empty($product_quantity) || empty($category_id) || empty($brand_id) || empty($product_type)) {
                $alert = "<span class='alert alert-danger'>Các trường không được để trống.</span>";

                return $alert;
            } else {
                if(!empty($file_name)){
                    if($file_size > 2048567){
                        $alert = "<span class='alert alert-danger'>Kích thước ảnh phải nhỏ hơn 1MB.</span>";
                        
                        return $alert;
                    }elseif(in_array($file_ext, $permited) === false){
                        $alert = "<span class='alert alert-danger'>Bạn chỉ có thể thểm tệp có đuôi .png, .jpg, .jpeg, .gif.</span>";

                        return $alert;
                    }
                    unlink($old_img);
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_product SET product_name = '$product_name', product_img = '$unique_image', product_price = '$product_price', product_quantity = '$product_quantity', product_desc = '$product_desc', product_keyword = '$product_keyword', category_id = '$category_id', brand_id = '$brand_id', product_status = '$product_status',  product_type = '$product_type' WHERE product_id = '$id'";
                }else{
                    $query = "UPDATE tbl_product SET product_name = '$product_name', product_price = '$product_price', product_quantity = '$product_quantity', product_desc = '$product_desc', product_keyword = '$product_keyword', category_id = '$category_id', brand_id = '$brand_id', product_status = '$product_status',  product_type = '$product_type' WHERE product_id = '$id'";
                }
            }

            
            $result = $this->db->update($query);

            if ($result) {
                $alert = "<span class='alert alert-success'>Cập nhật sản phẩm thành công.</span>";

                return $alert;
            } else {
                $alert = "<span class='alert alert-danger'>Cập nhật sản phẩm không thành công.</span>";

                return $alert;
            }
        }

        public function product_delete($id){
            $product = "SELECT * FROM tbl_product WHERE product_id = '$id'";
            $get_product = $this->db->select($product);
            if($get_product = $get_product->fetch_array(MYSQLI_ASSOC)){
                $link_product_img = "../../public/uploads/".$get_product['product_img'];
                unlink($link_product_img);
            }

            $query = "DELETE FROM tbl_product WHERE product_id = '$id'";

            $result = $this->db->delete($query);
            if ($result) {
                $alert = "<span class='alert alert-success'>Xóa sản phẩm thành công.</span>";

                return $alert;
            } else {
                $alert = "<span class='alert alert-danger'>Xóa sản phẩm không thành công.</span>";

                return $result;
            }
            return $alert;
        }

        public function getproductById($id){
            $query = "SELECT tbl_product.* FROM tbl_product WHERE product_id = '$id'";
            $result = $this->db->select($query);

            return $result;
        }
    }
?>