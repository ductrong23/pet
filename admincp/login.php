<?php
session_start();
include "config/config.php";
if (isset($_POST['dangnhap'])) {
  $taikhoan = $_POST['username'];
  $matkhau = md5($_POST['password']);
  $sql = "SELECT * FROM tbl_admin WHERE username='" . $taikhoan . "' AND password='" . $matkhau . "' LIMIT 1";
  $row = mysqli_query($mysqli, $sql);
  $count = mysqli_num_rows($row);

  if ($count > 0) {
    $_SESSION['dangnhap'] = $taikhoan;
    header("Location: index.php?action=quanlydonhang&query=lietke");
  } else {
    $_SESSION['login_error'] = "Tài khoản hoặc mật khẩu không đúng !! Vui lòng đăng nhập lại !!";
    header('Location: login.php');
    exit();
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PetStore | Đăng nhập Admin</title>
</head>

<body>

  <div class="wrapper-login">
    <form id="login-form" action="" method="POST" autocomplete="off">
      <table border="1" class="table-login" style="text-align:center; border-collapse:collapse">

        <tr>
          <td colspan="2">
            <h3>ĐĂNG NHẬP ADMIN</h3>
          </td>
        </tr>

        <tr>
          <td>Tài khoản</td>
          <td><input type="text" name="username" id="username"></td>
          <span class="form-message" id="username-error"></span>
        </tr>

        <tr>
          <td>Mật khẩu</td>
          <td><input type="password" name="password" id="password"></td>
          <span class="form-message" id="password-error"></span>
        </tr>

        <tr>
          <td colspan="2">
            <input type="submit" name="dangnhap" value="Đăng nhập">
          </td>
        </tr>
      </table>
    </form>
  </div>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>

<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  /* Đặt style cho wrapper-login */
  .wrapper-login {
    width: 400px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    border-radius: 8px;
  }

  /* Đặt style cho tiêu đề đăng nhập */
  .wrapper-login h3 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
    text-align: center;
  }

  /* Đặt style cho bảng đăng nhập */
  .table-login {
    width: 100%;
    border-collapse: collapse;
  }

  /* Đặt style cho các ô trong bảng */
  .table-login tr td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
  }

  /* Đặt style cho các ô cuối cùng trong bảng */
  .table-login tr:last-child td {
    border-bottom: none;
  }

  /* Đặt style cho các ô input */
  .table-login input[type="text"],
  .table-login input[type="password"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
  }

  /* Đặt style cho nút đăng nhập */
  .table-login input[type="submit"] {
    background-color: #4caf50;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
  }

  /* Đặt style cho nút đăng nhập khi hover */
  .table-login input[type="submit"]:hover {
    background-color: #45a049;
  }

  /* Đặt style cho tiêu đề của các ô trong bảng */
  .table-login td:first-child {
    text-align: right;
    font-weight: bold;
    color: #333;
  }


  .form-message {
    color: red;
    font-size: 0.875em;
    margin-top: 5px;
    display: none;
  }
</style>

<script src="js/login.js">
     // Kiểm tra xem có thông báo lỗi từ PHP không
     <?php if (isset($_SESSION['login_error'])): ?>
      alert("<?php echo $_SESSION['login_error']; ?>");
      <?php unset($_SESSION['login_error']); // Xóa thông báo lỗi sau khi hiển thị 
      ?>
    <?php endif; ?>

</script>