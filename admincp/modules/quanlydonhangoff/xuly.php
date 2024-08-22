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
    $sql = "UPDATE tbl_cartoff SET cart_status='" . $status . "' WHERE code_cart='" . $code_cart . "'";
    $query = mysqli_query($mysqli, $sql);

    header('Location: ../../index.php?action=quanlydonhangoff&query=lietke');
}

// XOÁ ĐƠN HÀNG => UPDATE SỐ LƯỢNG
elseif (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['code'])) {
    $code_cart = $_GET['code'];

    // Cập nhật tình trạng đơn hàng là hủy (5)
    $sql = "UPDATE tbl_cartoff SET cart_status='5' WHERE code_cart='" . $code_cart . "'";
    $query = mysqli_query($mysqli, $sql);

    // Truy xuất tất cả các sản phẩm trong đơn hàng
    $sql_cart_details = "SELECT id_sanpham, soluongmua FROM tbl_cart_detailsoff WHERE code_cart='" . $code_cart . "'";
    $query_cart_details = mysqli_query($mysqli, $sql_cart_details);

    // Cộng lại số lượng hàng trong kho
    while ($row = mysqli_fetch_array($query_cart_details)) {
        $id_sanpham = $row['id_sanpham'];
        $soluongmua = $row['soluongmua'];

        $sql_update_product = "UPDATE tbl_sanpham SET soluong = soluong + $soluongmua WHERE id_sanpham = $id_sanpham";
        mysqli_query($mysqli, $sql_update_product);
    }

    // XOÁ ĐƠN HÀNG
    $sql_delete_cart_details = "DELETE FROM tbl_cart_detailsoff WHERE code_cart='" . $code_cart . "'";
    mysqli_query($mysqli, $sql_delete_cart_details);

    $sql_delete_cart = "DELETE FROM tbl_cartoff WHERE code_cart='" . $code_cart . "'";
    mysqli_query($mysqli, $sql_delete_cart);

    header('Location: ../../index.php?action=quanlydonhangoff&query=lietke');
}

// XOÁ SẢN PHẨM TRONG ĐƠN HÀNG => UPDATE SỐ LƯỢNG
// KIỂM TRA ĐƠN HÀNG RỖNG => XOÁ ĐƠN HÀNG
elseif (isset($_GET['action']) && trim($_GET['action']) == 'delete_product' && isset($_GET['id_cart_detailsoff']) && isset($_GET['id_sanpham']) && isset($_GET['soluongmua'])) {
    $id_cart_details = $_GET['id_cart_detailsoff'];
    $id_sanpham = $_GET['id_sanpham'];
    $soluongmua = $_GET['soluongmua'];
    $code_cart = $_GET['code'];


    // Cộng lại số lượng hàng trong kho
    $sql_update_product = "UPDATE tbl_sanpham SET soluong = soluong + $soluongmua WHERE id_sanpham = $id_sanpham";
    mysqli_query($mysqli, $sql_update_product);

    // XOÁ SẢN PHẨM KHỎI ĐƠN HÀNG
    $sql_delete_cart_detail = "DELETE FROM tbl_cart_detailsoff WHERE id_cart_detailsoff = $id_cart_details";
    mysqli_query($mysqli, $sql_delete_cart_detail);

    // Kiểm tra xem còn sản phẩm nào trong đơn hàng không
    $sql_check_cart = "SELECT COUNT(*) as count FROM tbl_cart_detailsoff WHERE code_cart='" . $code_cart . "'";
    $query_check_cart = mysqli_query($mysqli, $sql_check_cart);
    $row_check_cart = mysqli_fetch_array($query_check_cart);

    if ($row_check_cart['count'] == 0) {
        // Nếu không còn sản phẩm, xóa luôn đơn hàng
        // $sql_delete_cart = "DELETE FROM tbl_cartoff WHERE code_cart='" . $code_cart . "'";
        // mysqli_query($mysqli, $sql_delete_cart);
        // header('Location: ../../index.php?action=quanlydonhangoff&query=lietke');
        echo "<script>
        if (confirm('Đơn hàng hiện tại không còn sản phẩm. Bạn có muốn xóa đơn hàng này không?')) {
            window.location.href = 'xuly.php?action=delete&code=" . $code_cart . "';
            // window.location.href = 'modules/quanlydonhangoff/xuly.php?action=delete&code=". $code_cart . "';
        } else {
            window.location.href = '../../index.php?action=donhang&query=xemdonhangoff&code=" . $code_cart . "';
        }
    </script>";
    } else {
        header('Location: ../../index.php?action=donhang&query=xemdonhangoff&code=' . $code_cart);
    }
}

