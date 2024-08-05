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
    <link rel="stylesheet" type="text/css" href="css/gioithieu.css">
    <link rel="stylesheet" type="text/css" href="css/thongtinthanhtoan.css">
    <link rel="stylesheet" type="text/css" href="css/tintuc.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    
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


