<div class="xac-nhan-don-hang">
    <div class="step"><span><a href="index.php?quanly=giohang">Giỏ hàng</a></span></div>
    <div class="step-current"><span><a href="index.php?quanly=vanchuyen">Vận chuyển</a></span></div>
    <div class="step"><span><a href="index.php?quanly=thongtinthanhtoan">Thanh toán</a></span></div>
    <div class="step"><span><a href="index.php?quanly=donhangdadat">Đơn hàng</a></span></div>

</div>


<?php
if (isset($_POST['themvanchuyen'])) {
    //  Nếu chưa từng mua hàng thì sẽ tạo mới thông tin
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $note = $_POST['note'];
    $id_dangky = $_SESSION['id_khachhang'];
    $sql_them_vanchuyen = mysqli_query($mysqli, "INSERT INTO tbl_shipping(name, phone, address, note, id_dangky) VALUES('$name','$phone','$address','$note','$id_dangky')");
    if ($sql_them_vanchuyen) {
        echo '<script>alert("Thêm thông tin vận chuyển thành công. Vui lòng cập nhật thông tin thanh toán ")</script>';
    } else {
        echo '<script>alert("Thêm thông tin vận chuyển thất bại ")</script>';
    }
} elseif (isset($_POST['capnhatvanchuyen'])) {
    //  Nếu đã từng mua hàng thì hiện ra những thông tin người dùng trước đó và thay đổi nếu cần
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $note = $_POST['note'];
    $id_dangky = $_SESSION['id_khachhang'];
    $sql_update_vanchuyen = mysqli_query($mysqli, "UPDATE tbl_shipping SET name='$name', phone='$phone', address='$address', note='$note', id_dangky='$id_dangky'
    WHERE id_dangky='$id_dangky'");
    if ($sql_update_vanchuyen) {
        echo '<script>alert("Cập nhật thông tin vận chuyển thành công. Vui lòng cập nhật thông tin thanh toán ")</script>';
    } else {
        echo '<script>alert("Cập nhật thông tin vận chuyển thất bại ")</script>';
    }
}
?>


<h1>THÔNG TIN VẬN CHUYỂN</h1>
<div class="thong-tin-van-chuyen">

    <form action="" autocomplete="off" method="POST">
        <?php
        $id_dangky = $_SESSION['id_khachhang'];
        $sql_get_vanchuyen = mysqli_query($mysqli, "SELECT * FROM tbl_shipping WHERE id_dangky='$id_dangky' LIMIT 1");
        $count = mysqli_num_rows($sql_get_vanchuyen);
        if ($count > 0) {
            $row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);
            $name = $row_get_vanchuyen['name'];
            $phone = $row_get_vanchuyen['phone'];
            $address = $row_get_vanchuyen['address'];
            $note = $row_get_vanchuyen['note'];
        } else {
            $name = '';
            $phone = '';
            $address = '';
            $note = '';
        }
        ?>
        <div class="form-group">
            <label>Họ và tên</label>
            <input class="form-control" name="name" type="text" value="<?php echo $name ?>" placeholder="Họ và tên" /><br />
        </div>
        <div class="form-group">
            <label>Số điện thoại</label>
            <input class="form-control" name="phone" type="text" value="<?php echo $phone ?>" placeholder="Số điện thoại" /><br />
        </div>
        <div class="form-group">
            <label>Địa chỉ</label>
            <input class="form-control" name="address" type="text" value="<?php echo $address ?>" placeholder="Địa chỉ" /><br />
        </div>
        <div class="form-group">
            <label>Ghi chú <input class="form-control" type="text" value="<?php echo $note ?>" name="note" /></label>
        </div>

        <?php
        if ($name == '' && $phone == '') {

        ?>

            <button class="form-control-note" type="submit" name="themvanchuyen">Thêm thông tin vận chuyển </button>
        <?php
        } elseif ($name != '' && $phone != '') {
        ?>
            <button class="nut-cap-nhat-thong-tin" type="submit" name="capnhatvanchuyen">Cập nhật tin vận chuyển </button>

        <?php
        }
        ?>
    </form>

</div>

<!-- ================================================ -->
<div class="bang-gio-hang-thanh-toan">
    <table class="bang-gio-hang" style="width: 100%; text-align:center" border="1" border-collapse:collapse>
        <tr>
            <!-- <th>ID</th> -->
            <th class="ten-san-pham">Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Mã sản phẩm</th>
            <th>Giá sản phẩm</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
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

                </tr>
            <?php
            }
            ?>
            <tr>
                <td colspan="8">
                    <p style="text-align:center">Tổng tiền: <?php echo number_format($tongtien, 0, ',', '.') . " đ" ?></p>
                    <div style="clear:both"></div>

                    <?php
                    if (isset($_SESSION['dangky'])) {
                    ?>
                        <!-- <p><a href="pages/main/thanhtoan.php">Đặt hàng</a></p> -->
                        <p class="nut-gio-hang"><a href="index.php?quanly=giohang"><i class="fa fa-hand-o-left" aria-hidden="true"></i> Giỏ hàng</a></p>
                        <p class="nut-thong-tin-thanh-toan"><a href="index.php?quanly=thongtinthanhtoan">Thông tin thanh toán <i class="fa fa-hand-o-right" aria-hidden="true"></i></a></p>
                    <?php
                    } else {
                    ?>
                        <p><a href="index.php?quanly=dangky">Đăng ký đặt hàng</a></p>
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
</div>
<style>

</style>