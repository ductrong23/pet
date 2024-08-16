<?php
include "../../config/config.php";

if (isset($_POST['update_quantity'])) {
    $code_cart = $_GET['code'];
    $soluongmua = $_POST['soluongmua'];

    // foreach ($soluongmua as $id_cart_detailsoff => $soluong) {
    //     // CẬP NHẬT SỐ LƯỢNG SẢN PHẨM TRONG BẢNG tbl_cart_detailsoff
    //     $sql_update_quantity = "UPDATE tbl_cart_detailsoff SET soluongmua='$soluong' WHERE id_cart_detailsoff='$id_cart_detailsoff'";
    //     mysqli_query($mysqli, $sql_update_quantity);
    // }


    //  CẬP NHẬT SỐ LƯỢNG HÀNG CỦA ĐƠN HÀNG => CẬP NHẬT SỐ LƯỢNG HÀNG TRONG KHO
    foreach ($soluongmua as $id_cart_detailsoff => $soluong) {

        // Lấy số lượng sản phẩm trong kho trước khi cập nhật
        $sql_get_product_id = "SELECT id_sanpham FROM tbl_cart_detailsoff WHERE id_cart_detailsoff='$id_cart_detailsoff'";
        $query_get_product_id = mysqli_query($mysqli, $sql_get_product_id);
        $row_product_id = mysqli_fetch_array($query_get_product_id);
        $id_sanpham = $row_product_id['id_sanpham'];

        $sql_get_stock = "SELECT soluong FROM tbl_sanpham WHERE id_sanpham='$id_sanpham'";
        $query_get_stock = mysqli_query($mysqli, $sql_get_stock);
        $row_stock = mysqli_fetch_array($query_get_stock);
        $current_stock = $row_stock['soluong'];

        // Lấy số lượng hàng đã được đặt từ đơn hàng
        $sql_get_order_quantity = "SELECT soluongmua FROM tbl_cart_detailsoff WHERE id_cart_detailsoff='$id_cart_detailsoff'";
        $query_get_order_quantity = mysqli_query($mysqli, $sql_get_order_quantity);
        $row_order_quantity = mysqli_fetch_array($query_get_order_quantity);
        $old_quantity = $row_order_quantity['soluongmua'];

        // Cập nhật số lượng sản phẩm trong bảng tbl_cart_detailsoff
        $sql_update_quantity = "UPDATE tbl_cart_detailsoff SET soluongmua='$soluong' WHERE id_cart_detailsoff='$id_cart_detailsoff'";
        mysqli_query($mysqli, $sql_update_quantity);

        // Tính toán sự thay đổi số lượng hàng đã đặt (tăng/giảm bao nhiêu sản phẩm)
        $quantity_change = $old_quantity - $soluong;

        // Cập nhật số lượng hàng trong kho
        $new_stock = $current_stock + $quantity_change;
        $sql_update_stock = "UPDATE tbl_sanpham SET soluong='$new_stock' WHERE id_sanpham='$id_sanpham'";
        mysqli_query($mysqli, $sql_update_stock);
    }


    // Tính lại tổng tiền đơn hàng
    $sql_cart = "SELECT SUM(tbl_sanpham.giasp * tbl_cart_detailsoff.soluongmua) AS tongtien 
                 FROM tbl_cart_detailsoff
                 JOIN tbl_sanpham ON tbl_cart_detailsoff.id_sanpham = tbl_sanpham.id_sanpham
                 WHERE tbl_cart_detailsoff.code_cart = '$code_cart'";

    $query_cart = mysqli_query($mysqli, $sql_cart);
    $row_cart = mysqli_fetch_array($query_cart);
    $tongtien = $row_cart['tongtien'];

    // Cập nhật tổng tiền vào bảng đơn hàng
    $sql_update_cart = "UPDATE tbl_cartoff SET tongtien='$tongtien' WHERE code_cart='$code_cart'";
    mysqli_query($mysqli, $sql_update_cart);

    // Redirect về trang xem đơn hàng
    header('Location: ../../index.php?action=donhang&query=xemdonhangoff&code=' . $code_cart);
}
?>
