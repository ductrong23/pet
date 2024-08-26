<div id="popupModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="popupMessage"></p>
    </div>
</div>
<script src="../../js/xemdonhang.js"></script>
<script src="../../js/suadonhangoff.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/popup.css">

<?php
include "../../config/config.php";

if (isset($_POST['update_quantity'])) {
    $code_cart = $_GET['code'];
    $soluongmua = $_POST['soluongmua'];
    $errors = []; // Array để lưu thông báo lỗi

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

        // Tính toán sự thay đổi số lượng hàng
        /*
        $soluong: số lượng hàng tăng đến số nào
        $quantity_change: số lượng hàng chênh lệch 
         */
        $quantity_change = $old_quantity - $soluong;

        // Lấy thông tin sản phẩm từ bảng tbl_sanpham
        $sql_get_product_name = "SELECT tensanpham FROM tbl_sanpham WHERE id_sanpham='$id_sanpham'";
        $query_get_product_name = mysqli_query($mysqli, $sql_get_product_name);
        $row_product_name = mysqli_fetch_array($query_get_product_name);
        $product_name = $row_product_name['tensanpham'];

        // $quantity_change < 0 thì số lượng thay đổi sẽ tăng, kiểm tra xem -($quantity_change) lớn hơn số hàng còn trong kho => Thông báo
        if ($quantity_change < 0 && - ($quantity_change) > $current_stock) {
            $errors[] = "<p>Số lượng sản phẩm " . $product_name . " trong kho không đủ</p> <p>Hiện tại còn " . $current_stock . " sản phẩm trong kho</p><p>Bạn không thể tăng " . - ($quantity_change) . " sản phẩm được";
        } else {
            // Cập nhật số lượng sản phẩm trong bảng tbl_cart_detailsoff
            $sql_update_quantity = "UPDATE tbl_cart_detailsoff SET soluongmua='$soluong' WHERE id_cart_detailsoff='$id_cart_detailsoff'";
            mysqli_query($mysqli, $sql_update_quantity);

            // Cập nhật số lượng hàng trong kho
            $new_stock = $current_stock + $quantity_change;
            $sql_update_stock = "UPDATE tbl_sanpham SET soluong='$new_stock' WHERE id_sanpham='$id_sanpham'";
            mysqli_query($mysqli, $sql_update_stock);
        }
    }


    if (!empty($errors)) {
        // Nếu có lỗi, hiển thị popup với thông báo lỗi
        $error_message = implode("<br>", $errors);
        echo '<script>
            showPopup("' . $error_message . '", "' . $code_cart . '");
        </script>';
    } else {
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
}
?>

<?php
// Sau Lấy số lượng hàng đã được đặt từ đơn hàng
// // Cập nhật số lượng sản phẩm trong bảng tbl_cart_detailsoff
// $sql_update_quantity = "UPDATE tbl_cart_detailsoff SET soluongmua='$soluong' WHERE id_cart_detailsoff='$id_cart_detailsoff'";
// mysqli_query($mysqli, $sql_update_quantity);

// // Tính toán sự thay đổi số lượng hàng đã đặt (tăng/giảm bao nhiêu sản phẩm)
// $quantity_change = $old_quantity - $soluong;

// // Cập nhật số lượng hàng trong kho
// $new_stock = $current_stock + $quantity_change;
// $sql_update_stock = "UPDATE tbl_sanpham SET soluong='$new_stock' WHERE id_sanpham='$id_sanpham'";
// mysqli_query($mysqli, $sql_update_stock);
