<h1>THANH TOÁN</h1>
<?php
session_start();
include "../../admincp/config/config.php";
require "../../mail/sendmail.php";

$id_khachhang = $_SESSION['id_khachhang'];
$code_order = rand(0, 9999);
$cart_payment = $_POST['payment'];

//  Lấy ID thông tin vận chuyển
$id_dangky = $_SESSION['id_khachhang'];
$sql_get_vanchuyen = mysqli_query($mysqli, "SELECT * FROM tbl_shipping WHERE id_dangky='$id_dangky' LIMIT 1");
$row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);
$id_shipping = $row_get_vanchuyen['id_shipping'];

//  INSERT và database
$insert_cart = "INSERT INTO tbl_cart(id_khachhang, code_cart, cart_status, cart_payment, cart_shipping) 
VALUE('" . $id_khachhang . "', '" . $code_order . "', 1,'" . $cart_payment . "','" . $id_shipping . "')";
$cart_query = mysqli_query($mysqli, $insert_cart);

if ($cart_query) {
    //  Thêm giỏ hàng chi tiết tbl_cart_details
    foreach ($_SESSION['cart'] as $key => $value) {
        $id_sanpham = $value['id'];
        $soluong = $value['soluong']; //    Số lượng sản phẩm mua
        $insert_order_details = "INSERT INTO tbl_cart_details(id_sanpham, code_cart, soluongmua) VALUE('" . $id_sanpham . "', '" . $code_order . "', '" . $soluong . "')";
        mysqli_query($mysqli, $insert_order_details);

        //  Quản lý số lượng sản phẩm trong kho
        $sql_chitiet = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.id_sanpham='$id_sanpham' LIMIT 1";
        $query_chitiet = mysqli_query($mysqli, $sql_chitiet);

        while ($row_chitiet = mysqli_fetch_array($query_chitiet)) {
            $soluongtong = $row_chitiet['soluong'];
            $soluongcon = $row_chitiet['soluong'] - $soluong;
        }
        //  UPDATE lại số lượng
        $sql_update_soluong = "UPDATE tbl_sanpham SET soluong='" . $soluongcon . "'
         WHERE id_sanpham='$id_sanpham'";
         mysqli_query($mysqli, $sql_update_soluong);
    }
    $tieude = "BẠN ĐÃ ĐẶT HÀNG THÀNH CÔNG";
    $noidung = 'CẢM ƠN QUÝ KHÁCH';
    $maildathang = $_SESSION['email'];
    $mail = new Mailer();
    $mail->dathangmail($tieude, $noidung, $maildathang);
}
unset($_SESSION['cart']); //    Xoá giỏ hàng khi đã mua
header('Location: ../../index.php?quanly=camon');
?>