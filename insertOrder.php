<?php 
    session_start();
    include("admin/includes/database.php");
    if(isset($_GET['submit'])) {
        $MyConn = new MyConnect();
        $getTotal = $_SESSION['cart'];
        $cart = $getTotal;
        $userID = $_SESSION['user_id'];

        //Tính tổng hóa đơn
        $total = 0;
        foreach($getTotal as $product) {
            $total += (int)$product["price"]*$product["quantity"];
        }

        //random bill id

        $getRandomID = $userID.date("Ymdhis");

        $billID = (int)$getRandomID;

        $user = (int)$userID;

        
        $insertBill = "INSERT INTO HOADON (MA_HD, MA_KH, TONGTIEN, TRANGTHAI) VALUES ($billID,$user,$total,'Chưa Thanh Toán')";


        $executeInsert = $MyConn->query($insertBill);


        if($executeInsert) { 

            $execute;

            foreach($cart as $value) {
                
                $pID = array_search($value,$cart);

                $qty = $value["quantity"];
                
                $subTotal = (int)$value["price"]*$qty;
                
                $queryDetail = "INSERT INTO CT_HOADON (MA_HD, MA_SP, SOLUONG, TONGTIEN) VALUES ($billID,'$pID', $qty, $subTotal)";

                
                $execute = $MyConn->query($queryDetail);
                   
            }

            if($execute) {
                echo "<script>alert('Tạo hóa đơn thành công')</script>";

                unset($_SESSION['cart']);

                echo "<script>window.open('index.php','_self')</script>";

            }




        }

    }

?>