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
    echo '<script>alert("Thời gian mua hàng đã hết, vui lòng thêm sản phẩm lại.")</script>';
    header('Location: ../../index.php');
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

    // INSERT vào bảng `tbl_cartoff`
    $insert_cart = "INSERT INTO tbl_cartoff(code_cart, cart_status, cart_payment, cart_shipping, shipping_address, cart_date, namedathang) 
                    VALUES('$code_order', 0, '$cart_payment', '$shippingoff_id', '$shipping_address', '$now', '$namedathang')";
    $cart_query = mysqli_query($mysqli, $insert_cart);

    if ($cart_query) {

        // Xác định giỏ hàng để xử lý
        $cart_to_process = isset($_SESSION['muangay']) ? $_SESSION['muangay'] : $_SESSION['cart'];

        // Thêm giỏ hàng chi tiết vào bảng `tbl_cart_detailsoff`
        // foreach ($_SESSION['cart'] as $key => $value) {
        foreach ($cart_to_process as $key => $value) {
            $id_sanpham = $value['id'];
            $soluong = $value['soluong']; // Số lượng sản phẩm mua
            $insert_order_details = "INSERT INTO tbl_cart_detailsoff(id_sanpham, code_cart, soluongmua) 
                                     VALUES('$id_sanpham', '$code_order', '$soluong')";
            mysqli_query($mysqli, $insert_order_details);

            // Quản lý số lượng sản phẩm trong kho
            $sql_chitiet = "SELECT * FROM tbl_sanpham WHERE id_sanpham='$id_sanpham' LIMIT 1";
            $query_chitiet = mysqli_query($mysqli, $sql_chitiet);

            while ($row_chitiet = mysqli_fetch_array($query_chitiet)) {
                $soluongtong = $row_chitiet['soluong'];
                $soluongcon = $soluongtong - $soluong;

                // UPDATE lại số lượng trong bảng `tbl_sanpham`
                $sql_update_soluong = "UPDATE tbl_sanpham SET soluong='$soluongcon' WHERE id_sanpham='$id_sanpham'";
                mysqli_query($mysqli, $sql_update_soluong);
            }
        }

        // Gửi email xác nhận đơn hàng (nếu cần thiết)
        // $tieude = "BẠN ĐÃ ĐẶT HÀNG THÀNH CÔNG TẠI PETSTORE";
        // $noidung = '<p>MÃ ĐƠN HÀNG CỦA BẠN: ' . $code_order . '</p>';
        // $noidung .= "<h4>ĐƠN HÀNG ĐÃ ĐẶT BAO GỒM:</h4>";
        // foreach ($_SESSION['cart'] as $key => $val) {
        //     $noidung .= "<ul style='border: 1px solid black; margin: 10px;'>
        //     <li>Tên sản phẩm: " . $val['tensanpham'] . "</li>
        //     <li>Mã sản phẩm: " . $val['masp'] . "</li>
        //     <li>Giá sản phẩm: " . number_format($val['giasp'], 0, ',', '.') . " đ</li>
        //     <li>Số lượng: " . $val['soluong'] . "</li>
        //     </ul>";
        // }
        // $maildathang = $_SESSION['email'];
        // $mail = new Mailer();
        // $mail->dathangmail($tieude, $noidung, $maildathang);


        // Kiểm tra nguồn gốc đặt hàng và thực hiện unset tương ứng
        if (isset($_SESSION['muangay'])) {
            unset($_SESSION['muangay']);
            unset($_SESSION['shippingoff_id']);
        } else {
            unset($_SESSION['cart']); // Xóa giỏ hàng khi đã mua từ giỏ hàng
            unset($_SESSION['shippingoff_id']);
        }

        // Xóa giỏ hàng sau khi đặt hàng thành công
        // unset($_SESSION['cart']);
        // unset($_SESSION['shippingoff_id']);

        header('Location: ../../index.php?quanly=camonoff');
    } else {
        echo '<script>alert("Đặt hàng không thành công. Vui lòng thử lại.")</script>';
    }
} else {
    echo '<script>alert("Không tìm thấy thông tin vận chuyển. Vui lòng thử lại.")</script>';
    header('Location: ../../index.php?quanly=vanchuyenoff');
}
