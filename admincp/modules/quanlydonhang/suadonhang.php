<?php
include "../../config/config.php";

if (isset($_POST['update_quantity'])) {
    $code_cart = $_GET['code'];
    $soluongmua = $_POST['soluongmua'];

    // foreach ($soluongmua as $id_cart_details => $soluong) {
    //     //  CẬP NHẬT SỐ LƯỢNG SẢN PHẨM TRONG BẢNG CART_DETAILS
    //     $sql_update_quantity = "UPDATE tbl_cart_details SET soluongmua='$soluong' WHERE id_cart_details='$id_cart_details'";
    //     mysqli_query($mysqli, $sql_update_quantity);
    // }


    //  CẬP NHẬT SỐ LƯỢNG HÀNG CỦA ĐƠN HÀNG => CẬP NHẬT SỐ LƯỢNG HÀNG TRONG KHO
    foreach ($soluongmua as $id_cart_details => $soluong) {

        // Lấy số lượng sản phẩm trong kho trước khi cập nhật
        $sql_get_product_id = "SELECT id_sanpham FROM tbl_cart_details WHERE id_cart_details='$id_cart_details'";
        $query_get_product_id = mysqli_query($mysqli, $sql_get_product_id);
        $row_product_id = mysqli_fetch_array($query_get_product_id);
        $id_sanpham = $row_product_id['id_sanpham'];

        $sql_get_stock = "SELECT soluong FROM tbl_sanpham WHERE id_sanpham='$id_sanpham'";
        $query_get_stock = mysqli_query($mysqli, $sql_get_stock);
        $row_stock = mysqli_fetch_array($query_get_stock);
        $current_stock = $row_stock['soluong'];

        // Lấy số lượng hàng đã được đặt từ đơn hàng
        $sql_get_order_quantity = "SELECT soluongmua FROM tbl_cart_details WHERE id_cart_details='$id_cart_details'";
        $query_get_order_quantity = mysqli_query($mysqli, $sql_get_order_quantity);
        $row_order_quantity = mysqli_fetch_array($query_get_order_quantity);
        $old_quantity = $row_order_quantity['soluongmua'];

        // Cập nhật số lượng sản phẩm trong bảng tbl_cart_detailsoff
        $sql_update_quantity = "UPDATE tbl_cart_details SET soluongmua='$soluong' WHERE id_cart_details='$id_cart_details'";
        mysqli_query($mysqli, $sql_update_quantity);

        // Tính toán sự thay đổi số lượng hàng
        $quantity_change = $old_quantity - $soluong;

        // Cập nhật số lượng hàng trong kho
        $new_stock = $current_stock + $quantity_change;
        $sql_update_stock = "UPDATE tbl_sanpham SET soluong='$new_stock' WHERE id_sanpham='$id_sanpham'";
        mysqli_query($mysqli, $sql_update_stock);
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
