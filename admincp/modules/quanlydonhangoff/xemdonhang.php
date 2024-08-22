<?php
$code = $_GET['code'];

// Truy vấn để lấy thông tin chi tiết đơn hàng từ bảng tbl_cartoff, tbl_cart_detailsoff, tbl_sanpham và tbl_shippingoff
$sql_lietke_dh = "SELECT tbl_cartoff.*, tbl_cart_detailsoff.*, tbl_sanpham.tensanpham, tbl_sanpham.giasp, tbl_shippingoff.name AS name, tbl_shippingoff.phone, tbl_shippingoff.address AS shipping_address
                 FROM tbl_cartoff
                 JOIN tbl_cart_detailsoff ON tbl_cartoff.code_cart = tbl_cart_detailsoff.code_cart
                 JOIN tbl_sanpham ON tbl_cart_detailsoff.id_sanpham = tbl_sanpham.id_sanpham
                 JOIN tbl_shippingoff ON tbl_cartoff.cart_shipping = tbl_shippingoff.id_shippingoff
                 WHERE tbl_cartoff.code_cart = '" . $code . "'
                 ORDER BY tbl_cart_detailsoff.id_cart_detailsoff DESC";

$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
?>

<h1 class="xem-don-hang">XEM ĐƠN HÀNG</h1>

<form action="modules/quanlydonhangoff/suadonhang.php?code=<?php echo $code; ?>" method="POST">
    <table class="bang-xem-don-hang" style="width:100%" border="1" style="border-collapse:collapse">
        <tr>
            <th>ID</th>
            <th>Mã đơn hàng</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
            <th>Hình thức thanh toán</th>
            <th>Quản lý</th>
        </tr>
        <?php
        $i = 0;
        $tongtien = 0;
        while ($row = mysqli_fetch_array($query_lietke_dh)) {
            $i++;
            $thanhtien = $row['giasp'] * $row['soluongmua'];
            $tongtien += $thanhtien;
        ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['code_cart'] ?></td>
                <td><?php echo $row['tensanpham'] ?></td>
                <td>
                    <input class="doi-so-luong" type="number" name="soluongmua[<?php echo $row['id_cart_detailsoff'] ?>]" value="<?php echo $row['soluongmua'] ?>" min="1">
                    <button class="nut-doi" type="submit" name="update_quantity">Cập nhật số lượng</button>
                </td>
                <td><?php echo number_format($row['giasp'], 0, ',', '.') . " đ" ?></td>
                <td><?php echo number_format($thanhtien, 0, ',', '.') . " đ" ?></td>
                <td><?php echo $row['cart_payment'] ?></td>
                <td>
                <a href="modules/quanlydonhangoff/xuly.php?action=delete_product
                &code=<?php echo $row['code_cart'] ?>
                &id_cart_detailsoff=<?php echo $row['id_cart_detailsoff'] ?>
                &id_sanpham=<?php echo $row['id_sanpham'] ?>
                &soluongmua=<?php echo $row['soluongmua'] ?>"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi đơn hàng?');"><i class="fa fa-trash-o" aria-hidden="true"></i>
                </a>
            </td>
            </tr>
        <?php
        }
        ?>
        <tr>
            <td colspan="8">
                <p style="float: right; font-weight: bolder">Tổng tiền: <?php echo number_format($tongtien, 0, ',', '.') . " đ" ?></p>
            </td>
        </tr>
    </table>
</form>

<style>
    input.doi-so-luong {
        width: 50px;
        text-align: center;
        padding: 7px;
        border-radius: 10px;
    }

    button.nut-doi {
        padding: 7px;
        border-radius: 10px;
        cursor: pointer;
        height: calc(6 - 2px);
        transition: 0.5s;
        position: relative;
    }

    button.nut-doi:hover {
        background-color: #123f39;
        color: white;
        scale: 1.06;
    }
</style>
