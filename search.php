<?php

session_start();

include("admin/includes/database.php");
$MyConn = new MyConnect();


if(!isset($_GET['keyword'])) {

    echo "<script>window.history.back()</script>";

}
else if($_GET['keyword'] == "") {

    echo "<script>alert('Vui lòng nhập thông tin sản phẩm cần tìm kiếm');</script>";

    echo "<script>window.history.back();</script>";

}
else {

    $keyword = $_GET['keyword'];
}

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
  <script type="text/javascript" src="js/cart_process.js"></script>
  <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

  <style>
      .nav-link {
          color: white !important;
      }
      .nav-link:hover {
        color: #ffc108 !important;
      }
      .cart-amount {
        top: -13px;
        right: -10px;
        min-width: 20px;
        min-height: 20px;
        border-width: 2px;
        border-radius: 50%;
        font-size: 12px;
    }
            #price-min {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-right: 0;
        }

        #price-max {
        border-left: 0;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        }
        .p:hover {
    box-shadow: 0 0 11px rgba(33,33,33,.2); 
}

  </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark  bg-gradient bg-dark sticky-top shadow-lg py-2">
        <div class="container">
            <a class="navbar-brand" href="index.php"><span class="text-warning">e</span class="sr-only">Commerce</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
    
        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Trang Chủ <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="product.php">Sản Phẩm</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Giới Thiệu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Liên Hệ</a>
            </li>
            
          </ul>

          <form class="form-inline" method="get" action="search.php">
            <input class="form-control-sm mr-sm-2 border-0" type="search" name="keyword"  placeholder="Tìm kiếm sản phẩm" aria-label="Search">
            <button class="btn my-sm-0 "><a class="text-light"><i class="fas fa-search"></i></i></a></button>
            <a href="cart.php" class="btn my-sm-0 border-0 bg-transparent text-light">
                <i class="fas fa-shopping-cart position-relative">
                <?php
                    
                    $total_price = 0;
                    $total_qty = 0;
                    if(isset($_SESSION['cart'])) {
                        foreach($_SESSION['cart'] as $value) {
                            $total_qty += $value["quantity"];
                            $total_price += (int)$value["price"]*$value["quantity"];
                        } 
                    }
                ?>
                <div class="cart-amount bg-info position-absolute text-white d-flex justify-content-center align-items-center font-weight-bold">
                <span id="cart_amount"><?php echo $total_qty ?></span>
                </div></i>
            </a>
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

    <div aria-live="polite" aria-atomic="true" style="bottom: 0; right: 0; z-index: 1200;" class="position-fixed">
            <div class="toast bg-success font-weight-bold p-2 text-light">
                <div class="toast-body">
                        Sản Phẩm Đã Được Thêm Vào Giỏ Hàng
                </div>
            </div>
    </div>
    
    <div class="container jumbotron mt-3 p-2">
            <div class="row pl-1">
                <div class="col-md-3">
                    <div class="btn-group">
                        <a href="#" class="btn-sm mr-1 btn-secondary text-decoration-none">Liên Quan</a>
                        <a href="#" class="btn-sm mr-1 btn-secondary text-decoration-none">Bán Chạy</a>

                        <a href="#" class="btn-sm mr-1 btn-secondary text-decoration-none">Mới Nhất</a>

                    </div>
                </div>
                <div class="col-md-2">
                    <select name="" id="" class="custom-select-sm border-0 bg-secondary rounded text-light text-center">
                        <option>Theo Loại Sản Phẩm</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="" id="" class="custom-select-sm border-0 bg-secondary text-light rounded">
                        <option>Theo Nhà Sản Xuất</option>
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <label class="mx-3" for="inputsm"><h5>Giá</h5></label>
                    <input class="mx-3 form-control-sm input-sm border-0 text-center" id="inputsm" type="number" min=0 placeholder="Từ" step="10000">
                    <input class="ml-2 form-control-sm input-sm border-0 text-center" id="inputsm" type="number" min=0 placeholder="Đến" step="10000">

                </div>
            </div>


            <div class="row d-flex flex-row-reverse px-1">
                <button class="btn btn-success ml-auto mr-4">Lọc Sản Phẩm</button>
            </div>
    </div>

    <div class="container mt-5 p-3">
    <?php 
        $queryCount = $MyConn->query("SELECT * FROM SP WHERE SP.TEN_SP LIKE '%$keyword%'");

        $countP = mysqli_num_rows($queryCount);

        if($countP == 0) {

            echo "<div class='row my-5'> <div class='col-md-12 text-center'> <h3> Không tìm thấy sản phẩm cho từ khóa $keyword </h3> </div> </div>";
        
        }
        else {

    ?>
        <h3>Kết Quả Tìm Kiếm:   <?php echo $countP; ?></h3>
        <div class="row my-4">
            <?php 

            $limit = 0;

            $cur_page = 1;

            $result_per_page = 8;

            if(isset($_GET['page'])) {
                $cur_page = $_GET['page'];

                $limit = ($cur_page - 1) * $result_per_page;
            }

            $i = 0;
            $queryP = "SELECT * FROM SP WHERE SP.TEN_SP LIKE '%$keyword%' LIMIT $limit,$result_per_page";

            $resultP = $MyConn->query($queryP);


            $number_of_page = ceil($countP / $result_per_page);

            while($getP = mysqli_fetch_array($resultP)) {
                
                if($i%3 == 0 && $i != 0) {
                    echo "</div><div class='row mt-3 ml-4 card-deck'>";
                }                        
            ?>
            <div class="col-md-3 p-1 mt-3">
                    <div class="card card-link h-100 p-0 p">
                        <div class="card-header p-0 border-bottom-0 h-100">
                        <a href="detail.php?productID=<?php echo $getP['MA_SP'] ?>" class="text-decoration-none text-dark">
                            <img src="<?php echo "admin/product_images/".$getP['HINHANH_SP'] ?>" class="card-img-top h-100 img-reponsive">
                        </a>
                        </div> <!-- close card header -->
                        <div class="card-body p-0">
                        <a href="detail.php?productID=<?php echo $getP['MA_SP'] ?>" class="text-decoration-none text-dark">
                            <div class="card-title text-center mt-4">
                                <h6 class="font-weight-bold"><?php echo $getP['TEN_SP'] ?></h6>
                                <div class="font-weight-bold text-danger"><?php echo number_format($getP['GIA'],0,",","."); ?><sup>đ</sup></div>
                            </div>
                        </a>
                        </div> 
                        <div class="card-footer border-top-0 bg-transparent mt-3">
                            <button id="myBtn" onclick="addCart('<?php echo $getP['MA_SP'] ?>')" class="btn btn-warning w-100 mt-auto text-white"><i class="fas fa-cart-plus"></i> Thêm Vào Giỏ</button>

                        </div>
                        <!-- close card body -->
                    </div> <!-- close card -->
            </div> <!-- close col -->
            <?php } ?>

        </div>
        <?php 
            if($countP > $result_per_page) {
        ?>
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
        </div>

        <?php }} ?>
    </div>
    
    <footer class="bg-dark">
        <div class="container-fuild text-light">
            <div class="row card-deck pt-3">
                <div class="col-md-5 pr-0">
                    <div class="card border-0 bg-dark ml-4">
                        <div class="card-header bg-dark border-0"><h4>HỆ THỐNG CỬA HÀNG</h4></div>
                        <div class="card-body border-0">
                            <p>Chi nhánh 1:     273, An Dương Vương, Quận 5, Tp.HCM</p>
                            <p>Chi nhánh 2:     105, Bà Huyện Thanh Quan, Quận 3, Tp.HCM</p>
                            <p>Chi nhánh 3:     4, Tôn Đức Thắng, Quận 1, Tp.HCM</p>
                        </div>
                    </div>
                </div>
                <div class="col-md pl-0">
                    <div class="card border-0 bg-dark ml-4">
                        <div class="card-header bg-dark border-0"><h4>CHÍNH SÁCH & DỊCH VỤ</h4></div>
                        <div class="card-body border-0">
                            <a href="#" class="text-light text-decoration-none pb-3"><i class="fas fa-shipping-fast mr-2"></i>Vận chuyển</a><br>
                            <a href="#" class="text-light text-decoration-none pb-3"><i class="fas fa-money-check-alt mr-2"></i>Thanh toán</a><br>
                            <a href="#" class="text-light text-decoration-none pb-3"><i class="fas fa-exchange-alt mr-2"></i>Đổi trả</a>
                        </div>
                    </div>
                </div> 
                <div class="col-md">
                    <div class="card border-0 bg-dark mx-0 ml-4">
                        <div class="card-header bg-dark border-0"><h4>LIÊN HỆ</h4></div>
                        <div class="card-body border-0">
                            <p><i class="fas fa-phone-alt mr-2"></i> 0123456789 <br>
                            <i class="fas fa-envelope-open-text mr-2"></i> hotro@hotro.com</p>
                        </div>
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
    <script type="text/javascript" src="js/addCart.js"></script>

    
</body>
</html>