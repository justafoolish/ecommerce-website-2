<?php 
    include("admin/includes/database.php");

    if(isset($_POST['registry'])) {
        $MyConn = new MyConnect();

        $C_name = $_POST['Name'];
        $C_email = $_POST['Email']; 
        $C_passwd = $_POST['password'];
        $C_addr = $_POST['address'];
        $C_cont = $_POST['contact'];

        $query = "INSERT INTO KH(TEN_KH, EMAIL, MATKHAU, DIACHI, DIENTHOAI) VALUES ('$C_name','$C_email','$C_passwd','$C_addr','$C_cont')";

        echo "<script>alert('$query')</script>";


        $execute = $MyConn->query($query);

        if($execute) {

            echo "<script>alert('Đăng Ký Thành Công')</script>";

            echo "<script>window.history.back();</script>";

        } 
        else {

            echo "<script>alert('Đăng Ký Thất Bại')</script>";


            echo "<script>window.history.back();</script>";


        }

    }
?>