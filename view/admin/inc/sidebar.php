<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="../../public/uploads/admin.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Chào <?php echo Session::get("admin_name")?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info d-flex justify-content-between">
                <?php
                    if(isset($_GET["action"]) && $_GET["action"] == "logout"){
                        Session::destroy();
                        echo("<script>location.reload()</script>");
                    }
                    
                ?>

                <a href="?action=logout" class="btn btn-danger btn-sm">
                    <i class="fas fa-key"></i>
                    <p>Đăng xuất</p>
                </a>
                <a href="./register.php" class="btn btn-success btn-sm mx-2">
                    <i class="fas fa-user-plus"></i>
                    <p>Tạo tài khoản</p>
                </a>
            </div>
        </div>


        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="far fa-copyright nav-icon"></i>
                        <p>
                            Danh mục
                            <i class="right fas fa-angle-left"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./addcategory.php" class="nav-link">
                                <i class="fas fa-plus-square nav-icon"></i>
                                <p>Thêm danh mục</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./listcategory.php" class="nav-link">
                                <i class="fas fa-list-ol nav-icon"></i>
                                <p>Liệt kê danh mục</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="fab fa-blogger nav-icon"></i>
                        <p>
                            Thương hiệu
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./addbrand.php" class="nav-link">
                                <i class="fas fa-plus-square nav-icon"></i>
                                <p>Thêm thương hiệu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./listbrand.php" class="nav-link">
                                <i class="fas fa-list-ol nav-icon"></i>
                                <p>Liệt kê thương hiệu</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="fab fa-product-hunt"></i>
                        <p>
                            Sản phẩm
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./addproduct.php" class="nav-link">
                                <i class="fas fa-plus-square nav-icon"></i>
                                <p>Thêm sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./listproduct.php" class="nav-link">
                                <i class="fas fa-list-ol nav-icon"></i>
                                <p>Liệt kê sản phẩm</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-clipboard-list"></i>
                        <p>
                            Đơn hàng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./listorder.php" class="nav-link">
                                <i class="fas fa-list-ol nav-icon"></i>
                                <p>Liệt kê Đơn hàng</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>