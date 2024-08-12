<?php

//  XỬ LÝ TÌNH TRẠNG ĐƠN HÀNG
// 0: Đơn hàng mới
// 1: Đã xử lý
// 2: Đang vận chuyển
// 3: Đang giao hàng
// 4: Đã giao hàng
// 5: Đã huỷ đơn
// ====================================================================================================

include "../../config/config.php";

if (isset($_GET['code']) && isset($_GET['cart_status'])) {
    $status = $_GET['cart_status'];
    $code_cart = $_GET['code'];

    //  CẬP NHẬT TÌNH TRẠNG ĐƠN HÀNG
    $sql = "UPDATE tbl_cart SET cart_status='" . $status . "' WHERE code_cart='" . $code_cart . "'";
    $query = mysqli_query($mysqli, $sql);

    header('Location: ../../index.php?action=quanlydonhang&query=lietke');
} elseif (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['code'])) {
    $code_cart = $_GET['code'];

    // Cập nhật tình trạng đơn hàng là hủy (5)
    $sql = "UPDATE tbl_cart SET cart_status='5' WHERE code_cart='" . $code_cart . "'";
    $query = mysqli_query($mysqli, $sql);

    // XOÁ ĐƠN HÀNG
    $sql_delete_cart_details = "DELETE FROM tbl_cart_details WHERE code_cart='" . $code_cart . "'";
    mysqli_query($mysqli, $sql_delete_cart_details);

    $sql_delete_cart = "DELETE FROM tbl_cart WHERE code_cart='" . $code_cart . "'";
    mysqli_query($mysqli, $sql_delete_cart);

    header('Location: ../../index.php?action=quanlydonhang&query=lietke');
}
