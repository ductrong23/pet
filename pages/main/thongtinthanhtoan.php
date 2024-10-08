<!-- <h1 style="text-align:center; font-family: Montserrat, sans-serif;">THÔNG TIN THANH TOÁN</h1> -->
<div class="xac-nhan-don-hang">
    <div class="step"><span><a href="index.php?quanly=giohang">Giỏ hàng</a></span></div>
    <div class="step"><span><a href="index.php?quanly=vanchuyen">Vận chuyển</a></span></div>
    <div class="step-current"><span><a href="index.php?quanly=thongtinthanhtoan">Thanh toán</a></span></div>
    <!-- <div class="step"><span><a href="index.php?quanly=xemdonhang">Đơn hàng</a></span></div> -->
</div>

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
        // echo '<script>alert("Thời gian mua hàng đã hết, vui lòng thêm sản phẩm lại.")</script>';
        // header('Location: ../../index.php');
        // exit();
    }
} else {
    $cart_to_display = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    $timeRemaining = 0; // Không hiển thị đếm ngược nếu không có session['muangay']
}
?>

<?php if (isset($_SESSION['muangay'])): ?>
    <div id="countdown" data-time-remaining="<?php echo $timeRemaining; ?>" style="font-size: 24px; font-weight: bold;"></div>
    <script src="js/dongho.js"></script>
<?php endif; ?>

<form action="pages/main/xulythanhtoan.php" method="POST">
    <div class="infor-cart">
        <div class="thong-tin-thanh-toan">
            <!-- <h4 style="text-align: center; font-size: 24px; color: #123f39; font-family: Montserrat, sans-serif;">THÔNG TIN THANH TOÁN</h4> -->
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
            <ul>
                <li class="thong-tin">Họ và tên: <b><?php echo $name ?></b></li>
                <li class="thong-tin">Số điện thoại: <b><?php echo $phone ?></b></li>
                <li class="thong-tin">Địa chỉ: <b><?php echo $address ?></b></li>
                <li class="thong-tin">Ghi chú: <b><?php echo $note ?></b></li>
            </ul>
        </div>

        <div class="bang-gio-hang-thanh-toan">
            <table class="bang-gio-hang" style="width: 100%; text-align:center; font-family: Montserrat, sans-serif; font-size:14px" border="1" border-collapse:collapse>
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
                            <td>
                                <!-- <a href="pages/main/themgiohang.php?cong=<?php echo $cart_item['id'] ?>"><i class="fa fa-plus fa-style" aria-hidden="true"></i></a> -->
                                <?php echo $cart_item['soluong'] ?>
                                <!-- <a href="pages/main/themgiohang.php?tru=<?php echo $cart_item['id'] ?>"><i class="fa fa-minus fa-style" aria-hidden="true"></i></a> -->
                            </td>
                            <td><?php echo number_format($thanhtien, 0, ',', '.') . " đ" ?></td>

                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="8">
                            <p style="float:right; font-weight:bolder">Tổng tiền: <?php echo number_format($tongtien, 0, ',', '.') . " đ" ?></p>
                            <div style="clear:both"></div>

                            <?php
                            if (isset($_SESSION['dangky'])) {
                            ?>
                                <!-- <p><a href="pages/main/thanhtoan.php">Đặt hàng</a></p> -->
                                <p><a href="index.php?quanly=vanchuyen"><i class="fa fa-hand-o-left" aria-hidden="true"></i> Thông tin vận chuyển</a></p>
                                <!-- <p><a href="index.php?quanly=donhangdadat">Hoàn thành đơn hàng</a></p> -->
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </table>
        </div>
    </div>

    <div class="payment-method">
        <h3>Phương thức thanh toán</h3>
        <input type="radio" name="payment" id="tienmat" value="Tiền mặt" checked>Tiền mặt
        <input type="radio" name="payment" id="chuyenkhoan" value="Chuyển khoản">Chuyển khoản
        <input type="radio" name="payment" id="chuyenkhoan" value="MOMO">MOMO
        <input type="radio" name="payment" id="chuyenkhoan" value="PayPal">PayPal
        <input type="radio" name="payment" id="chuyenkhoan" value="VNPay">VNPay
    </div>
    <br>
    <button class="nut-dat-hang" type="submit" name="thanhtoanngay" value="Thanh toán ngay">Đặt hàng</button>
</form>

<br>
<div class="cua-hang">
    <a class="quay-lai" href="index.php">
        <i class="fa fa-hand-o-left" aria-hidden="true"></i>
        <span>
            <h4>QUAY LẠI CỬA HÀNG</h4>
        </span>
    </a>
</div>

<style>
    button.nut-dat-hang {
        background-color: #8ad1ca;
        color: white;
        padding: 15px;
        border-radius: 15px;
        width: 200px;
        font-size: 15px;
        display: block;
        margin: 0 auto;
        border: none;
        animation: fadeInLeft 1.9s ease-out;
    }

    button.nut-dat-hang:hover {
        background-color: #123f39;
    }

    .bang-gio-hang-thanh-toan {
        width: 80%;
        margin: 0 auto;
    }

    th.ten-san-pham {
        width: 400px;
    }

    .payment-method {
        text-align: center;
        margin: 0 auto;
    }
</style>