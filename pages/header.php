<?php
include_once "cart_functions.php";

if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {

    if (isset($_SESSION['id_khachhang'])) {
        if (empty($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        saveUserCart($_SESSION['id_khachhang'], $_SESSION['cart']);
    }

    unset($_SESSION['dangky']);
    unset($_SESSION['cart']);
    unset($_SESSION['email']);
    unset($_SESSION['id_khachhang']);
    unset($_SESSION['muangay']);
    header('Location: index.php');
    exit();
}

?>


<!-- HEADER-->
<div class="container">
    <div class="header">
        <!-- LOGO -->
        <a href="index.php">
            <img class="logo" src="images/logo1.png" alt="LogoPetStore">
        </a>

        <!-- TÌM KIẾM -->
        <div class="tim-kiem">
            <form class="button" action="index.php?quanly=timkiem" method="POST">
                <p>
                    <input type="text" class="o-tim-kiem" placeholder="Search..." name="tukhoa"></i>
                    <span><button type="submit" class="nut-tim-kiem" name="timkiem"><i class="fa fa-search" aria-hidden="true"></i></button></span>

                </p>
            </form>
        </div>

        <!-- USER -->
        <div class="list-menu-user-header">
            <ul>
                <li>
                    <!-- <a href="index.php?quanly=dangky"><i class="fa fa-user" aria-hidden="true"></i><i class="fa fa-chevron-down" aria-hidden="true" width="5px" height="5px"></i></a> -->
                    <a href="account.php?redirect_url=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>"><i class="fa fa-user log-in-icon" aria-hidden="true" style="font-size: x-large; color: #123f39"></i><span>
                            <span><?php
                                    if (isset($_SESSION['dangky'])) {
                                        echo $_SESSION['dangky'];
                                    }
                                    ?>
                            </span><i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                    <!-- <i class="fa fa-user log-in-icon" aria-hidden="true"></i><i class="fa fa-chevron-down" aria-hidden="true" width="5px" height="5px"></i> -->
                    <ul>
                        <?php
                        if (isset($_SESSION['dangky'])) {
                        ?>
                            <li><a href="index.php?dangxuat=1">Đăng xuất</a></li>
                            <li><a href="index.php?quanly=thaydoimatkhau">Đổi mật khẩu</a></li>
                        <?php
                        } else {
                        ?>
                            <!-- <li><a href="index.php?quanly=dangky">Đăng ký</a></li> -->
                            <!-- <li><a href="account.php">Đăng nhập</a></li> -->
                            <li><a href="account.php?redirect_url=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">Đăng nhập</a></li>

                        <?php
                        }
                        ?>
                        <li><a href="index.php?quanly=lichsudonhang">Lịch sử đơn hàng (TK)</a></li>
                        <li><a href="index.php?quanly=lichsudonhangoff">Lịch sử đơn hàng (NoTK)</a></li>
                    </ul>
                </li>

                <!-- GIỎ HÀNG -->
                <li>
                    <a href="index.php?quanly=giohang">
                        <i class="fa fa-shopping-basket" aria-hidden="true" style="font-size: x-large; color: #123f39"></i>

                        <!-- Số lượng sản phẩm trong giỏ-->
                        <?php
                        // Display cart count if items exist
                        if (isset($_SESSION['cart'])) {
                            $cart_count = count($_SESSION['cart']);
                            echo "<span class='cart-count'>{$cart_count}</span>";
                        } else {
                            echo "<span class='cart-count'>0</span>";
                        }

                        ?>
                    </a>
                </li>

                <!-- LỊCH SỬ ĐƠN HÀNG -->
                <li>
                    <a href="index.php?quanly=lichsudonhang"><i class="fa fa-truck" aria-hidden="true" style="font-size: x-large; color: #123f39"></i><i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                    <ul>
                        <li><a href="index.php?quanly=lichsudonhang">Lịch sử đơn hàng (TK)</a></li>
                        <li><a href="index.php?quanly=lichsudonhangoff">Lịch sử đơn hàng (NoTK)</a></li>
                        </a>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>





<style>
    .cart-count {
        width: 14px;
        height: 14px;
        text-align: center;
        line-height: 14px;
        position: absolute;
        top: 4px;
        left: 33px;
        background: #fff;
        color: #123F39;
        font-size: 10px;
        font-family: 'Roboto', sans-serif;
        font-weight: bold;
        border-radius: 50%;
    }
</style>