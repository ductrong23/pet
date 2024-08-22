

<br><br>
<h1 class="xem-don-hang" style="text-align: center; font-size: 32px; color: #123f39; font-family: Montserrat, sans-serif;">XEM ĐƠN HÀNG</h1>

<?php
if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // Truy vấn chi tiết đơn hàng dựa trên mã đơn hàng
    $sql_xem_don_hang = "SELECT * FROM tbl_cartoff
    JOIN tbl_cart_detailsoff ON tbl_cart_detailsoff.code_cart = tbl_cartoff.code_cart
    JOIN tbl_sanpham ON tbl_cart_detailsoff.id_sanpham = tbl_sanpham.id_sanpham
    JOIN tbl_shippingoff ON tbl_cartoff.cart_shipping = tbl_shippingoff.id_shippingoff
    WHERE tbl_cartoff.code_cart = '" . $code . "'
    ORDER BY tbl_cart_detailsoff.id_cart_detailsoff DESC";

    $query_xem_don_hang = mysqli_query($mysqli, $sql_xem_don_hang);

    if (mysqli_num_rows($query_xem_don_hang) > 0) {
?>
        <div class="bang-xem-don-hang">
            <table class="bang-gio-hang" style="width:90%; margin: 0 auto" border="1" style="border-collapse:collapse; font-family: Montserrat, sans-serif;">
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                    <th>Hình thức thanh toán</th>
                    <th>Tình trạng</th>
                </tr>
                <?php
                $tongtien = 0;
                while ($row = mysqli_fetch_array($query_xem_don_hang)) {
                    $thanhtien = $row['giasp'] * $row['soluongmua'];
                    $tongtien += $thanhtien;
                ?>
                    <tr>
                        <td><?php echo $row['code_cart'] ?></td>
                        <td><?php echo $row['tensanpham'] ?></td>
                        <td><?php echo $row['soluongmua'] ?></td>
                        <td><?php echo number_format($row['giasp'], 0, ',', '.') . " đ" ?></td>
                        <td><?php echo number_format($thanhtien, 0, ',', '.') . " đ" ?></td>
                        <td><?php echo $row['cart_payment'] ?></td>
                        <td>
                            <?php
                            switch ($row['cart_status']) {
                                case 0:
                                    echo 'Đơn hàng mới';
                                    break;
                                case 1:
                                    echo 'Đã xác nhận';
                                    break;
                                case 2:
                                    echo 'Đang vận chuyển';
                                    break;
                                case 3:
                                    echo 'Đang giao hàng';
                                    break;
                                case 4:
                                    echo 'Đã giao hàng';
                                    break;
                                case 5:
                                    echo 'Đã thanh toán';
                                    break;
                                default:
                                    echo 'Không xác định';
                                    break;
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan="7">
                        <p style="float:right; font-weight:bolder; font-family: Montserrat, sans-serif; font-size:14px">Tổng tiền: <?php echo number_format($tongtien, 0, ',', '.') . " đ" ?></p>
                    </td>
                </tr>
            </table>
        </div>
<?php
    } else {
        echo "<p style='text-align:center;'>Không tìm thấy chi tiết đơn hàng với mã đơn hàng: $code</p>";
    }
}
?>


<br>

<br>
<div class="cua-hang">
    <a class="quay-lai" href="index.php">
        <i class="fa fa-hand-o-left" aria-hidden="true"></i>
        <span>
            <h4>QUAY LẠI CỬA HÀNG</h4>
        </span>
    </a>
</div>