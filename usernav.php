<?php 
    $MyConn = new MyConnect();

        $user_session = $_SESSION['user_email'];

        $query = "SELECT TEN_KH, AVATAR FROM KH WHERE EMAIL='$user_session'";

        $getUser = $MyConn->query($query);

        $row_user = mysqli_fetch_array($getUser);

        $_SESSION['username'] = $row_user['TEN_KH'];
        $_SESSION['user_avatar'] = $row_user['AVATAR'];

        


    

?>
<ul class="navbar-nav ml-auto">


<!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-light "> <?php echo $_SESSION['username']; ?></span>
                        <img class="img-profile rounded-circle"
                            src="<?php echo "admin/customer_images/".$_SESSION['user_avatar'] ?>" width="20" height="20">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item small" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2"></i>
                            Hồ Sơ
                        </a>
                        <a class="dropdown-item small" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Chỉnh Sửa Hồ Sơ
                        </a>
                        <a class="dropdown-item small" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Nhật Ký Mua Hàng
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item small" href="logout.php" name="logout">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Đăng Xuất
                        </a>
                        
                    </div>
                </li>

            </ul>