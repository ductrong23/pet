<?php
session_start();
include "admincp/config/config.php";

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
        // header('Location: index.php?quanly=gioithieu');
        header('Location: account.php');
    }
}
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="css/base.css">
<link rel="stylesheet" href="css/grid.css">
<link rel="stylesheet" href="css/account.css">
<title>PetStore - Đăng nhập | Đăng ký</title>




<!-- ĐĂNG NHẬP -->
<?php

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
    } else {
        echo '<h3>Tài khoản hoặc mật khẩu không đúng !! Vui lòng đăng nhập lại !!</h3>';
    }
}



?>
<div class="container" id="container">
    <div class="form-container sign-in">
        <form method="POST" autocomplete="off">
            <h1 class="form-heading">Đăng nhập</h1>
            <p class="form-desc container-p">Cùng nhau mua sắm trực tuyến tại <strong>PETSTORE</strong> ❤️</p>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input name="email" type="email" id="username" placeholder="Ví dụ: abc@gmail.com" class="form-control">
                <span class="form-message"></span>
            </div>
            <div class="form-group">
                <label class="form-label">Mật khẩu</label>
                <input name="password" type="password" id="password" placeholder="Nhập mật khẩu tại đây" class="form-control">
                <i class="fa-solid fa-eye-slash hide-icon"></i>
                <span class="form-message"></span>
            </div>
            <div class="remember-forgot">
                <label for=""><input type="checkbox"> Lưu mật khẩu</label>
                <a href="#" class="">Quên mật khẩu?</a>
            </div>

            <button type="submit" name="dangnhap" class="form-submit">ĐĂNG NHẬP</button>

            <p class="form-desc container-p">Bạn cũng có thể đăng nhập với</p>
            <div class="other-login">
                <div class="other-login-facebook">
                    <i class="fa-brands fa-square-facebook"></i>
                    Facebook
                </div>
                <div class="other-login-google">
                    <i class="fa-brands fa-google"></i>
                    Google
                </div>
            </div>
        </form>
    </div>


    <div class="form-container sign-up">
        <form action="" method="POST" autocomplete="off">
            <h1 class="form-heading">Đăng ký</h1>
            <p class="form-desc container-p">Cùng nhau mua sắm trực tuyến tại <strong>PETSTORE</strong> ❤️</p>
            <div class="form-group-double">
                <div class="grid wide">
                    <div class="row">
                        <div class="col l-6">
                            <div class="form-group">
                                <label class="form-label">Họ và tên</label>
                                <input name="hovaten" type="text" id="fullname" placeholder="Ví dụ: Nguyễn Văn A" class="form-control">
                                <span class="form-message"></span>
                            </div>
                        </div>
                        <div class="col l-6">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input name="email" type="text" id="email" placeholder="Nhập email tại đây" class="form-control">
                                <span class="form-message"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group-double">
                <div class="grid wide">
                    <div class="row">

                        <div class="col l-6">
                            <div class="form-group">
                                <label class="form-label">Số điện thoại</label>
                                <input name="dienthoai" type="text" id="phone-number" placeholder="Nhập số điện thoại tại đây" class="form-control">
                                <span class="form-message"></span>
                            </div>
                        </div>
                        <div class="col l-6">
                            <div class="form-group">
                                <label class="form-label">Địa chỉ</label>
                                <input name="diachi" type="text" id="address" placeholder="Nhập địa chỉ tại đây" class="form-control">
                                <span class="form-message"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group-double">
                <div class="grid wide">
                    <div class="row">
                        <div class="col l-6">
                            <div class="form-group">
                                <label class="form-label">Mật khẩu</label>
                                <input name="matkhau" type="password" id="password" placeholder="Nhập mật khẩu" class="form-control">
                                <i class="fa-solid fa-eye-slash hide-icon"></i>
                                <span class="form-message"></span>
                            </div>
                        </div>
                        <!-- <div class="col l-6">
                            <div class="form-group">
                                <label class="form-label">Nhập lại mật khẩu</label>
                                <input type="password" id="password_confirmation" placeholder="Nhập lại mật khẩu" class="form-control">
                                <i class="fa-solid fa-eye-slash hide-icon confirm"></i>
                                <span class="form-message"></span>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>

            <button type="submit" name="dangky" class="form-submit">ĐĂNG KÝ</button>
        </form>
    </div>
    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-left">
                <h1 class="toggle-container__title">Chào mừng trở lại!</h1>
                <p class="toggle-container__sub-title">Nhập thông tin cá nhân của bạn để sử dụng tất cả các tính năng của trang web</p>
                <button class="toggle-button" id="login">Đăng nhập</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1 class="toggle-container__title">Bạn chưa có tài khoản?</h1>
                <p class="toggle-container__sub-title">Đăng ký với thông tin cá nhân của bạn để sử dụng tất cả các tính năng của trang web</p>
                <button class="toggle-button" id="register">Đăng ký</button>
            </div>
        </div>
    </div>
</div>

<script src="js/account.js"></script>
<script src="js/validator.js"></script>
<script>
    const textareaElement = document.getElementById('note');
    const numberCharacterElement = document.getElementById('number-character');
    textareaElement.addEventListener('input', function() {
        handleChangeTextArea(this);
    });
    const handleChangeTextArea = (textarea) => {
        let characters = textarea.value.length;
        numberCharacterElement.innerHTML = `${characters}/200`
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mong muốn của chúng ta
        Validator({
            form: '#form-1',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#username', '(*) Tên đăng nhập không được để trống'),
                Validator.isRequired('#password', '(*) Mật khẩu không được để trống'),
            ],
            // onSubmit: function(data) {
            //     // Call API
            //     console.log(data);
            // }
        });

        Validator({
            form: '#form-2',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#fullname', '(*) Họ và tên không được để trống'),
                Validator.isRequired('#email', '(*) Email không được để trống'),
                Validator.isEmail('#email', '(*) Email không đúng định dạng'),
                Validator.isRequired("#nationality", "Vui lòng chọn quốc tịch"),
                Validator.isRequired('#phone-number', '(*) Số điện thoại không được để trống'),
                Validator.isPhoneNumber('#phone-number', '(*) Số điện thoại không đúng định dạng'),
                Validator.isRequired('#address', '(*) Địa chỉ không được để trống'),
                Validator.isRequired('input[name="gender"]', '(*) Chọn giới tính'),
                Validator.isRequired('input[name="hobbies[]"]', '(*) Vui lòng chọn sở thích'),
                Validator.isRequired('#password', '(*) Mật khẩu không được để trống'),
                Validator.isPassword('#password'),
                Validator.isRequired('#password_confirmation', '(*) Mật khẩu nhập lại không được trống'),
                Validator.isConfirmed('#password_confirmation', function() {
                    return document.querySelector('#form-2 #password').value;
                }, 'Mật khẩu nhập lại không chính xác'),
                Validator.maxLength('#note', 200),
            ],
            // onSubmit: function(data) {
            //     // Call API
            //     console.log(data);
            // }
        });
    });
</script>

</body>

</html>