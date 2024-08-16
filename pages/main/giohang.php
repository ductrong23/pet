<!-- ĐIỀU HƯỚNG -->
<nav class="dieu-huong">
    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php" title="Về trang chủ">Trang chủ</a>
        </li>
        <i class="fa fa-chevron-right" aria-hidden="true"></i>
        <li class="breadcrumb-item">
            <a href="#" title="Giới thiệu">Giỏ hàng</a>
        </li>

    </ul>
</nav>

<?php
include_once __DIR__ . '/../../cart_functions.php';


?>

<div class="xac-nhan-don-hang">
    <div class="step-current"><span><a href="index.php?quanly=giohang">Giỏ hàng</a></span></div>
    <div class="step"><span><a href="index.php?quanly=vanchuyen">Vận chuyển</a></span></div>
    <div class="step"><span><a href="index.php?quanly=thongtinthanhtoan">Thanh toán</a></span></div>
    <!-- <div class="step"><span><a href="index.php?quanly=donhangdadat">Đơn hàng</a></span></div> -->
</div>
<!-- <h1>GIỎ HÀNG</h1> -->


<?php
if (isset($_SESSION['cart'])) {
    // }
    // if (isset($_SESSION['id_khachhang'])) {
    //     $loadedCart = loadUserCart($_SESSION['id_khachhang']);
    //     error_log("Loaded cart for user " . $_SESSION['id_khachhang'] . ": " . print_r($loadedCart, true));
    //     $_SESSION['cart'] = $loadedCart;
}
?>

<table class="bang-gio-hang" style="width: 95%; text-align:center; margin: 0 auto; font-family: Montserrat, sans-serif; font-size:14px" border="1" border-collapse:collapse>
    <tr>
        <!-- <th>ID</th> -->
        <th>Tên sản phẩm</th>
        <th>Hình ảnh</th>
        <th>Mã sản phẩm</th>
        <th>Giá sản phẩm</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
        <th>Quản lý</th>
    </tr>
    <?php
    // if (isset($_SESSION['cart'])) {
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $i = 0;
        $tongtien = 0;
        foreach ($_SESSION['cart'] as $cart_item) {
            $thanhtien = $cart_item['giasp'] * $cart_item['soluong'];
            $tongtien += $thanhtien;
            $i++;
    ?>
            <tr>
                <!-- <td><?php echo $i; ?></td> -->
                <td><?php echo $cart_item['tensanpham'] ?></td>
                <td><img src="admincp/modules/quanlysanpham/uploads/<?php echo $cart_item['hinhanh']; ?>" width="130px"></td>
                <td><?php echo $cart_item['masp'] ?></td>
                <td><?php echo number_format($cart_item['giasp'], 0, ',', '.') . " đ" ?></td>
                <td>
                    <a href="pages/main/themgiohang.php?cong=<?php echo $cart_item['id'] ?>"><i class="fa fa-plus fa-style" aria-hidden="true"></i></a>
                    <?php echo $cart_item['soluong'] ?>
                    <a href="pages/main/themgiohang.php?tru=<?php echo $cart_item['id'] ?>"><i class="fa fa-minus fa-style" aria-hidden="true"></i></a>
                </td>
                <td><?php echo number_format($thanhtien, 0, ',', '.') . " đ" ?></td>
                <td><a href="pages/main/themgiohang.php?xoa=<?php echo $cart_item['id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
            </tr>
        <?php
        }
        ?>
        <tr>
            <td colspan="8">
                <div class="nam-phai">
                    <p style="font-weight:bolder">Tổng tiền: <?php echo number_format($tongtien, 0, ',', '.') . " đ" ?></p>
                    <p><a href="pages/main/themgiohang.php?xoatatca=1">Xoá tất cả</a></p>
                </div>
                <div style="clear:both"></div>

                <?php
                if (isset($_SESSION['dangky'])) {
                ?>
                    <!-- <p><a href="pages/main/thanhtoan.php">Đặt hàng</a></p> -->
                    <p class="hinh-thuc-van-chuyen"><a href="index.php?quanly=vanchuyen">Thông tin vận chuyển <i class="fa fa-hand-o-right" aria-hidden="true"></i></a></p>
                <?php
                } else {
                ?>
                    <p class=""><a href="account.php?redirect_url=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">Đăng nhập để đặt hàng</a></p>
                    <p><a href="index.php?quanly=vanchuyenoff">Mua mà không cần tài khoản<i class="fa fa-hand-o-right" aria-hidden="true"></i></a></p>
                    <!-- <form method="POST" action="account.php">
                        <input type="hidden" name="redirect" value="giohang">
                        <p><a href="#" onclick="this.closest('form').submit(); return false;">Đăng nhập để đặt hàng</a></p>
                    </form> -->

                <?php
                }
                ?>

            </td>
        </tr>
    <?php
    } else {

    ?>


        <tr>
            <td colspan="8">Hiện tại giỏ hàng trống</td>
        </tr>
        <br>
        <br>

    <?php
    }
    ?>
</table>

<br>
<div class="cua-hang">
    <a class="quay-lai" href="index.php">
        <i class="fa fa-hand-o-left" aria-hidden="true"></i>
        <span>
            <h4>QUAY LẠI CỬA HÀNG</h4>
        </span>
    </a>
</div>