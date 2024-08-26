<div id="popupModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="popupMessage"></p>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="../../css/vanchuyen.css">
<script src="../../js/xulythanhtoanoff.js"></script>

<?php
session_start();
include "../../admincp/config/config.php";
// require "../../mail/sendmail.php";
require "../../carbon/autoload.php";

use Carbon\Carbon;
use Carbon\CarbonInterval;

$code_order = rand(0, 9999);
$cart_payment = $_POST['payment'];

// Kiểm tra thời gian hết hạn trước khi thực hiện mua hàng
function kiemTraMuaNgayHetHan()
{
    if (isset($_SESSION['muangay_time'])) {
        $hienTai = time();
        $thoiGianTao = $_SESSION['muangay_time'];
        $thoiHan = 90; // 90 giây

        if (($hienTai - $thoiGianTao) > $thoiHan) {
            unset($_SESSION['muangay']);
            unset($_SESSION['muangay_time']);
            return false;
        }
    }
    return true;
}


// Kiểm tra trạng thái mua ngay
if (!kiemTraMuaNgayHetHan()) {
    // Thông báo hết thời gian
    echo '<script>showPopup("Thời gian mua hàng đã hết, vui lòng thêm sản phẩm lại.")</script>';
    // header('Location: ../../index.php');
    echo "'../../index.php'";
    exit();
}


// Lấy ID thông tin vận chuyển từ session
if (isset($_SESSION['shippingoff_id'])) {
    $shippingoff_id = $_SESSION['shippingoff_id'];

    // Lấy thông tin vận chuyển từ bảng `tbl_shippingoff`
    $sql_get_vanchuyen = mysqli_query($mysqli, "SELECT * FROM tbl_shippingoff WHERE id_shippingoff='$shippingoff_id' LIMIT 1");
    $row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);
    $shipping_address = $row_get_vanchuyen['address'];
    $namedathang = $row_get_vanchuyen['name'];
    $now = Carbon::now('Asia/Ho_Chi_Minh');


    // Xác định giỏ hàng để xử lý
    $cart_to_process = isset($_SESSION['muangay']) ? $_SESSION['muangay'] : $_SESSION['cart'];
    $popupMessage = '';
    // Kiểm tra số lượng hàng trong kho trước khi xử lý đặt hàng
    foreach ($cart_to_process as $key => $value) {
        $id_sanpham = $value['id'];
        $soluong = $value['soluong'];

        $sql_chitiet = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.id_sanpham='$id_sanpham' LIMIT 1";
        $query_chitiet = mysqli_query($mysqli, $sql_chitiet);
        $row_chitiet = mysqli_fetch_array($query_chitiet);

        if ($soluong > $row_chitiet['soluong']) {
            echo '<script>
            showPopup("<p>Sản phẩm ' . $value['tensanpham'] . '</p> <p> Hiện còn ' . $row_chitiet['soluong'] . ' sản phẩm.<p>Không đủ đáp ứng đơn hàng. Vui lòng giảm số lượng hoặc chọn sản phẩm khác.</p>", ';
            if (isset($_SESSION['id_khachhang'])) {
                echo "'../../index.php?quanly=vanchuyen'";
            } else {
                echo "'../../index.php?quanly=vanchuyenoff'";
            }
            echo ');
        </script>';
            return;
        }
    }

    // INSERT vào bảng `tbl_cartoff`
    $insert_cart = "INSERT INTO tbl_cartoff(code_cart, cart_status, cart_payment, cart_shipping, shipping_address, cart_date, namedathang) 
                    VALUES('$code_order', 0, '$cart_payment', '$shippingoff_id', '$shipping_address', '$now', '$namedathang')";
    $cart_query = mysqli_query($mysqli, $insert_cart);

    if ($cart_query) {
        // Thêm giỏ hàng chi tiết vào bảng `tbl_cart_detailsoff`
        // foreach ($_SESSION['cart'] as $key => $value) {
        foreach ($cart_to_process as $key => $value) {
            $id_sanpham = $value['id'];
            $soluong = $value['soluong']; // Số lượng sản phẩm mua
            $insert_order_details = "INSERT INTO tbl_cart_detailsoff(id_sanpham, code_cart, soluongmua) 
                                     VALUES('$id_sanpham', '$code_order', '$soluong')";
            mysqli_query($mysqli, $insert_order_details);

            // // Quản lý số lượng sản phẩm trong kho
            // $sql_chitiet = "SELECT * FROM tbl_sanpham WHERE id_sanpham='$id_sanpham' LIMIT 1";
            // $query_chitiet = mysqli_query($mysqli, $sql_chitiet);

            // while ($row_chitiet = mysqli_fetch_array($query_chitiet)) {
            //     $soluongtong = $row_chitiet['soluong'];
            //     $soluongcon = $soluongtong - $soluong;

            //     // UPDATE lại số lượng trong bảng `tbl_sanpham`
            //     $sql_update_soluong = "UPDATE tbl_sanpham SET soluong='$soluongcon' WHERE id_sanpham='$id_sanpham'";
            //     mysqli_query($mysqli, $sql_update_soluong);
            // }

            $soluongcon = $row_chitiet['soluong'] - $soluong;
            // UPDATE lại số lượng trong bảng `tbl_sanpham`
            $sql_update_soluong = "UPDATE tbl_sanpham SET soluong='$soluongcon' WHERE id_sanpham='$id_sanpham'";
            mysqli_query($mysqli, $sql_update_soluong);
        }

        // Kiểm tra nguồn gốc đặt hàng và thực hiện unset tương ứng
        if (isset($_SESSION['muangay'])) {
            unset($_SESSION['muangay']);
            unset($_SESSION['shippingoff_id']);
        } else {
            unset($_SESSION['cart']); // Xóa giỏ hàng khi đã mua từ giỏ hàng
            unset($_SESSION['shippingoff_id']);
        }

        header('Location: ../../index.php?quanly=camonoff');
    } else {
        echo '<script>showPopup("Đặt hàng không thành công. Vui lòng thử lại.")</script>';
    }
} else {
    echo '<script>showPopup("Không tìm thấy thông tin vận chuyển. Vui lòng thử lại.")</script>';
    // header('Location: ../../index.php?quanly=vanchuyenoff');
    echo "'../../index.php?quanly=vanchuyenoff'";
}
?>