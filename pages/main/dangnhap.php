<?php
ob_start();
// session_start();
if (isset($_POST['dangnhap'])) {
    $email = $_POST['email'];
    $matkhau = md5($_POST['password']);
    $sql = "SELECT * FROM tbl_dangky WHERE email='" . $email . "' AND matkhau='" . $matkhau . "' LIMIT 1";
    $row = mysqli_query($mysqli, $sql);
    $count = mysqli_num_rows($row);
    if ($count > 0) {
        $row_data = mysqli_fetch_array($row);
        $_SESSION['dangky'] = $row_data['tenkhachhang'];
        $_SESSION['email'] = $row_data['email'];
        $_SESSION['id_khachhang'] = $row_data['id_dangky'];
        // header('Location: index.php?quanly=giohang');
        header('Location: index.php?quanly=gioithieu');
    }
     else {
        echo '<h3>Tài khoản hoặc mật khẩu không đúng !! Vui lòng đăng nhập lại !!</h3>';
    }
}
ob_end_flush();
?>

<form action="" method="POST" autocomplete="off">
    <table border="1" class="table-login" style="text-align:center; border-collapse:collapse">

        <tr>
            <td colspan="2">
                <h3>ĐĂNG NHẬP</h3>
            </td>
        </tr>

        <tr>
            <td>Email</td>
            <td><input type="email" name="email" placeholder="Email"></td>
        </tr>

        <tr>
            <td>Mật khẩu</td>
            <td><input type="password" name="password" placeholder="Mật khẩu"></td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="submit" name="dangnhap" value="Đăng nhập">
            </td>
        </tr>
    </table>
</form>