<h1>ĐĂNG KÝ TÀI KHOẢN NGƯỜI DÙNG</h1>
<?php
if (isset($_POST['dangky'])) {
    $tenkhachhang = $_POST['hovaten'];
    $email = $_POST['email'];
    $dienthoai = $_POST['dienthoai'];
    $matkhau = md5($_POST['matkhau']);
    $diachi = $_POST['diachi'];
    $sql_dangky = mysqli_query($mysqli, "INSERT INTO tbl_dangky(tenkhachhang, email, diachi, matkhau, dienthoai) VALUE('" . $tenkhachhang . "','" . $email . "','" . $diachi . "','" . $matkhau . "','" . $dienthoai . "')");
    if ($sql_dangky) {
        echo '<p style="color: green">Đăng ký thành công<p>';
        $_SESSION['dangky'] = $tenkhachhang;
        $_SESSION['email'] = $email;
        $_SESSION['id_khachhang'] = mysqli_insert_id($mysqli);
        header('Location: index.php?quanly=giohang');
    }
}
?>

<style>
    table.table-register {
        width: 100%;
        margin: 0 auto;
    }

    .table-register tr td {
        padding: 3px;
    }
</style>


<form action="" method="POST" autocomplete="off">
    <table class="table-register" border="1" style="border-collapse:collapse; width:50%">
        <tr>
            <td class="table-title">Họ và tên</td>
            <td><input type="text" name="hovaten" size="65px"></td>
        </tr>
        <tr>
            <td class="table-title">Email</td>
            <td><input type="text" name="email" size="65px"></td>
        </tr>
        <tr>
            <td class="table-title">Điện thoại</td>
            <td><input type="text" name="dienthoai" size="65px"></td>
        </tr>
        <tr>
            <td class="table-title">Địa chỉ</td>
            <td><input type="text" name="diachi" size="65px"></td>
        </tr>
        <tr>
            <td class="table-title">Mật khẩu</td>
            <td><input type="text" name="matkhau" size="65px"></td>
        </tr>

        <tr>
            <td><input type="submit" name="dangky" value="Đăng ký"></td>
            <td><a href="index.php?quanly=dangnhap">Đăng nhập</a></td>
        </tr>

    </table>
</form>