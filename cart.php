<?php

session_start();

include("admin/includes/database.php");

$checkLogin = "";
$href = "#";
$checkStatus = "";
if(!isset($_SESSION['user_id'])) {
    $checkLogin = "data-toggle='modal' data-target='#loginModal'";

   
}
else {

    $uid = $_SESSION['user_id'];
    $checkStatusQuery = "SELECT TRANGTHAI FROM KH WHERE MA_KH='$uid'";

    $MyCon = new MyConnect();
    $result = $MyCon->query($checkStatusQuery);
    $row = mysqli_fetch_array($result);

    if($row['TRANGTHAI'] == "LOCKED") {
        $checkStatus = "onclick=lockNoti()";
    }
    else {
        $href = "shipping.php";

    }
     
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
    enav:disabled {
        color: black;
    }
    .nav-tabs {
        border-bottom: 1px solid #dee2e6;
    }
    button:focus {outline:0;}

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
                        Xóa Sản Phẩm Thành Công
                </div>
            </div>
    </div>
    
    <div class="container pb-5 position-relative pt-2">
            <div class="mt-5 d-block ">
                <ul class="nav nav-pills nav-fill border-0 rounded-0">
                    <li class="flex-grow-1 text-center nav-item">
                        <a href="" class="m-0 px-0 py-3 bg-warning text-light nav-link disabled active font-weight-bold rounded-0 nav-link border-right">Giỏ Hàng</a>
                    </li>
                    <li class="flex-grow-1 text-center nav-item">
                        <a class="m-0 px-0 py-3 bg-secondary text-muted nav-link disabled  font-weight-bold rounded-0 nav-link border-right">Vận Chuyển</a>
                    </li>
                    <li class="flex-grow-1 text-center nav-item">
                        <a class="m-0 px-0 py-3 bg-secondary text-muted nav-link disabled  font-weight-bold rounded-0 nav-link border-right">Thanh Toán</a>
                    </li>
                    <li class="flex-grow-1 text-center nav-item">
                        <a class="m-0 px-0 py-3 bg-secondary text-muted nav-link disabled  font-weight-bold rounded-0 nav-link">Xác Nhận Đơn Hàng</a>
                    </li>
                </ul>
            </div>


            <div class="my-5">
                <div class="row mx-0">
                    <div class="col-12 mb-4 px-0">
                    <?php 
                        
                        if(isset($_SESSION['cart'])) {
                            $sum = 0;
                            $cart = $_SESSION['cart'];
                    ?>
                        <table class="w-100 table table-bordered text-center">
                            <thead>
                                <th></th>
                                <th>Sản Phẩm</th>
                                <th>Giá</th>
                                <th>Số Lượng</th>
                                <th>Thành Tiền</th>
                                <th></th>
                            </thead>
                            <tbody>
                            <?php 
                                foreach($cart as $product) {
                            ?>
                                <tr class="font-weight-bold">
                                    <td><img src="<?php echo "admin/product_images/".$product["image"] ?>" style="width: 50px; height: auto;"></td>
                                    <td class="align-middle"><?php echo $product["name"]; ?></td>
                                    <td class="align-middle"><?php echo number_format($product["price"],0,",",".")."<sup>đ</sup>"; ?></td>
                                    <input type="hidden" class="iprice" value="<?php echo $product["price"] ?>">
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-center text-center">
                                        <button class="btn btn-sm border rounded-0 btn-outline-light text-dark btn-dec">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="text"  class="text-center justify-content-center border border-left-0 border-right-0 iquantity" style="width: 2em" value="<?php echo $product["quantity"]; ?>" readonly>
                                        <button class="btn btn-sm border rounded-0 btn-outline-light text-dark btn-inc">
                                            <i class="fas fa-plus"></i>
                                        </button>

                                        </div>
                                    </td>
                                    <td class="align-middle"><span class="itotal"><?php $sum += $product["price"]*$product["quantity"]; echo number_format($product["price"]*$product["quantity"],0,",",".");  ?></span><sup>đ</sup></td>
                                    <td class="align-middle"><button class="btn btn-outline-danger" onclick="removeItem('<?php echo array_search($product,$cart); ?>')"><i class="fas fa-trash-alt"></i></button></td>
                                    <input type="hidden" class="pID" value="<?php echo array_search($product,$cart); ?>">
                                </tr>

                            <?php } ?>
                            </tbody>
                        </table>

                        <div class="mt-5 ml-auto col-lg-5 px-0 bg-light rounded">
                            <div class="d-flex justify-content-between align-items-center w-100 p-3">
                                <h4 class="mb-0 text-dark">Tổng Tiền: </h4>
                                <h4 class="mb-0 text-dark"><span id="total"><?php echo number_format($sum,0,",","."); ?></span><sup>đ</sup></h4>
                            </div>
                            <div class="px-3 mb-5">
                                <a href="<?php echo $href; ?>" class="btn btn-info btn-block btn-lg py-3" <?php echo $checkLogin; ?> <?php echo $checkStatus; ?>>Xác Nhận Giỏ Hàng</a>
                            </div>
                        </div>
                    <?php 
                        } else {

                    ?>
                    <div class="text-center py-5 font-weight-bolder">
                            <p>Giỏ Hàng Của Bạn Đang Trống</p>
                            <a href="product.php" class="btn btn-info mt-2">Trở Lại Trang Mua Hàng</a>
                    </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
    </div>
    
    <footer class="bg-dark">
        <div class="container-fuild text-light">
            <div class="row card-deck pt-3 ml-5">
                <div class="col-md-5 pr-0">
                    <div class="card border-0 bg-dark ml-5">
                        <div class="card-header bg-dark border-0"><h4>HỆ THỐNG CỬA HÀNG</h4></div>
                        <div class="card-body border-0">
                            <p>Chi nhánh 1:     273, An Dương Vương, Quận 5, Tp.HCM</p>
                            <p>Chi nhánh 2:     105, Bà Huyện Thanh Quan, Quận 3, Tp.HCM</p>
                            <p>Chi nhánh 3:     4, Tôn Đức Thắng, Quận 1, Tp.HCM</p>
                        </div>
                    </div>
                </div>
                <div class="col-md pl-0">
                    <div class="card border-0 bg-dark">
                        <div class="card-header bg-dark border-0"><h4>CHÍNH SÁCH & DỊCH VỤ</h4></div>
                        <div class="card-body border-0">
                            <a href="#" class="text-light text-decoration-none pb-3"><i class="fas fa-shipping-fast mr-2"></i>Vận chuyển</a><br>
                            <a href="#" class="text-light text-decoration-none pb-3"><i class="fas fa-money-check-alt mr-2"></i>Thanh toán</a><br>
                            <a href="#" class="text-light text-decoration-none pb-3"><i class="fas fa-exchange-alt mr-2"></i>Đổi trả</a>
                        </div>
                    </div>
                </div> 
                <div class="col-md">
                    <div class="card border-0 bg-dark mx-0">
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
    <script type="text/javascript" src="js/cart_process.js"></script>
 
</body>
</html>