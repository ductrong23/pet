<?php
if (isset($_POST['doimatkhau'])) {
    $taikhoan = $_POST['email'];
    $matkhau_cu = md5($_POST['password_cu']);
    $matkhau_moi = md5($_POST['password_moi']);
    $sql = "SELECT * FROM tbl_dangky 
    WHERE email='" . $taikhoan . "' 
    AND matkhau='" . $matkhau_cu . "' LIMIT 1";
    $row = mysqli_query($mysqli, $sql);
    $count = mysqli_num_rows($row);
    if ($count > 0) {
        $sql_update = mysqli_query($mysqli, "UPDATE tbl_dangky 
        SET matkhau='" . $matkhau_moi . "' 
        WHERE email='".$taikhoan."'");
        echo '<script>alert("Mật khẩu đã được thay đổi !!!");</script>';
    } else {
        echo '<script>alert("Tài khoản hoặc mật khẩu cũ không đúng !! Vui lòng đăng nhập lại !!");</script>';
    }
}
?>

<div class="mat-khau"></div>
<form action="" method="POST" autocomplete="off">
    <table class="thay-doi-mat-khau" border="1" class="table-login" style="text-align:center; border-collapse:collapse">

        <tr>
            <td colspan="2">
                <h3>ĐỔI MẬT KHẨU</h3>
            </td>
        </tr>

        <tr>
            <td>Email</td>
            <td><input class="nhap" type="email" name="email"></td>
        </tr>

        <tr>
            <td>Mật khẩu cũ</td>
            <td><input class="nhap" type="password" name="password_cu"></td>
        </tr>

        <tr>
            <td>Mật khẩu mới</td>
            <td><input class="nhap" type="password" name="password_moi"></td>
        </tr>

        <tr>
            <td colspan="2">
                <input class="doi-mat-khau" type="submit" name="doimatkhau" value="Đổi mật khẩu">
            </td>
        </tr>
    </table>
</form>
</div>

<br>
<br>
<br>
<div class="cua-hang">
    <a class="quay-lai" href="index.php">
        <i class="fa fa-hand-o-left" aria-hidden="true"></i>
        <span>
            <h4>TIẾP TỤC MUA HÀNG</h4>
        </span>
    </a>
</div>
