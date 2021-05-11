<?php 
    include("admin/includes/database.php");
    if(isset($_GET['submit'])) {
        $MyConn = new MyConnect();
        $cart = $_SESSION['cart'];
        $user = $_SESSION['user_id'];

        //Tính tổng hóa đơn
        $total = 0;
        foreach($cart as $product) {
            $total += $product["price"];
        }
        $cart = $_SESSION['cart'];

        //Biến thực thi truy vấn insert hoa don
        $execute = 0;

        //random bill id
        $getRandomID = rand(1000,10000);


        while(!$execute) {
            $insertBill = "INSERT INTO HOADON (MA_HD, MA_KH, TONGTIEN) VALUES ($getRandomID,$user,$total)";

            $execute = $MyConn->query($insertBill);

            if(!$execute) {
                $getRandomID = rand(1000,10000);
            }
        }

        //thực thi truy vấn insert ct hoa don
        $execute2 = 0;
        foreach($cart as $product) {
            $getProID = array_search($product,$cart);
            $productTotal = (int)$product["price"]*$product["quantity"];
            $qty = $product["quantity"];
            $insertDetail = "INSERT INTO CT_HOADON (MA_HD,MA_SP,SOLUONG,TONGTIEN) VALUES ($getRandomID,'$getProID',$qty,$productTotal)";

            $execute2 = $MyConn->query($insertDetail);
        }
        if($execute2) {

            echo "<script>alert('Đặt hàng thành công')</script>";

            unset($_SESSION['cart']);

            echo "<script>window.open('index.php','_self')</script>";


        }
        else {

            echo "<script>alert('Đặt hàng thất bại')</script>";

            echo "<script>window.open('index.php','_self')</script>";
            
        }

    }

?>