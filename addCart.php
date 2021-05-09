<?php
    session_start();

    include("admin/includes/database.php");

    if(isset($_POST['productID'])) {
        
        $id = $_POST['productID'];

        $MyConn = new MyConnect();

        $getProd = $MyConn->query("SELECT * FROM SP WHERE MA_SP='$id'");

        $result = mysqli_fetch_array($getProd);

        if(!isset($_SESSION['cart'])) {
            $cart[$id] = array(
                "name" => $result['TEN_SP'],
                "image" => $result['HINHANH_SP'],
                "price" => $result['GIA'],
                "quantity" => 1
            );

        } else {
            $cart = $_SESSION['cart'];
            if(array_key_exists($id,$cart)) {
                $qty = $cart[$id]["quantity"] + 1;
                $cart[$id] = array(
                    "name" => $result['TEN_SP'],
                    "image" => $result['HINHANH_SP'],
                    "price" => $result['GIA'],
                    "quantity" => $qty
                );
            } else {
                $cart[$id] = array(
                    "name" => $result['TEN_SP'],
                    "image" => $result['HINHANH_SP'],
                    "price" => $result['GIA'],
                    "quantity" => 1
                );
            }
        }

        $_SESSION['cart'] = $cart;
        //echo "<prE>";
        //print_r($_SESSION['cart']);

        $total_qty = 0;
        $total_price = 0;
        foreach($cart as $value) {
            $total_qty += $value["quantity"];
            $total_price += (int)$value["price"]*$value["quantity"];
        }

        echo $total_qty."-".$total_price;


    }

?>
