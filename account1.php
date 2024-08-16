<?php
session_start();
include "admincp/config/config.php";

if (isset($_POST['dangky'])) {
    $tenkhachhang = $_POST['hovaten'];
    $email = $_POST['email'];
    $dienthoai = $_POST['dienthoai'];
    $matkhau = md5($_POST['matkhau']);

    $diachi = $_POST['diachi'];
    // $redirect = isset($_POST['redirect']) ? $_POST['redirect'] : 'index';
    $sql_dangky = mysqli_query($mysqli, "INSERT INTO tbl_dangky(tenkhachhang, email, diachi, matkhau, dienthoai) VALUE('" . $tenkhachhang . "','" . $email . "','" . $diachi . "','" . $matkhau . "','" . $dienthoai . "')");
    if ($sql_dangky) {
        echo '<p style="color: green">Đăng ký thành công<p>';
        $_SESSION['dangky'] = $tenkhachhang;
        $_SESSION['email'] = $email;
        $_SESSION['id_khachhang'] = mysqli_insert_id($mysqli);

        // 
      
        // if ($redirect === 'giohang') {
        //     header('Location: index.php?quanly=giohang');
        // } else {
        //     header('Location: index.php');
        // }
        header('Location: index.php?quanly=gioithieu');
        // header('Location: account.php');
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

    // $redirect = isset($_POST['redirect']) ? $_POST['redirect'] : 'index';

    $sql = "SELECT * FROM tbl_dangky WHERE email='" . $email . "' AND matkhau='" . $matkhau . "' LIMIT 1";
    $row = mysqli_query($mysqli, $sql);
    $count = mysqli_num_rows($row);
    if ($count > 0) {
        $row_data = mysqli_fetch_array($row);
        $_SESSION['dangky'] = $row_data['tenkhachhang'];
        $_SESSION['email'] = $row_data['email'];
        $_SESSION['id_khachhang'] = $row_data['id_dangky'];

        // 
        // if ($redirect === 'giohang') {
        //     header('Location: index.php?quanly=giohang');
        // } else {
        //     header('Location: index.php');
        // }

        header('Location: index.php?quanly=giohang');
        // header('Location: index.php?quanly=gioithieu');
    } else {
        echo '<h3>Tài khoản hoặc mật khẩu không đúng !! Vui lòng đăng nhập lại !!</h3>';
    }
}



?>
<div class="container" id="container">
    <div class="form-container sign-in">
        <form method="POST" autocomplete="off" id="form-login">
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
        <form action="" method="POST" autocomplete="off" id="form-register">
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
                        <div class="col l-6">
                            <div class="form-group">
                                <label class="form-label">Nhập lại mật khẩu</label>
                                <input type="password" id="password_confirmation" placeholder="Nhập lại mật khẩu" class="form-control">
                                <i class="fa-solid fa-eye-slash hide-icon confirm"></i>
                                <span class="form-message"></span>
                            </div>
                        </div>
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
<!-- <script src="js/validator.js"></script> -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Validator cho Đăng Ký
    Validator({
        form: '#form-register',
        formGroupSelector: '.form-group',
        errorSelector: '.form-message',
        rules: [
            Validator.isRequired('#fullname', 'Họ và tên không được để trống'),
            Validator.isEmail('#email', 'Email không hợp lệ'),
            Validator.isPhoneNumber('#phone-number', 'Số điện thoại không hợp lệ'),
            Validator.isRequired('#address', 'Địa chỉ không được để trống'),
            Validator.isPassword('#password', 'Mật khẩu phải tối thiểu 8 ký tự và có ít nhất một chữ hoa, một chữ thường và một ký tự đặc biệt'),
            Validator.isConfirmed('#password_confirmation', function () {
                return document.querySelector('#form-register #password').value;
            }, 'Mật khẩu nhập lại không khớp'),
        ],
        onSubmit: function (data) {
            // Gửi dữ liệu đăng ký lên server
            fetch('register.php', {
                method: 'POST',
                body: new URLSearchParams(data),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
            }).then(response => response.text())
              .then(result => {
                // Xử lý kết quả từ server
                if (result.includes('Đăng ký thành công')) {
                    window.location.href = 'index.php?quanly=gioithieu';
                } else {
                    alert(result);
                }
            });
        }
    });
});

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Validator cho Đăng Nhập
    Validator({
        form: '#form-login',
        formGroupSelector: '.form-group',
        errorSelector: '.form-message',
        rules: [
            Validator.isRequired('#username', 'Email không được để trống'),
            Validator.isEmail('#username', 'Email không hợp lệ'),
            Validator.isRequired('#password', 'Mật khẩu không được để trống'),
        ],
        onSubmit: function (data) {
            // Gửi dữ liệu đăng nhập lên server
            fetch('login.php', {
                method: 'POST',
                body: new URLSearchParams(data),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
            }).then(response => response.text())
              .then(result => {
                // Xử lý kết quả từ server
                if (result.includes('Đăng nhập thành công')) {
                    window.location.href = 'index.php?quanly=giohang';
                } else {
                    alert(result);
                }
            });
        }
    });
});

</script>


<script>
    function Validator(options) {
    var selectorRules = {};

    function validate(inputElement, rule) {
        var errorElement = inputElement.closest(options.formGroupSelector).querySelector(options.errorSelector);
        var errorMessage;

        var rules = selectorRules[rule.selector];
        for (var i = 0; i < rules.length; i++) {
            switch (inputElement.type) {
                case 'checkbox':
                case 'radio':
                    errorMessage = rules[i](document.querySelector(rule.selector + ':checked'));
                    break;
                default:
                    errorMessage = rules[i](inputElement.value);
            }
            if (errorMessage) break;
        }

        if (errorMessage) {
            errorElement.textContent = errorMessage;
            inputElement.classList.add('invalid');
        } else {
            errorElement.textContent = '';
            inputElement.classList.remove('invalid');
        }
        return !errorMessage;
    }

    var formElement = document.querySelector(options.form);
    if (formElement) {
        formElement.addEventListener('submit', function (e) {
            e.preventDefault();
            var isFormValid = true;
            options.rules.forEach(function (rule) {
                var inputElement = document.querySelector(rule.selector);
                var isValid = validate(inputElement, rule);
                if (!isValid) {
                    isFormValid = false;
                }
            });
            if (isFormValid) {
                var formData = new FormData(formElement);
                var data = {};
                formData.forEach((value, key) => {
                    data[key] = value;
                });
                options.onSubmit(data);
            }
        });

        options.rules.forEach(function (rule) {
            if (Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.test);
            } else {
                selectorRules[rule.selector] = [rule.test];
            }
            var inputElement = document.querySelector(rule.selector);
            if (inputElement) {
                inputElement.addEventListener('blur', function () {
                    validate(inputElement, rule);
                });
                inputElement.addEventListener('input', function () {
                    var errorElement = inputElement.closest(options.formGroupSelector).querySelector(options.errorSelector);
                    errorElement.textContent = '';
                    inputElement.classList.remove('invalid');
                });
            }
        });
    }
}

Validator.isRequired = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            return value ? undefined : message;
        }
    };
};

Validator.isEmail = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(value) ? undefined : message;
        }
    };
};

Validator.isPhoneNumber = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            var regex = /^(0[1-9]|84[1-9])[0-9]{8}$/;
            return regex.test(value) ? undefined : message;
        }
    };
};

Validator.isPassword = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            return regex.test(value) ? undefined : message;
        }
    };
};

Validator.isConfirmed = function (selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function (value) {
            return value === getConfirmValue() ? undefined : message;
        }
    };
};

</script>
</body>

</html>


<!-- <script>
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
            form: '#form-login',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#username', '(*) Tên đăng nhập không được để trống'),
                Validator.isRequired('#password', '(*) Mật khẩu không được để trống'),
            ],
            onSubmit: function(data) {
                // Call API
                console.log(data);
            }
        });

        Validator({
            form: '#form-register',
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
                    return document.querySelector('#form-register #password').value;
                }, 'Mật khẩu nhập lại không chính xác'),
                Validator.maxLength('#note', 200),
            ],
            onSubmit: function(data) {
                // Call API
                console.log(data);
            }
        });
    });
</script> -->