<link rel="stylesheet" href="css/account.css">
<!-- Modal -->
<div id="popupModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="popupMessage"></p>
    </div>
</div>
<script src="js/checkaccount.js"></script>
<!-- ĐĂNG KÝ -->
<?php
session_start();
include "admincp/config/config.php";
include_once "cart_functions.php";


if (isset($_POST['dangky'])) {
    $tenkhachhang = $_POST['hovaten'];
    $email = $_POST['email'];
    $dienthoai = $_POST['dienthoai'];
    $matkhau = md5($_POST['matkhau']);
    $diachi = $_POST['diachi'];

    // Kiểm tra xem email đã tồn tại chưa
    $sql_check_email = "SELECT * FROM tbl_dangky WHERE email = ?";
    $stmt_check = $mysqli->prepare($sql_check_email);
    $stmt_check->bind_param('s', $email);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        // Nếu email đã tồn tại
        // echo '<script>alert("Email đã được sử dụng. Vui lòng chọn email khác.");</script>';
        $popupMessage = 'Email đã được sử dụng. Vui lòng chọn email khác.';
        echo '<script>showPopup("' . $popupMessage . '");</script>';
    } else {
        // Nếu email chưa tồn tại, thực hiện đăng ký
        $sql_dangky = "INSERT INTO tbl_dangky (tenkhachhang, email, diachi, matkhau, dienthoai) 
                       VALUES (?, ?, ?, ?, ?)";
        $stmt_dangky = $mysqli->prepare($sql_dangky);
        $stmt_dangky->bind_param('sssss', $tenkhachhang, $email, $diachi, $matkhau, $dienthoai);

        if ($stmt_dangky->execute()) {

            $_SESSION['dangky'] = $tenkhachhang;
            $_SESSION['email'] = $email;
            $_SESSION['id_khachhang'] = $mysqli->insert_id;

            // echo '<script>alert("Đăng ký tài khoản thành công. Vui lòng đăng nhập");</script>';

            // Khởi tạo giỏ hàng trống cho người dùng mới
            $_SESSION['cart'] = array();
            saveUserCart($_SESSION['id_khachhang'], $_SESSION['cart']);

            // Lấy giá trị của redirect_url từ GET (nếu có)
            $redirect_url = isset($_GET['redirect_url']) ? $_GET['redirect_url'] : 'index.php?quanly=dangnhap';

            // Chuyển hướng đến trang đăng nhập với redirect_url
            // header('Location: account.php?redirect_url=' . urlencode($redirect_url));
            $popupMessage = 'Đăng ký tài khoản thành công. Vui lòng đăng nhập';
            echo '<script>
                showPopup("' . $popupMessage . '");
                setTimeout(function() { 
                    window.location.href = "account.php?redirect_url=' . urlencode($redirect_url) . '"; 
                }, 3000);
            </script>';
            exit();
        }
    }
}
?>

<!-- ĐĂNG NHẬP -->
<?php
if (isset($_POST['dangnhap'])) {
    $email = $_POST['email'];
    $matkhau = md5($_POST['password']);
    $sql = "SELECT * FROM tbl_dangky 
    WHERE email='" . $email . "' 
    AND matkhau='" . $matkhau . "' LIMIT 1";
    $row = mysqli_query($mysqli, $sql);
    $count = mysqli_num_rows($row);
    if ($count > 0) {
        $row_data = mysqli_fetch_array($row);
        $_SESSION['dangky'] = $row_data['tenkhachhang'];
        $_SESSION['email'] = $row_data['email'];
        $_SESSION['id_khachhang'] = $row_data['id_dangky'];

        // Gọi hàm loadUserCart khi người dùng đăng nhập
        if (isset($_SESSION['id_khachhang'])) {
            $userId = $_SESSION['id_khachhang'];
            $savedCart = loadUserCart($userId);
            if (!empty($savedCart)) {
                $_SESSION['cart'] = $savedCart;
            } else {
                $_SESSION['cart'] = array(); // Khởi tạo giỏ hàng nếu không có dữ liệu
            }
        }

        // Kiểm tra và sử dụng URL redirect
        if (!empty($_POST['redirect_url'])) {
            // Lấy giá trị của redirect_url từ POST
            $redirect_url = $_POST['redirect_url'];
            // Tách đường dẫn và query string từ URL
            $parsed_url = parse_url($redirect_url);
            // Loại bỏ phần tiền tố "/project/" nếu có
            $path = $parsed_url['path'];
            if (strpos($path, '/project/') === 0) {
                $path = substr($path, strlen('/project/'));
            }
            // Ghép lại đường dẫn và query string
            $path_and_query = $path . (isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '');
            // Điều hướng đến đường dẫn mới
            // header("Location: " . $path_and_query);
            echo '<script>showPopup("Đăng nhập thành công"); setTimeout(function() { window.location.href = "' . $path_and_query . '"; }, 1000);</script>';
            exit();
        }

        // Mặc định điều hướng đến trang giới thiệu
        // echo '<script>alert("Đăng nhập thành công");</script>';
        // header('Location: index.php?quanly=gioithieu');
        echo '<script>showPopup("Đăng nhập thành công"); setTimeout(function() { window.location.href = "index.php?quanly=gioithieu"; }, 1000);</script>';
        exit();
    } else {
        // echo '<script>alert("Tài khoản hoặc mật khẩu không đúng !! Vui lòng đăng nhập lại !!");</script>';
        echo '<script>showPopup("Tài khoản hoặc mật khẩu không đúng. Vui lòng đăng nhập lại");</script>';
    }
}

?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="css/base.css">
<link rel="stylesheet" href="css/grid.css">

<title>PetStore - Đăng nhập | Đăng ký</title>


<div class="container" id="container">
    <div class="form-container sign-in">
        <form method="POST" autocomplete="off" id="form-login">
            <!-- <input type="hidden" name="redirect_url" value="<?php echo isset($_GET['redirect_url']) ? htmlspecialchars($_GET['redirect_url']) : ''; ?>"> -->

            <h1 class="form-heading">Đăng nhập</h1>

            <p class="form-desc container-p">Cùng nhau mua sắm trực tuyến tại <strong>PETSTORE</strong> ❤️</p>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input name="email" type="email" id="email-login" placeholder="Ví dụ: abc@gmail.com" class="form-control">
                <span class="form-message"></span>
            </div>
            <div class="form-group">
                <label class="form-label">Mật khẩu</label>
                <input name="password" type="password" id="password-login" placeholder="Nhập mật khẩu tại đây" class="form-control">
                <span class="form-message"></span>
                <i class="fa-solid fa-eye-slash hide-icon"></i>
            </div>
            <div class="remember-forgot">
                <label for=""><input type="checkbox"> Lưu mật khẩu</label>
                <a href="#" class="">Quên mật khẩu?</a>
            </div>

            <input type="hidden" name="redirect_url" value="<?php echo isset($_POST['redirect_url']) ? htmlspecialchars($_POST['redirect_url']) : (isset($_GET['redirect_url']) ? htmlspecialchars($_GET['redirect_url']) : ''); ?>">

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
        <form action="" method="POST" autocomplete="" id="form-register">
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
                                <input name="email" type="text" id="email-register" placeholder="Nhập email tại đây" class="form-control">
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
                                <input name="matkhau" type="password" id="password-register" placeholder="Nhập mật khẩu" class="form-control">
                                <span class="form-message"></span>
                                <i class="fa-solid fa-eye-slash hide-icon"></i>
                            </div>
                        </div>
                        <div class="col l-6">
                            <div class="form-group">
                                <label class="form-label">Nhập lại mật khẩu</label>
                                <input type="password" id="password_confirmation" placeholder="Nhập lại mật khẩu" class="form-control">
                                <span class="form-message"></span>
                                <i class="fa-solid fa-eye-slash hide-icon confirm"></i>
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

<!-- Chuyển động giữa register và login -->
<!-- Ẩn Hiện eye -->
<script src="js/kiemtraaccount.js"></script>



<?php
// =============KIỂM TRA EMAIL TỒN TẠI================
// if (isset($_POST['dangky'])) {
//     $tenkhachhang = $_POST['hovaten'];
//     $email = $_POST['email'];
//     $dienthoai = $_POST['dienthoai'];
//     $matkhau = md5($_POST['matkhau']);
//     $diachi = $_POST['diachi'];

//     // Xóa ký tự đặc biệt để tránh SQL Injection
//     $tenkhachhang = mysqli_real_escape_string($mysqli, $tenkhachhang);
//     $email = mysqli_real_escape_string($mysqli, $email);
//     $dienthoai = mysqli_real_escape_string($mysqli, $dienthoai);
//     $matkhau = mysqli_real_escape_string($mysqli, $matkhau);
//     $diachi = mysqli_real_escape_string($mysqli, $diachi);

//     // Kiểm tra xem email đã tồn tại chưa
//     $sql_check_email = "SELECT * FROM tbl_dangky WHERE email = '$email'";
//     $result_check = mysqli_query($mysqli, $sql_check_email);

//     if (mysqli_num_rows($result_check) > 0) {
//         // Nếu email đã tồn tại
//         echo '<script>alert("Email đã được sử dụng. Vui lòng chọn email khác.");</script>';
//     } else {
//         // Nếu email chưa tồn tại, thực hiện đăng ký
//         $sql_dangky = "INSERT INTO tbl_dangky (tenkhachhang, email, diachi, matkhau, dienthoai) 
//                        VALUES ('$tenkhachhang', '$email', '$diachi', '$matkhau', '$dienthoai')";
//         $result_dangky = mysqli_query($mysqli, $sql_dangky);

//         if ($result_dangky) {
//             echo '<script>alert("Đăng ký tài khoản thành công");</script>';

//             $_SESSION['dangky'] = $tenkhachhang;
//             $_SESSION['email'] = $email;
//             $_SESSION['id_khachhang'] = mysqli_insert_id($mysqli);

//             // Khởi tạo giỏ hàng trống cho người dùng mới
//             $_SESSION['cart'] = array();
//             saveUserCart($_SESSION['id_khachhang'], $_SESSION['cart']);

//             // Lấy giá trị của redirect_url từ GET (nếu có)
//             $redirect_url = isset($_GET['redirect_url']) ? $_GET['redirect_url'] : 'index.php?quanly=dangnhap';

//             // Chuyển hướng đến trang đăng nhập với redirect_url
//             header('Location: account.php?redirect_url=' . urlencode($redirect_url));
//             exit();
//         } else {
//             echo '<script>alert("Đăng ký tài khoản không thành công. Vui lòng thử lại.");</script>';
//         }
//     }

//     // Đóng kết nối
//     mysqli_free_result($result_check);
// }
//   ====================================== 
?>