<?php
// Xử lý tìm kiếm đơn hàng
if (isset($_POST['timkiem'])) {
    $sodienthoai = $_POST['phone'];

    // Truy vấn đơn hàng dựa vào số điện thoại từ bảng `tbl_shippingoff`, kết nối với `tbl_cartoff`
    $sql_order = "SELECT tbl_cartoff.code_cart, tbl_cartoff.cart_date, tbl_cartoff.namedathang, tbl_cartoff.shipping_address, tbl_shippingoff.phone 
                  FROM tbl_cartoff
                  JOIN tbl_shippingoff ON tbl_cartoff.cart_shipping = tbl_shippingoff.id_shippingoff
                  WHERE tbl_shippingoff.phone = '" . $sodienthoai . "'
                  ORDER BY tbl_cartoff.id_cartoff DESC";
    $query_order = mysqli_query($mysqli, $sql_order);
}
?>


<br><br>
<h2 style="font-family: Montserrat, sans-serif">KẾT QUẢ TÌM KIẾM ĐƠN HÀNG CHO SỐ ĐIỆN THOẠI: <?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?></h2>

<form method="POST" action="">
    <div class="form-group" style="text-align: center;">
        <label for="sodienthoai" style="font-family: Montserrat, sans-serif; color:#123f39">Nhập số điện thoại để tìm đơn hàng:</label><br><br>
        <input type="text" id="sodienthoai" name="phone" placeholder="Số điện thoại" style="padding: 10px; border: 1px solid #123f39; color:#123f39; border-radius: 10px" required>
        <button type="submit" name="timkiem" class="tim-don-hang">Tìm đơn hàng</button>
    </div>
</form>

<?php
if (isset($query_order)) {
    // Kiểm tra và hiển thị đơn hàng nếu có
    if (mysqli_num_rows($query_order) > 0) {
?>
        <h1 class="title-liet-ke" style="text-align:center; font-size: 32px; color: #123f39; font-family: Montserrat, sans-serif;">ĐƠN HÀNG ĐÃ MUA</h1>
        <div class="bang-lich-su-don-hang">
            <table class="bang-gio-hang" style="width:80%; margin:0 auto;" border="1" style="border-collapse:collapse">
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Tên người nhận</th>
                    <th>Địa chỉ nhận hàng</th>
                    <th>Số điện thoại</th>
                    <th>Ngày đặt hàng</th>
                    <th></th>
                </tr>
                <?php
                $i = 0;
                while ($row = mysqli_fetch_array($query_order)) {
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $row['code_cart'] ?></td>
                        <td><?php echo $row['namedathang'] ?></td>
                        <td><?php echo $row['shipping_address'] ?></td>
                        <td><?php echo $row['phone'] ?></td>
                        <td><?php echo $row['cart_date'] ?></td>
                        <td>
                            <a href="index.php?quanly=xemdonhangoff&code=<?php echo $row['code_cart'] ?>">Xem đơn hàng</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>

        <br>
        <div class="cua-hang">
            <a class="quay-lai" href="index.php">
                <i class="fa fa-hand-o-left" aria-hidden="true"></i>
                <span>
                    <h4>QUAY LẠI CỬA HÀNG</h4>
                </span>
            </a>
        </div>
<?php
    } else {
        echo "<p>Không tìm thấy đơn hàng nào với số điện thoại này.</p>";
    }
}
?>

<style>
    .tim-don-hang {
        border: 1px solid #123f39;
        background-color: white;
        color: #123f39;
        padding: 10px;
        border-radius: 10px;
    }
    .tim-don-hang:hover{
        cursor: pointer;
    }
</style>