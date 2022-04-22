<?php
    include_once "../../libs/session.php";
    include_once "../../libs/database.php";
    include_once "../../helpers/format.php";
    Session::checkLogin();

    class AdminLogin
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function admin_login($admin_email, $admin_password)
        {
            $admin_email = $this->fm->validation($admin_email);
            $admin_password = $this->fm->validation($admin_password);

            $admin_email = mysqli_real_escape_string($this->db->link, $admin_email);
            $admin_password = mysqli_real_escape_string($this->db->link, $admin_password);

            if (empty($admin_email) || empty($admin_password)) {
                $alert = "Email và Password không được để trống.";

                return $alert;
            } else {
                $query = "SELECT * FROM tbl_admin WHERE admin_email = '$admin_email' AND admin_password = '$admin_password' LIMIT 1";
                $result = $this->db->select($query);

                if ($result != false) {
                    $value = $result->fetch_assoc();
                    Session::set("admin_login", true);
                    Session::set("admin_id", $value["admin_id"]);
                    Session::set("admin_email", $value["admin_email"]);
                    Session::set("admin_name", $value["admin_name"]);

                    header("Location:index.php");
                } else {
                    $alert = "Email hoặc Password không đúng.";

                    return $alert;
                }
            }
        }

    }
?>