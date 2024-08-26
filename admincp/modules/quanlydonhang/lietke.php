<?php
// $sql_lietke_dh = "SELECT * FROM tbl_cart, tbl_dangky,
// WHERE tbl_cart.id_khachhang=tbl_dangky.id_dangky 
// ORDER BY tbl_cart.id_cart DESC";

$sql_lietke_dh = "SELECT tbl_cart.*, tbl_dangky.tenkhachhang, tbl_dangky.email, 
                 tbl_dangky.dienthoai, tbl_shipping.address AS diachi_nhanhang
                 FROM tbl_cart 
                 INNER JOIN tbl_dangky ON tbl_cart.id_khachhang = tbl_dangky.id_dangky 
                 INNER JOIN tbl_shipping ON tbl_cart.cart_shipping = tbl_shipping.id_shipping
                 ORDER BY tbl_cart.id_cart DESC";

$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
?>
<h1 class="title-liet-ke">LIỆT KÊ ĐƠN HÀNG ĐĂNG NHẬP</h1>
<table class="bang-liet-ke" style="width:100%" border="1" style="border-collapse:collapse">
    <tr>
        <th>ID</th>
        <th>Mã đơn hàng</th>
        <th>Tên khách hàng</th>
        <th>Tên người nhận</th>
        <th>Email</th>
        <th>Địa chỉ nhận hàng</th>
        <th>Số điện thoại</th>
        <th>Ngày đặt hàng</th>
        <th>Tình trạng</th>
        <th>Quản lý</th>
    </tr>
    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query_lietke_dh)) {
        $i++;
        $cart_status = isset($row['cart_status']) ? $row['cart_status'] : 0; // Đặt mặc định là 0 nếu không có giá trị

    ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row['code_cart'] ?></td>
            <td><?php echo $row['tenkhachhang'] ?></td>
            <td><?php echo $row['namedathang'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <!-- <td><?php echo $row['diachi'] ?></td> -->
            <td><?php echo $row['shipping_address'] ?></td>
            <td><?php echo $row['dienthoai'] ?></td>
            <td><?php echo $row['cart_date'] ?></td>
            <td>
                <form action="modules/quanlydonhang/xuly.php" method="GET">
                    <input type="hidden" name="code" value="<?php echo $row['code_cart']; ?>">
                    <select class="chon-status" name="cart_status">
                        <option value="0" <?php echo ($cart_status == 0) ? 'selected' : ''; ?>>Đơn hàng mới</option>
                        <option value="1" <?php echo ($cart_status == 1) ? 'selected' : ''; ?>>Đã xác nhận</option>
                        <option value="2" <?php echo ($cart_status == 2) ? 'selected' : ''; ?>>Đang vận chuyển</option>
                        <option value="3" <?php echo ($cart_status == 3) ? 'selected' : ''; ?>>Đang giao hàng</option>
                        <option value="4" <?php echo ($cart_status == 4) ? 'selected' : ''; ?>>Đã giao hàng</option>
                        <option value="5" <?php echo ($cart_status == 5) ? 'selected' : ''; ?>>Đã thanh toán</option>
                    </select>
                    <button type="submit" class="btn-xac-nhan">Xác nhận</button>
                </form>
            </td>
            <td>
                <a href="index.php?action=donhang&query=xemdonhang&code=<?php echo $row['code_cart'] ?>"><i class="fa fa-eye" aria-hidden="true"></i></a> |
                <a href="modules/quanlydonhang/indonhang.php?code=<?php echo $row['code_cart'] ?>"><i class="fa fa-print" aria-hidden="true"></i></a> |
                <!-- <a href="index.php?action=donhang&query=suadonhang&code=<?php echo $row['code_cart'] ?>">Sửa</a> | -->
                <!-- <a href="modules/quanlydonhang/xuly.php?action=delete&code=<?php echo $row['code_cart'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a> -->
                <a href="#"
                    data-url="modules/quanlydonhang/xuly.php?action=delete&code=<?php echo $row['code_cart'] ?>"
                    onclick="handleDelete(event, this);">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                </a>
            </td>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
<br>

<br>
<br>

<style>
    input[type="number"] {
        text-align: center;
        width: 50px;
        margin-bottom: 5px;
    }

    select.chon-status {
        padding: 7px;
        border-radius: 10px;
        cursor: pointer;
    }


    button.btn-xac-nhan {
        padding: 7px;
        border-radius: 10px;
        cursor: pointer;
        height: calc(6 - 2px);
        transition: 0.5s;
        position: relative;
    }

    button.btn-xac-nhan:hover {
        scale: 1.06;
        background-color: #123f39;
        color: white
    }
</style>

<!-- Modal HTML -->
<div id="popupModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="popupMessage"></p>
        <button id="confirmButton" class="confirm-btn">Xác nhận</button>
        <button id="cancelButton" class="cancel-btn">Hủy</button>
    </div>
</div>

<!-- Include JavaScript for popup -->
<script src="js/xemdonhang.js"></script>