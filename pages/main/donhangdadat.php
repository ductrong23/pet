<h1>ĐƠN HÀNG ĐÃ ĐẶT</h1>
<div class="xac-nhan-don-hang">
    <div class="step"><span><a href="index.php?quanly=giohang">Giỏ hàng</a></span></div>
    <div class="step"><span><a href="index.php?quanly=vanchuyen">Vận chuyển</a></span></div>
    <div class="step"><span><a href="index.php?quanly=thongtinthanhtoan">Thanh toán</a></span></div>
    <div class="step-current"><span><a href="index.php?quanly=donhangdadat">Đơn hàng</a></span></div>
</div>

<?php
$code = $_GET['code'];
// $sql_lietke_dh = "SELECT * FROM tbl_cart, tbl_cart_details, tbl_sanpham WHERE tbl_cart_details.id_sanpham=tbl_sanpham.id_sanpham 
// AND tbl_cart_details.code_cart='" . $code . "'  ORDER BY tbl_cart_details.id_cart_details DESC";
$sql_lietke_dh = "SELECT * FROM tbl_cart
JOIN tbl_cart_details ON tbl_cart_details.code_cart = tbl_cart.code_cart
JOIN tbl_sanpham ON tbl_cart_details.id_sanpham = tbl_sanpham.id_sanpham
WHERE tbl_cart_details.code_cart = '" . $code . "'
ORDER BY tbl_cart_details.id_cart_details DESC";

$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
?>
<h1 class="xem-don-hang" >XEM ĐƠN HÀNG</h1>
<table class="bang-xem-don-hang" style="width:100%" border="1" style="border-collapse:collapse">
    <tr>
        <!-- <th>ID</th> -->
        <th>Mã đơn hàng</th>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Đơn giá</th>
        <th>Thành tiền</th>
        <th>Hình thức thanh toán</th>
    </tr>
    <?php
    $i = 0;
    $tongtien = 0;
    $thanhtien = 0;
    while ($row = mysqli_fetch_array($query_lietke_dh)) {
        $i++;
        $thanhtien = $row['giasp'] * $row['soluongmua'];
        $tongtien += $thanhtien;
    ?>
        <tr>
            <!-- <td><?php echo $i ?></td> -->
            <td><?php echo $row['code_cart'] ?></td>
            <td><?php echo $row['tensanpham'] ?></td>
            <td><?php echo $row['soluongmua'] ?></td>
            <td><?php echo number_format($row['giasp'], 0, ',', '.') . " đ" ?></td>
            <td><?php echo number_format($thanhtien, 0, ',', '.') . " đ" ?></td>
            <td><?php echo $row['cart_payment'] ?></td>
        </tr>
    <?php
    }

    ?>
    <tr>
        <td colspan="7">
            <p>Tổng tiền: <?php echo number_format($tongtien, 0, ',', '.') . " đ" ?></p>
        </td>
    </tr>

</table>
