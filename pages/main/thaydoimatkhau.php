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
        echo '<script>alert("Tài khoản hoặc mật khẩu cũ không đúng !! Vui lòng nhập lại !!");</script>';
    }
}
?>


<br>
<div class="mat-khau"></div>
<form id="form-change-password" action="" method="POST" autocomplete="off">
    <table class="thay-doi-mat-khau" border="1" class="table-login" style="text-align:center; border-collapse:collapse">

        <tr>
            <td colspan="2">
                <h3>ĐỔI MẬT KHẨU</h3>
            </td>
        </tr>

        <tr>
            <td>Email</td>
            <td><input class="nhap" type="email" name="email" id="email"></td>
        </tr>

        <tr>
            <td>Mật khẩu cũ</td>
            <td><input class="nhap" type="password" name="password_cu" id="password_cu"></td>
        </tr>

        <tr>
            <td>Mật khẩu mới</td>
            <td><input class="nhap" type="password" name="password_moi" id="pasword_moi"></td>
        </tr>

        <tr>
            <td colspan="2">
                <input class="doi-mat-khau" type="submit" name="doimatkhau" id="doi_mat_khau" value="Đổi mật khẩu">
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


<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('form-change-password');

    if (form) {
        form.addEventListener('submit', function(event) {
            const email = document.getElementById('email').value.trim();
            const passwordCu = document.getElementById('password_cu').value.trim();
            const passwordMoi = document.getElementById('pasword_moi').value.trim();
            let isValid = true;
            let errorMessage = '';

            // Kiểm tra email
            if (email === '') {
                errorMessage += 'Email không được để trống.\n';
                isValid = false;
            } else if (!isValidEmail(email)) {
                errorMessage += 'Email không đúng định dạng.\n';
                isValid = false;
            }

            // Kiểm tra mật khẩu cũ
            if (passwordCu === '') {
                errorMessage += 'Mật khẩu cũ không được để trống.\n';
                isValid = false;
            }

            // Kiểm tra mật khẩu mới
            if (passwordMoi === '') {
                errorMessage += 'Mật khẩu mới không được để trống.\n';
                isValid = false;
            } else if (!isValidPassword(passwordMoi)) {
                errorMessage += 'Mật khẩu mới phải có ít nhất 8 ký tự, bao gồm chữ in hoa, ký tự đặc biệt và chữ số.\n';
                isValid = false;
            }

            // Nếu có lỗi, hiển thị thông báo và ngăn chặn form gửi đi
            if (!isValid) {
                event.preventDefault();
                alert(errorMessage);
            }
        });
    }

    function isValidEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    function isValidPassword(password) {
        // Ít nhất 8 ký tự, có chữ số, ký tự đặc biệt, và chữ in hoa
        const re = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})/;
        return re.test(password);
    }
});

</script>