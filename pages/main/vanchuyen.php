<div class="xac-nhan-don-hang">
    <div class="step"><span><a href="index.php?quanly=giohang">Giỏ hàng</a></span></div>
    <div class="step-current"><span><a href="index.php?quanly=vanchuyen">Vận chuyển</a></span></div>
    <div class="step"><span><a href="javascript:void(0);" id="link-nav">Thanh toán</a></span></div>
    <!-- <div class="step"><span><a href="index.php?quanly=donhangdadat">Đơn hàng</a></span></div> -->

</div>
<script src="js/checkvanchuyen.js"></script>
<?php
// Kiểm tra thời gian hết hạn trước khi thực hiện mua hàng
function kiemTraMuaNgayHetHan()
{
    if (isset($_SESSION['muangay_time'])) {
        $hienTai = time();
        $thoiGianTao = $_SESSION['muangay_time'];
        $thoiHan = 90;

        if (($hienTai - $thoiGianTao) > $thoiHan) {
            unset($_SESSION['muangay']);
            unset($_SESSION['muangay_time']);
            return false;
        }
    }
    return true;
}


if (isset($_SESSION['muangay'])) {
    // Nếu tồn tại session['muangay'], kiểm tra thời gian hết hạn và tính thời gian còn lại
    if (kiemTraMuaNgayHetHan()) {
        $cart_to_display = $_SESSION['muangay'];
        $timeNow = time();
        $timeStart = $_SESSION['muangay_time'];
        $timeLimit = 90; // Thay đổi thời gian nếu cần
        $timeRemaining = $timeLimit - ($timeNow - $timeStart);
        if ($timeRemaining <= 0) {
            $timeRemaining = 0;
        }
    } else {
        $cart_to_display = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
        // echo '<script>
        // alert("Thời gian mua hàng đã hết, vui lòng thêm sản phẩm lại.")
        // window.location.href = "index.php";
        // </script>';
        // exit();
    }
} else {
    $cart_to_display = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    $timeRemaining = 0; // Không hiển thị đếm ngược nếu không có session['muangay']
}

?>

<?php if (isset($_SESSION['muangay'])): ?>
    <div id="countdown" data-time-remaining="<?php echo $timeRemaining; ?>"></div>
    <script src="js/dongho.js"></script>
<?php endif; ?>

<?php
$popupMessage = '';
if (isset($_POST['themvanchuyen'])) {
    //  Nếu chưa từng mua hàng thì sẽ tạo mới thông tin
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $note = $_POST['note'];
    $id_dangky = $_SESSION['id_khachhang'];
    $sql_them_vanchuyen = mysqli_query($mysqli, "INSERT INTO tbl_shipping(name, phone, address, note, id_dangky) VALUES('$name','$phone','$address','$note','$id_dangky')");
    if ($sql_them_vanchuyen) {
        $popupMessage = "Thêm thông tin vận chuyển thành công. Vui lòng cập nhật thông tin thanh toán";
        // echo '<script>showPopup("Thêm thông tin vận chuyển thành công. Vui lòng cập nhật thông tin thanh toán ")</script>';
    } else {
        $popupMessage = "Thêm thông tin vận chuyển thất bại";
        // echo '<script>showPopup("Thêm thông tin vận chuyển thất bại ")</script>';
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
        $popupMessage = "Cập nhật thông tin vận chuyển thành công. Vui lòng cập nhật thông tin thanh toán";
        // echo '<script>showPopup("Cập nhật thông tin vận chuyển thành công. Vui lòng cập nhật thông tin thanh toán ")</script>';
    } else {
        $popupMessage = "Cập nhật thông tin vận chuyển thất bại";
        // echo '<script>showPopup("Cập nhật thông tin vận chuyển thất bại ")</script>';
    }
}
?>

<!-- <h1>THÔNG TIN VẬN CHUYỂN</h1> -->
<div class="thong-tin-van-chuyen">
    <form id="form-shipping" action="" autocomplete="off" method="POST">
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
            <label class="form-label">Họ và tên</label>
            <input type="text" id="name" name="name" placeholder="Nhập tên người nhận tại đây" value="<?php echo $name ?>" class="form-control">
            <span class="form-message"></span>
        </div>
        <div class="form-group">
            <label class="form-label">Số điện thoại</label>
            <input type="text" id="phone" name="phone" placeholder="Nhập số điện thoại tại đây" value="<?php echo $phone ?>" class="form-control">
            <span class="form-message"></span>
        </div>
        <div class="form-group">
            <label class="form-label">Địa chỉ</label>
            <input type="text" id="address" name="address" placeholder="Nhập địa chỉ giao hàng tại đây" value="<?php echo $address ?>" class="form-control">
            <span class="form-message"></span>
        </div>
        <div class="form-group">
            <label class="form-label">Ghi chú</label>
            <input type="text" id="ghichu" name="note" placeholder="Nhập ghi chú tại đây" value="<?php echo $note ?>" class="form-control">
            <span class="form-message"></span>
        </div>

        <?php
        if ($name == '' && $phone == '') {

        ?>

            <button class="nut-cap-nhat-thong-tin" type="submit" name="themvanchuyen">Thêm thông tin vận chuyển </button>
        <?php
        } elseif ($name != '' && $phone != '') {
        ?>
            <button class="nut-cap-nhat-thong-tin" type="submit" name="capnhatvanchuyen">Cập nhật thông tin vận chuyển </button>

        <?php
        }
        ?>
    </form>
</div>

<script src="js/vanchuyen.js"></script>


<!-- ================================================ -->
<div class="bang-gio-hang-thanh-toan">
    <table class="bang-gio-hang" style="width: 100%; text-align:center;font-family: Montserrat, sans-serif; font-size:14px" border="1" border-collapse:collapse>
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
        // if (isset($_SESSION['cart'])) {
        if (isset($cart_to_display)) {
            $i = 0;
            $tongtien = 0;
            // foreach ($_SESSION['cart'] as $cart_item) {
            foreach ($cart_to_display as $cart_item) {
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
                    <!-- <td>
                        <a href="pages/main/themgiohang.php?cong=<?php echo $cart_item['id'] ?>"><i class="fa fa-plus fa-style" aria-hidden="true"></i></a>
                        <?php echo $cart_item['soluong'] ?>
                        <a href="pages/main/themgiohang.php?tru=<?php echo $cart_item['id'] ?>"><i class="fa fa-minus fa-style" aria-hidden="true"></i></a>
                    </td> -->
                    <td>
                        <a href="pages/main/themgiohang.php?cong=<?php echo $cart_item['id']; ?>&redirect=vanchuyen"><i class="fa fa-plus fa-style" aria-hidden="true"></i></a>
                        <?php echo $cart_item['soluong'] ?>
                        <a href="pages/main/themgiohang.php?tru=<?php echo $cart_item['id']; ?>&redirect=vanchuyen"><i class="fa fa-minus fa-style" aria-hidden="true"></i></a>
                    </td>
                    <td><?php echo number_format($thanhtien, 0, ',', '.') . " đ" ?></td>

                </tr>
            <?php
            }
            ?>
            <tr>
                <td colspan="8">
                    <p style="float: right; font-weight:bolder">Tổng tiền: <?php echo number_format($tongtien, 0, ',', '.') . " đ" ?></p>
                    <div style="clear:both"></div>

                    <?php
                    if (isset($_SESSION['dangky'])) {
                    ?>
                        <!-- <p><a href="pages/main/thanhtoan.php">Đặt hàng</a></p> -->
                        <p class="nut-gio-hang"><a href="index.php?quanly=giohang"><i class="fa fa-hand-o-left" aria-hidden="true"></i> Giỏ hàng</a></p>
                        <p class="nut-thong-tin-thanh-toan" id="thongtinthanhtoan">
                            <a href="javascript:void(0);" id="link-duoi">Thông tin thanh toán <i class="fa fa-hand-o-right" aria-hidden="true"></i></a>
                        </p>
                    <?php
                    } else {
                    ?>
                        <p><a href="index.php?quanly=vanchuyenoff">Mua ngay<i class="fa fa-hand-o-right" aria-hidden="true"></i></a></p>
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

<br>
<div class="cua-hang">
    <a class="quay-lai" href="index.php">
        <i class="fa fa-hand-o-left" aria-hidden="true"></i>
        <span>
            <h4>QUAY LẠI CỬA HÀNG</h4>
        </span>
    </a>
</div>

<!-- <div id="popupModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="popupMessage"></p>
    </div>
</div> -->

<div id="popupModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p id="popupMessage"><?php echo isset($popupMessage) ? $popupMessage : ''; ?></p>
  </div>
</div>