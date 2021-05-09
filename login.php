<?php 
    session_start();
    include("admin/includes/database.php");
    if(isset($_POST['login'])) {
        $MyConn = new MyConnect();

        $email = mysqli_real_escape_string($MyConn->getConn(),$_POST['email']);
        $pass = mysqli_real_escape_string($MyConn->getConn(),$_POST['passwd']);

        $query = "SELECT * FROM KH WHERE EMAIL='$email' AND MATKHAU='$pass'";

        $execute = $MyConn->query($query);

        $result = mysqli_num_rows($execute);

        if($result != 0) {
            $_SESSION['user_email'] = $email;

            echo "<script>window.open('index.php','_self')</script>";

        } 
        else {
            echo "<script>window.open('index.php','_self')</script>";

            echo "<script>alert('Địa Chỉ Email Hoặc Mật Khẩu Không Đúng')</script>";

        }

    }
?>