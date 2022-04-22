<?php
    include_once "../../libs/session.php";
    include_once "../../libs/database.php";
    include_once "../../helpers/format.php";

    class AdminRegister
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function admin_register($admin_name, $admin_email, $admin_password){
            $admin_name = $this->fm->validation($admin_name);
            $admin_email = $this->fm->validation($admin_email);
            $admin_password = $this->fm->validation($admin_password);

            $admin_name = mysqli_real_escape_string($this->db->link, $admin_name);
            $admin_email = mysqli_real_escape_string($this->db->link, $admin_email);
            $admin_password = mysqli_real_escape_string($this->db->link, $admin_password);

            if(empty($admin_name) || empty($admin_email) || empty($admin_password)){
                $alert = "<span class='alert alert-danger'>Các trường không được để trống.</span>";

                return $alert;
            }else{
                $query = "INSERT INTO tbl_admin(admin_name, admin_email, admin_password, admin_role) VALUES('$admin_name', '$admin_email', '$admin_password', '0')";
                $result = $this->db->insert($query);

                if ($result) {
                    $alert = "<span class='alert alert-success'>Đăng ký thành công.</span>";

                    return $alert;
                } else {
                    $alert = "<span class='alert alert-danger'>Đăng ký không thành công.</span>";

                    return $alert;
                }
            }
        }
    }
?>