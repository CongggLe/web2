<?php
    include_once "../../libs/database.php";
    include_once "../../helpers/format.php";

    class Brand
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function brand_add($brand_name, $brand_desc, $brand_keyword, $brand_status)
        {
            $brand_name = $this->fm->validation($brand_name);
            $brand_desc = $this->fm->validation($brand_desc);
            $brand_keyword = $this->fm->validation($brand_keyword);
            $brand_status = $this->fm->validation($brand_status);

            $brand_name = mysqli_real_escape_string($this->db->link, $brand_name);
            $brand_desc = mysqli_real_escape_string($this->db->link, $brand_desc);
            $brand_keyword = mysqli_real_escape_string($this->db->link, $brand_keyword);
            $brand_status = mysqli_real_escape_string($this->db->link, $brand_status);

            if (empty($brand_name) || empty($brand_desc) || $brand_status == "" || empty($brand_keyword)) {
                $alert = "<span class='alert alert-danger'>Các trường không được để trống.</span>";

                return $alert;
            } else {
                $query = "INSERT INTO tbl_brand(brand_name, brand_desc, brand_keyword, brand_status) VALUES('$brand_name', '$brand_desc', '$brand_keyword', '$brand_status')";
                $result = $this->db->insert($query);

                if ($result) {
                    $alert = "<span class='alert alert-success'>Thêm thương hiệu thành công.</span>";

                    return $alert;
                } else {
                    $alert = "<span class='alert alert-danger'>Thêm thương hiệu không thành công.</span>";

                    return $alert;
                }
            }
        }

        public function brand_list(){
            $query = "SELECT * FROM tbl_brand ORDER BY brand_id DESC";
            $result = $this->db->select($query);

            return $result;
        }

        public function brand_update($brand_name, $brand_desc, $brand_keyword, $brand_status, $id){
            $brand_name = $this->fm->validation($brand_name);
            $brand_desc = $this->fm->validation($brand_desc);
            $brand_keyword = $this->fm->validation($brand_keyword);
            $brand_status = $this->fm->validation($brand_status);

            $brand_name = mysqli_real_escape_string($this->db->link, $brand_name);
            $brand_desc = mysqli_real_escape_string($this->db->link, $brand_desc);
            $brand_keyword = mysqli_real_escape_string($this->db->link, $brand_keyword);
            $brand_status = mysqli_real_escape_string($this->db->link, $brand_status);
            $id = mysqli_real_escape_string($this->db->link, $id);

            if (empty($brand_name) || empty($brand_desc) || $brand_status == "" || empty($brand_keyword)) {
                $alert = "<span class='alert alert-danger'>Các trường không được để trống.</span>";

                return $alert;
            } else {
                $query = "UPDATE tbl_brand SET brand_name = '$brand_name', brand_desc = '$brand_desc', brand_keyword = '$brand_keyword', brand_status = '$brand_status' WHERE brand_id = '$id'";
                $result = $this->db->update($query);

                if ($result) {
                    $alert = "<span class='alert alert-success'>Cập nhật thương hiệu thành công.</span>";

                    return $alert;
                } else {
                    $alert = "<span class='alert alert-danger'>Cập nhật thương hiệu không thành công.</span>";

                    return $alert;
                }
            }
        }

        public function brand_delete($id){
            $query = "DELETE FROM tbl_brand WHERE brand_id = '$id'";
            $result = $this->db->delete($query);
            if ($result) {
                $alert = "<span class='alert alert-success'>Xóa thương hiệu thành công.</span>";

                return $alert;
            } else {
                $alert = "<span class='alert alert-danger'>Xóa thương hiệu không thành công.</span>";

                return $alert;
            }
            return $result;
        }

        public function getBrandById($id){
            $query = "SELECT * FROM tbl_brand WHERE brand_id = '$id'";
            $result = $this->db->select($query);

            return $result;
        }

        public function getBrand(){
            $query = "SELECT * FROM tbl_brand WHERE brand_status = '1'";
            $result = $this->db->select($query);

            return $result;
        }
    }
?>