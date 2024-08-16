<?php
function saveUserCart($user_id, $cart_data) {
    global $mysqli;

    // Chuyển đổi dữ liệu giỏ hàng thành định dạng serialize
    $cart_data_serialized = serialize($cart_data);

    // Xóa dữ liệu giỏ hàng cũ
    $delete_sql = "DELETE FROM tbl_user_cart WHERE id_dangky = ?";
    $delete_stmt = $mysqli->prepare($delete_sql);
    $delete_stmt->bind_param('i', $user_id);
    $delete_stmt->execute();
    $delete_stmt->close();

    // Thêm dữ liệu giỏ hàng mới
    $insert_sql = "INSERT INTO tbl_user_cart (id_dangky, cart_data) VALUES (?, ?)";
    $insert_stmt = $mysqli->prepare($insert_sql);
    $insert_stmt->bind_param('is', $user_id, $cart_data_serialized);
    if ($insert_stmt->execute()) {
        error_log("Successfully saved cart for user $user_id: " . print_r($cart_data, true));
    } else {
        error_log("Error saving cart for user $user_id: " . $insert_stmt->error);
    }
    $insert_stmt->close();
}

function loadUserCart($user_id) {
    global $mysqli;

    // Truy vấn để lấy dữ liệu giỏ hàng
    $sql = "SELECT cart_data FROM tbl_user_cart WHERE id_dangky = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->bind_result($cart_data_serialized);
    if ($stmt->fetch()) {
        $cart_data = unserialize($cart_data_serialized);
        error_log("Successfully loaded cart for user $user_id: " . print_r($cart_data, true));
        $stmt->close();
        return $cart_data;
    } else {
        error_log("No cart data found for user $user_id");
        $stmt->close();
        return array();
    }
}
?>