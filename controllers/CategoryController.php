<?php
    include_once "../../libs/database.php";
    include_once "../../helpers/format.php";

    class Category
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function category_add($category_name, $category_desc, $category_keyword ,$category_status)
        {
            $category_name = $this->fm->validation($category_name);
            $category_desc = $this->fm->validation($category_desc);
            $category_keyword = $this->fm->validation($category_keyword);
            $category_status = $this->fm->validation($category_status);

            $category_name = mysqli_real_escape_string($this->db->link, $category_name);
            $category_desc = mysqli_real_escape_string($this->db->link, $category_desc);
            $category_keyword = mysqli_real_escape_string($this->db->link, $category_keyword);
            $category_status = mysqli_real_escape_string($this->db->link, $category_status);

            if (empty($category_name) || empty($category_desc) || $category_status == "" || empty($category_keyword)) {
                $alert = "<span class='alert alert-danger'>Các trường không được để trống.</span>";

                return $alert;
            } else {
                $query = "INSERT INTO tbl_category(category_name, category_desc, category_keyword, category_status) VALUES('$category_name', '$category_desc', '$category_keyword', '$category_status')";
                $result = $this->db->insert($query);

                if ($result) {
                    $alert = "<span class='alert alert-success'>Thêm danh mục thành công.</span>";

                    return $alert;
                } else {
                    $alert = "<span class='alert alert-danger'>Thêm danh mục không thành công.</span>";

                    return $alert;
                }
            }
        }

        public function category_list(){
            $query = "SELECT * FROM tbl_category ORDER BY category_id DESC";
            $result = $this->db->select($query);

            return $result;
        }

        public function category_update($category_name, $category_desc, $category_keyword, $category_status, $id){
            $category_name = $this->fm->validation($category_name);
            $category_desc = $this->fm->validation($category_desc);
            $category_keyword = $this->fm->validation($category_keyword);
            $category_status = $this->fm->validation($category_status);

            $category_name = mysqli_real_escape_string($this->db->link, $category_name);
            $category_desc = mysqli_real_escape_string($this->db->link, $category_desc);
            $category_keyword = mysqli_real_escape_string($this->db->link, $category_keyword);
            $category_status = mysqli_real_escape_string($this->db->link, $category_status);
            $id = mysqli_real_escape_string($this->db->link, $id);

            if (empty($category_name) || empty($category_desc) || $category_status == "" || empty($category_keyword)) {
                $alert = "<span class='alert alert-danger'>Các trường không được để trống.</span>";
        
                return $alert;
            } else {
                $query = "UPDATE tbl_category SET category_name = '$category_name', category_desc = '$category_desc', category_keyword = '$category_keyword', category_status = '$category_status' WHERE category_id = '$id'";
                $result = $this->db->update($query);

                if ($result) {
                    $alert = "<span class='alert alert-success'>Cập nhật danh mục thành công.</span>";

                    return $alert;
                } else {
                    $alert = "<span class='alert alert-danger'>Cập nhật danh mục không thành công.</span>";

                    return $alert;
                }
            }
        }

        public function category_delete($id){
            $query = "DELETE FROM tbl_category WHERE category_id = '$id'";
            $result = $this->db->delete($query);
            if ($result) {
                $alert = "<span class='alert alert-success'>Xóa danh mục thành công.</span>";

                return $alert;
            } else {
                $alert = "<span class='alert alert-danger'>Xóa danh mục không thành công.</span>";

                return $alert;
            }
            return $result;
        }

        public function getCategoryById($id){
            $query = "SELECT * FROM tbl_category WHERE category_id = '$id'";
            $result = $this->db->select($query);

            return $result;
        }

        public function getCategory(){
            $query = "SELECT * FROM tbl_category WHERE category_status = '1'";
            $result = $this->db->select($query);

            return $result;
        }
    }
?>