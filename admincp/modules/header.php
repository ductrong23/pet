<header class="admin-header">
    <div class="header-content">
        <div class="header-left">
            <div class="logo-admin">
                <a href="index.php" class="logo">
                    <img src="../images/logo1.png" alt="" style="width:150px;">
                    <span class="title">Admin Dashboard</span>
                </a>
            </div>
            <!--  -->
            <style>
                span.title {
                    position: absolute;
                    top: 50px;
                }
            </style>

        </div>
        <div class="header-right">
            <div class="user-info">
                <span class="username">Xin chào, ADMIN <?php if (isset($_SESSION['dangnhap'])) {
                                                            echo "[" . $_SESSION['dangnhap'] . "]";
                                                        } ?></span>
                <i class="fa fa-user" aria-hidden="true" style="color: green"></i>
                <div class="dropdown">
                    <button class="dropbtn">▼</button>
                    <div class="dropdown-content">
                        <a href="profile.php">Hồ sơ cá nhân</a>
                        <a href="settings.php">Cài đặt</a>
                        <a href="index.php?dangxuat=1">ĐĂNG XUẤT <?php if (isset($_SESSION['dangnhap'])) {
                                                                        echo "[" . $_SESSION['dangnhap'] . "]";
                                                                    } ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<?php
if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
    unset($_SESSION['dangnhap']);
    header('Location:login.php');
}
?>

<!-- <p><a href="index.php?dangxuat=1">ĐĂNG XUẤT <?php if (isset($_SESSION['dangnhap'])) {
                                                        echo "[" . $_SESSION['dangnhap'] . "]";
                                                    } ?></a></p> -->