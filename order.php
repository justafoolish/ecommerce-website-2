<?php 
    session_start();
    include("admin/includes/database.php");
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

        $genID = $userID.date("mdHs");

        $billID = (int)$genID;

        


        $user = (int)$userID; 

        
        $insertBill = "INSERT INTO HOADON (MA_HD, MA_KH, TONGTIEN, TRANGTHAI) VALUES ($billID,$user,$total,'Chưa Thanh Toán')";


        $executeInsertBill = $MyConn->query($insertBill);


        if($executeInsertBill) { 

            $queryDetail = "INSERT INTO CT_HOADON (MA_HD, MA_SP, SOLUONG, TONGTIEN) VALUES ";

            foreach($cart as $value) {
                
                $pID = array_search($value,$cart);

                $qty = $value["quantity"];
                
                $subTotal = (int)$value["price"]*$qty;
                
                $queryDetail .= " ($billID,'$pID', $qty, $subTotal),";
                   
            } 


            $executeInsertDetail = $MyConn->query(substr(trim($queryDetail),0,-1));


            if($executeInsertDetail) {

                unset($_SESSION['cart']);

                echo "true";
            } else {
                echo "false";
            }
        } else {
            echo "false";
        }

?>