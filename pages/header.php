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
                    <input type="text" class="o-tim-kiem" placeholder="Search..." name="tukhoa">
                    <span><button type="submit" class="nut-tim-kiem" name="timkiem"><i class="fa fa-search" aria-hidden="true"></i></button></span>

                </p>
            </form>
        </div>

        <!-- USER -->
        <div class="list-menu-user-header">
            <ul>
                <li>
                    <!-- <a href="index.php?quanly=dangky"><i class="fa fa-user" aria-hidden="true"></i><i class="fa fa-chevron-down" aria-hidden="true" width="5px" height="5px"></i></a> -->
                    <a href="account.php"><i class="fa fa-user" aria-hidden="true"></i><i class="fa fa-chevron-down" aria-hidden="true" width="5px" height="5px"></i></a>
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
                            <li><a href="account.php">Đăng nhập</a></li>

                        <?php
                        }
                        ?>
                        <li><a href="index.php?quanly=lichsudonhang">Lịch sử đơn hàng</a></li>
                    </ul>
                </li>

                <!-- GIỎ HÀNG -->
                <li><a href="index.php?quanly=giohang"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </div>
</div>