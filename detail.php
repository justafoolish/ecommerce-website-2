<?php

session_start();

include("admin/includes/database.php");

if (isset($_GET['productID'])) {
    $MyConn = new MyConnect();

    $pID = $_GET['productID'];

    $query = "SELECT * FROM SP WHERE MA_SP='$pID'";

    $result = $MyConn->query($query);

    $getProduct = mysqli_fetch_array($result);


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
      .cart-amount {
        top: -13px;
        right: -10px;
        min-width: 20px;
        min-height: 20px;
        border-width: 2px;
        border-radius: 50%;
        font-size: 12px;
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
              <a class="nav-link nl" href="index.php">Trang Chủ <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link nl" href="product.php">Sản Phẩm</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nl" href="#">Giới Thiệu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nl" href="#">Liên Hệ</a>
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
                </div>
                </i>
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
                    Thêm Sản Phẩm Thành Công
                </div>
            </div>
    </div>
    
    <div class="container mt-3 pb-5">
       
       <div class="row">
           <div class="col-md-6">
               <img src="<?php echo "admin/product_images/".$getProduct['HINHANH_SP']; ?>" class="img-fluid rounded" width="540px" height="540px">
           </div>
           <div class="col-md-6"> 
               <div class="row">
                   <div class="col-md-12 mt-4">
                       <h1><?php echo $getProduct['TEN_SP'] ?></h1>
                   </div>
               </div>     
               <div class="row">
                   <div class="col-md-12">
                       <span class="badge badge-success my-3">Còn Hàng</span>
                       <span class="product-number"><?php echo $getProduct['MA_SP'] ?></span>
                   </div>
               </div>     
               <div class="row my-5">
                   <div class="col-md-12">
                       <div id="description">
                            <?php echo $getProduct['MIEUTA_SP'] ?>
                        </div>
                   </div>
               </div>    
               <div class="row mt-5 mt-5">
                   <div class="col-md-4">                        
                           <i class="fa fa-star" ></i> <em></em>
                           <i class="fa fa-star" ></i> <em></em>
                           <i class="fa fa-star" ></i> <em></em>
                           <i class="fa fa-star" ></i> <em></em>                                                    
                           <i class="fa fa-star-half-o" ></i> <em></em>   
                           <span class="badge badge-info">53</span>                        
                   </div>
                   <div class="col-md-4">
                       <a href="" class="text-decoration-none text-info"><i class="fas fa-pen"></i> Đánh giá sản phẩm</a>
                   </div>
               </div>              
               <div class="row mt-2">
                   <div class="col-md-12 text-danger">
                       <h4 id="product-price"><?php echo number_format($getProduct['GIA'],0,",",".") ?><sup>đ</sup></h4>                        
                   </div>
               </div>    
               <div class="row mt-5">
                   <div class="col-md-12">
                       <button id="myBtn" class="btn btn-warning text-light mt-auto" onclick="addCart('<?php echo $pID; ?>')">                            
                           <i class="fa fa-cart-plus" aria-hidden="true"></i> 
                           Thêm Vào Giỏ                   
                       </button>
                   </div>
               </div>    
               
           </div>
       
       
       
       </div>
       <div class="row mt-3">
           <div class="col-md-12">
               <div class="bd-example bd-example-tabs">
                   <nav>
                     <div class="nav nav-tabs" id="nav-tab" role="tablist">
                       <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-description" role="tab" aria-controls="nav-home" aria-selected="true">Miêu tả</a>
                       <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-payment" role="tab" aria-controls="nav-profile" aria-selected="false">Phương thức thanh toán</a>
                       <a class="nav-link" id="nav-comment-tab" data-toggle="tab" href="#nav-comment" role="tab" aria-controls="nav-contact" aria-selected="false">Đánh giá</a>
                     </div>
                   </nav>
                   <div class="tab-content" id="nav-tabContent">
                     <div class="tab-pane fade show active" id="nav-description" role="tabpanel" aria-labelledby="nav-home-tab">
                        <p class="mt-3"><?php echo $getProduct['MIEUTA_SP']; ?></p>
                    </div>
                     <div class="tab-pane fade" id="nav-payment" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <p class="mt-3">Chưa Có Dữ Liệu Thanh Toán</p>
                    </div>
                     <div class="tab-pane fade" id="nav-comment" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <p class="mt-3">Chưa Có Đánh Giá</p>
                    </div>
                   </div>
                 </div>

           </div>

       </div>
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

<?php } ?>