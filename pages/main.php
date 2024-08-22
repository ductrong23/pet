<!-- MAIN -->
<div id="main">
    <?php
    // include "sidebar/sidebar.php";
    ?>


    <div class="maincontent">


        <?php
        if (isset($_GET['quanly'])) {
            $tam = $_GET['quanly'];
        } else {
            $tam = '';
        }
        if ($tam == 'danhmucsanpham') {
            include("main/danhmuc.php");
        } elseif ($tam == 'giohang') {
            include("main/giohang.php");
        } elseif ($tam == 'gioithieu') {
            include("main/gioithieu.php");
        } elseif ($tam == 'lienhe') {
            include("main/lienhe.php");
        } elseif ($tam == 'danhmuc_sanpham') {
            include("main/danhmuc_sanpham.php");
        } elseif ($tam == 'tintuc_menu') {
            include("main/tintuc_menu.php");
        } elseif ($tam == 'sanpham') {
            include("main/sanpham.php");
        } elseif ($tam == 'dangky') {
            // include("main/dangky.php");
            include("account.php");
        } elseif ($tam == 'thanhtoan') {
            include("main/thanhtoan.php");
        } elseif ($tam == 'dangnhap') {
            // include("main/dangnhap.php");
            include("account.php");
        } elseif ($tam == 'timkiem') {
            include("main/timkiem.php");
        } elseif ($tam == 'camon') {
            include("main/camon.php");
        } elseif ($tam == 'thaydoimatkhau') {
            include("main/thaydoimatkhau.php");
        } elseif ($tam == 'danhmuctintuc') {
            include("main/danhmuctintuc.php");
        } elseif ($tam == 'tintuc') {
            include("main/tintuc.php");
        } elseif ($tam == 'vanchuyen') {
            include("main/vanchuyen.php");
        } elseif ($tam == 'thongtinthanhtoan') {
            include("main/thongtinthanhtoan.php");
        } elseif ($tam == 'donhangdadat') {
            include("main/xemdonhang.php");
        } elseif ($tam == 'lichsudonhang') {
            include("main/lichsudonhang.php");
        } elseif ($tam == 'xemdonhang') {
            include("main/xemdonhang.php");
        }
        // MUA OFF
        elseif ($tam == 'vanchuyenoff') {
            include("main/vanchuyenoff.php");
        } elseif ($tam == 'thongtinthanhtoanoff') {
            include("main/thongtinthanhtoanoff.php");
        } elseif ($tam == 'lichsudonhangoff') {
            include("main/lichsudonhangoff.php");
        } elseif ($tam == 'xemdonhangoff') {
            include("main/xemdonhangoff.php");
        }elseif ($tam == 'camonoff') {
            include("main/camonoff.php");
        }
      
        else {
            include("main/index.php");
        }
        ?>
    </div>
</div>