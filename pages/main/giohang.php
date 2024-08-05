<h1>GIỎ HÀNG</h1>

<?php
if (isset($_SESSION['dangky'])) {
    echo 'Xin chào ' . $_SESSION['dangky'];
}
?>

<?php
if (isset($_SESSION['cart'])) {
}
?>

<div class="xac-nhan-don-hang">
    <div class="step-current"><span><a href="index.php?quanly=giohang">Giỏ hàng</a></span></div>
    <div class="step"><span><a href="index.php?quanly=vanchuyen">Vận chuyển</a></span></div>
    <div class="step"><span><a href="index.php?quanly=thongtinthanhtoan">Thanh toán</a></span></div>
    <div class="step"><span><a href="index.php?quanly=donhangdadat">Đơn hàng</a></span></div>
</div>

<table class="bang-gio-hang" style="width: 100%; text-align:center" border="1" border-collapse:collapse>
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
    if (isset($_SESSION['cart'])) {
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
                <p style="text-align:center">Tổng tiền: <?php echo number_format($tongtien, 0, ',', '.') . " đ" ?></p>
                <p style="float:right"><a href="pages/main/themgiohang.php?xoatatca=1">Xoá tất cả</a></p>
                <div style="clear:both"></div>

                <?php
                if (isset($_SESSION['dangky'])) {
                ?>
                    <!-- <p><a href="pages/main/thanhtoan.php">Đặt hàng</a></p> -->
                    <p class="hinh-thuc-van-chuyen"><a href="index.php?quanly=vanchuyen">Hình thức vận chuyển <i class="fa fa-hand-o-right" aria-hidden="true"></i></a></p>
                <?php
                } else {
                ?>
                    <p class=""><a href="account.php">Đăng nhập để đặt hàng</a></p>
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

    <?php
    }
    ?>
</table>

<br>
<a class="quay-lai" href="index.php">
    <i class="fa fa-hand-o-left" aria-hidden="true"></i>
    <span>
        <h4>QUAY LẠI CỬA HÀNG</h4>
    </span>
</a>