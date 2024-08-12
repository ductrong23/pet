<?php
include "../../config/config.php";

if (isset($_POST['update_quantity'])) {
    $code_cart = $_GET['code'];
    $soluongmua = $_POST['soluongmua'];

    foreach ($soluongmua as $id_cart_details => $soluong) {
        //  CẬP NHẬT SỐ LƯỢNG SẢN PHẨM TRONG BẢNG CART_DETAILS
        $sql_update_quantity = "UPDATE tbl_cart_details SET soluongmua='$soluong' WHERE id_cart_details='$id_cart_details'";
        mysqli_query($mysqli, $sql_update_quantity);
    }

    // Tính lại tổng tiền đơn hàng
    $sql_cart = "SELECT SUM(tbl_sanpham.giasp * tbl_cart_details.soluongmua) AS tongtien FROM tbl_cart_details
    JOIN tbl_sanpham ON tbl_cart_details.id_sanpham=tbl_sanpham.id_sanpham
    WHERE tbl_cart_details.code_cart='$code_cart'";

    $query_cart = mysqli_query($mysqli, $sql_cart);
    $row_cart = mysqli_fetch_array($query_cart);
    $tongtien = $row_cart['tongtien'];

    // Redirect về trang xem đơn hàng
    header('Location: ../../index.php?action=donhang&query=xemdonhang&code=' . $code_cart);
}
