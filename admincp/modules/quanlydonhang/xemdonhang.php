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
<h1 class="xem-don-hang">XEM ĐƠN HÀNG</h1>
<form action="modules/quanlydonhang/suadonhang.php?code=<?php echo $code; ?>" method="POST">
    <table class="bang-xem-don-hang" style="width:100%" border="1" style="border-collapse:collapse">
        <tr>
            <th>ID</th>
            <th>Mã đơn hàng</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
            <th>Hình thức thanh toán</th>


            <!-- <th>Quản lý</th> -->

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
            <td><?php echo $i ?></td>
            <td><?php echo $row['code_cart'] ?></td>
            <td><?php echo $row['tensanpham'] ?></td>
            <!-- <td><?php echo $row['soluongmua'] ?></td> -->
            <td>
                <input class="doi-so-luong" type="number" name="soluongmua[<?php echo $row['id_cart_details'] ?>]" value="<?php echo $row['soluongmua'] ?>" min="1">
                <button class="nut-doi" type="submit" name="update_quantity">Cập nhật số lượng</button>
            </td>
            <td><?php echo number_format($row['giasp'], 0, ',', '.') . " đ" ?></td>
            <td><?php echo number_format($thanhtien, 0, ',', '.') . " đ" ?></td>
            <td><?php echo $row['cart_payment'] ?></td>


            <!-- <td>
            <a href="?action=quanlydonhang&query=suadonhang&code=<?php echo $row['code_cart']; ?>">Sửa</a> |
          <a href="modules/quanlydonhang/xuly.php?action=delete&code=<?php echo $row['code_cart'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');">Xoá</a>
        </td> -->
        </tr>

    <?php
            }

    ?>
    <tr>
        <td colspan="7">
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