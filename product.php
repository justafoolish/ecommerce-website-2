<?php

session_start();

include("admin/includes/database.php");
$MyConn = new MyConnect();

$queryCat = "SELECT TEN_LOAISP, COUNT(SP.MA_SP) AS SOLUONG FROM LOAISP, SP WHERE SP.MA_LOAISP = LOAISP.MA_LOAISP GROUP BY LOAISP.MA_LOAISP";
$result = $MyConn->query($queryCat);

$queryMan = "SELECT TEN_HANGSX FROM HANGSX";
$resultMan = $MyConn->query($queryMan);


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>eCommerce</title>
  <meta charset="utf-8">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <style>
      
      .nl {
          color: white !important;
      }
      .nl:hover {
        color: #ffc108 !important;
      }
    
        .swch:focused {
            outline: none !important;
            box-shadow: none !important;
        }
        :checked {
            color: #ffc108 !important;
        }
        .p:hover {
    box-shadow: 0 0 11px rgba(33,33,33,.2); 
}
  </style>
</head>
<body>
    <!-- Start nav -->
    <nav class="navbar navbar-expand-lg navbar-dark  bg-gradient bg-dark sticky-top shadow-lg py-2">
        <div class="container">
            <a class="navbar-brand" href="index.php"><span class="text-warning">e</span class="sr-only">Commerce</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
    
        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link nl" href="index.php">Trang Chủ <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link nl" href="product.php">Sản Phẩm</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nl " href="#">Giới Thiệu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nl" href="#">Liên Hệ</a>
            </li>
            
          </ul>

          <form class="form-inline">
            <input class="form-control-sm mr-sm-2 border-0" type="search" placeholder="Search" aria-label="Search">
            <button class="btn my-sm-0 "><a href="" class="text-light"><i class="fas fa-search"></i></a></i></button>
            <a class="btn my-sm-0 border-0 bg-transparent text-light"><i class="fas fa-shopping-cart"></i></a>
            <?php
            if(!isset($_SESSION['user_email'])) {

               echo  "<a class='btn my-sm-0 border-0' data-toggle='modal' data-target='#loginModal'><i class='fas fa-user text-light'></i></a>";

            }
            else {

                include("usernav.php");
            }
            ?>
          </form>
        </div>        
    </nav>
    <!-- End nav-->

    <!-- Main content Product page -->
    <div class="container my-5 p-1">
        <div class="row">
            <div class="col-md-3">
                <div class="row">
                    <div class="card border-0">
                        <div class="card-header bg-transparent "><h4>Danh Mục Sản Phẩm</h4></div>
                        <div class="card-body p-2">
                        <ul class="list-group-flush pl-0">

                            <?php 
                                while($getCat = mysqli_fetch_array($result)) {
                                    $catName = $getCat['TEN_LOAISP'];
                                    $catQty = $getCat['SOLUONG'];
                            ?>      
                                
                            <li class="list-group-item d-flex align-items-center border-0 form-check">
                                <input type="checkbox" id="catCheck" class="mr-2">
                                <label class="form-check-label" for="catCheck"><?php echo $catName; ?></label>
                                <span class="badge badge-primary badge-pill ml-auto" style="background-color: #ffc108 !important;"><?php echo $catQty ?></span>
                            </li>
                            <?php } ?>
                            </ul>
                        </div>
                    </div> <!-- close card -->
                </div>
                <!-- close row -->

                <div class="row">
                    <div class="card border-0 mt-4">
                        <div class="card-header bg-transparent mt-4"><h4>Thương Hiệu</h4></div>
                        <div class="card-body p-2">
                            <ul class="list-group-flush pl-0"> 
                                <?php 
                                    while($getMan = mysqli_fetch_array($resultMan)) {
                                        $manName = $getMan['TEN_HANGSX'];
                                ?>
                                <li class="list-group-item d-flex align-items-center border-0 form-check">
                                    <input type="checkbox" id="catCheck" class="mr-2">
                                    <label class="form-check-label" for="catCheck"><?php echo $manName; ?></label>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- close row -->
                <div class="row">
                    <div class="card border-0">
                        <div class="card-body p2">
                            <span>
                                <label for="sort">Sắp Xếp </label>
                                <select name="sortby" id="sort" class=" form-control-sm">
                                    <option value="name">Tên</option>
                                    <option value="price">Giá</option>
                                </select>
                            </span>
                            <span>
                                <select name="" id="" class=" form-control-sm">
                                    <option value="">Tăng Dần</option>
                                    <option value="">Giảm Dần</option>
                                </select>
                            </span>
                        </div>
                        <button type="submit" class="btn btn-secondary text-light mt-3" >Áp Dụng</button>
                    </div>
                </div>
            </div>
            <!-- close first col -->
            <div class="col-md-9">
                <div class="row mt-0 ml-4 card-deck">
                <?php 

                    $queryCount = $MyConn->query("SELECT * FROM SP");
                    $limit = 0;
                    
                    $cur_page = 1;

                    $result_per_page = 6;

                    if(isset($_GET['page'])) {
                        $cur_page = $_GET['page'];

                        $limit = ($cur_page - 1) * $result_per_page;
                    }
                    
                    $i = 0;
                    $queryP = "SELECT * FROM SP LIMIT $limit,$result_per_page";

                    $resultP = $MyConn->query($queryP);

                    $countP = mysqli_num_rows($queryCount);


                    $number_of_page = ceil($countP / $result_per_page);

                    while($getP = mysqli_fetch_array($resultP)) {
                        
                        if($i%3 == 0 && $i != 0) {
                            echo "</div><div class='row mt-3 ml-4 card-deck'>";
                        }                        
                ?>
                    <div class="col-md-4 p-1 mt-3">
                        <a href="detail.php?productID=<?php echo $getP['MA_SP'] ?>" class="text-decoration-none text-dark">
                            <div class="card card-link h-100 p-0 p">
                                <div class="card-header p-0 border-bottom-0 h-100">
                                    <img src="<?php echo "admin/product_images/".$getP['HINHANH_SP'] ?>" class="card-img-top h-100 img-reponsive">
                                </div> <!-- close card header -->
                                <div class="card-body p-0">
                                    <div class="card-title text-center mt-4">
                                        <h6 class="font-weight-bold"><?php echo $getP['TEN_SP'] ?></h6>
                                        <div class="font-weight-bold text-danger"><?php echo $getP['GIA'] ?><sup>đ</sup></div>
                                    </div>
                                </div> 
                                <div class="card-footer border-top-0 bg-transparent mt-3">
                                    <button class="btn btn-warning w-100 mt-auto text-white"><i class="fas fa-cart-plus"></i> Thêm Vào Giỏ</button>

                                </div>
                                <!-- close card body -->
                            </div> <!-- close card -->
                        </a>
                    </div> <!-- close col -->
                    <?php } ?>
                </div> <!-- close row -->
                <div class="row">
                <ul class="pagination mt-3 mr-3 ml-auto">
                    <?php 
                        if($cur_page == 1) {
                            $start_disable = "disabled";
                            
                        }
                    ?>
                    <li class="page-item text-warning <?php if($cur_page == 1) echo "disabled"; ?>">
                        <a class="page-link <?php if($cur_page != 1) echo "text-warning"; ?>" href="product.php?page=<?php echo $cur_page-1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php 
                        for($page = 1; $page <= $number_of_page; $page++) {
                            
                    ?>
                    <li class="page-item <?php if($cur_page == $page) echo "disabled" ?>">
                        <a class="page-link <?php if($cur_page != $page) echo "text-warning"; ?>" href="product.php?page=<?php echo $page ?>"><?php echo $page ?></a>
                    </li>
                    <?php } ?>
                    <li class="page-item <?php if($cur_page == $number_of_page) echo "disabled"; ?>">
                    <a class="page-link <?php if($cur_page != $number_of_page) echo "text-warning"; ?>" href="product.php?page=<?php echo $cur_page+1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>
                </ul>
                </div>
            </div> <!-- close col -->
        </div><!-- close big row -->
    </div> <!-- close container -->  

    <!-- End content -->

    <!-- Footer Cố định -->
    <footer class="bg-dark">
        <div class="container-fuild text-light">
            <div class="card-deck pt-3">
                    
                    <div class="card border-0 bg-dark ml-5">
                        <div class="card-header bg-dark border-0"><h4>HỆ THỐNG CỬA HÀNG</h4></div>
                        <div class="card-body border-0">
                            <p>Chi nhánh 1:     273, An Dương Vương, Quận 5, Tp.HCM</p>
                            <p>Chi nhánh 2:     105, Bà Huyện Thanh Quan, Quận 3, Tp.HCM</p>
                            <p>Chi nhánh 3:     4, Tôn Đức Thắng, Quận 1, Tp.HCM</p>
                        </div>
                    </div>
                    
                    <div class="card border-0 bg-dark">
                        <div class="card-header bg-dark border-0"><h4>CHÍNH SÁCH & DỊCH VỤ</h4></div>
                        <div class="card-body border-0">
                            <a style="color: white;" href="#"><i class="fas fa-truck mr-2" aria-hidden="true"></i>Vận chuyển</a> <br>
                            <a style="color: white;" href="#"><i class="fas fa-money-check-alt"></i> Thanh toán</a> <br>
                            <a style="color: white;" href="#"><i class="fas fa-exchange-alt"></i> Đổi trả</a>
                        </div>
                    </div>
                    
                    <div class="card border-0 bg-dark mr-1">
                        <div class="card-header bg-dark border-0"><h4>LIÊN HỆ</h4></div>
                        <div class="card-body border-0">
                            <p>Điện thoại: 0123456789 <br> Email: hotro@hotro.com</p>
                        </div>
                    </div>
            </div>
        </div>
        <hr style="background-color: white; height: 1px; margin: 0; padding: 0;">
        <div class="container-fluid text-center text-light p-1">
            <h7>Copyright © 2021. Powered by eCommerce</h7>
        </div>
    </footer>













    <?php include("login_registry_modal.php"); ?>
  

</body>
</html>