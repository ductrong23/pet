<?php
$id_khachhang = $_SESSION['id_khachhang'];
$sql_lietke_dh = "SELECT * FROM tbl_cart, tbl_dangky 
WHERE tbl_cart.id_khachhang=tbl_dangky.id_dangky
AND tbl_cart.id_khachhang='$id_khachhang' 
ORDER BY tbl_cart.id_cart DESC";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
?>


<h1 class="title-liet-ke" style="text-align:center; font-size: 32px; color: #123f39; font-family: Montserrat, sans-serif;">ĐƠN HÀNG ĐÃ MUA</h1>
<div class="bang-lich-su-don-hang">
    <table class="bang-gio-hang" style="width:80%; margin:0 auto;" border="1" style="border-collapse:collapse">
        <tr>
            <!-- <th>ID</th> -->
            <th>Mã đơn hàng</th>
            <th>Tên khách hàng</th>
            <th>Email</th>
            <th>Địa chỉ nhận hàng</th>
            <th>Số điện thoại</th>
            <th>Ngày đặt hàng</th>
            <!-- <th>Tình trạng</th> -->
            <th>Quản lý</th>
        </tr>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_dh)) {
            $i++;
        ?>
            <tr>
                <!-- <td><?php echo $i ?></td> -->
                <td><?php echo $row['code_cart'] ?></td>
                <td><?php echo $row['tenkhachhang'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['shipping_address'] ?></td>
                <td><?php echo $row['dienthoai'] ?></td>
                <td><?php echo $row['cart_date'] ?></td>
                <!-- <td>
                <?php
                if ($row['cart_status'] == 1) {
                    echo '<a href="modules/quanlydonhang/xuly.php?code=' . $row['code_cart'] . '">Đơn hàng mới</a>'; //    Đơn hàng mới có giá trị là 1 => Khi click vào sẽ gửi giá trị là 0 => Đã xem
                } else {
                    echo 'Đã xem';
                }
                ?>
            </td> -->
                <td>
                    <a href="index.php?quanly=xemdonhang&code=<?php echo $row['code_cart'] ?>">Xem đơn hàng</a> 
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