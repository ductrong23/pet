<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css" ver="9"> -->
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/product.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="css/giohang.css">
    <link rel="stylesheet" type="text/css" href="css/vanchuyen.css">
    <link rel="stylesheet" type="text/css" href="css/lienhe.css" ver="2">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/gioithieu.css" ver="1">
    <link rel="stylesheet" type="text/css" href="css/thongtinthanhtoan.css">
    <link rel="stylesheet" type="text/css" href="css/tintuc.css">
    <link rel="stylesheet" type="text/css" href="css/danhmuc.css">
    <link rel="stylesheet" type="text/css" href="css/dieuhuong.css">
    <link rel="stylesheet" type="text/css" href="css/xac_nhan.css">
    <link rel="stylesheet" type="text/css" href="css/thaydoimatkhau.css">
    <link rel="stylesheet" type="text/css" href="css/sanphamlienquan.css">
    <link rel="stylesheet" type="text/css" href="css/danhmuc_sanpham.css">
    <link rel="stylesheet" type="text/css" href="css/timkiem.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    

    <script scr="js/xac_nhan.js"></script>
    
    <!-- <script scr="js/index.js"></script> -->


    <title>PetStore</title>
</head>

<body>
    <div class="wrapper">

        <?php
        session_start();
        // unset($_SESSION['dangky']);
        // session_destroy();
        include "admincp/config/config.php";
        include "pages/header.php";
        ?>

        <?php
        include "pages/menu.php";
        include "pages/main.php";
        ?>

        <!-- CLEAR -->
        <div class="clear"></div>

        <?php
        include "pages/footer.php";
        ?>


    </div>
</body>

</html>


