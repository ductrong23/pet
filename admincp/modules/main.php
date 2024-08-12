<div class="clear"></div>
<div class="main">
    <?php
    if (isset($_GET['action']) && $_GET['query']) {
        $tam = $_GET['action'];
        $query = $_GET['query'];
    } else {
        $tam = '';
        $query = '';
    }
    if ($tam == 'quanlydanhmucsanpham' && $query == 'them') {
        include("modules/quanlydanhmucsanpham/them.php");
        include("modules/quanlydanhmucsanpham/lietke.php");
    } elseif ($tam == 'quanlydanhmucsanpham' && $query == 'sua') {
        include("modules/quanlydanhmucsanpham/sua.php");
    } elseif ($tam == 'quanlysanpham' && $query == 'them') {
        include("modules/quanlysanpham/them.php");
        include("modules/quanlysanpham/lietke.php");
    } elseif ($tam == 'quanlysanpham' && $query == 'sua') {
        include("modules/quanlysanpham/sua.php");
    } elseif ($tam == 'quanlydonhang' && $query == 'lietke') {
        include("modules/quanlydonhang/lietke.php");
    } elseif ($tam == 'donhang' && $query == 'xemdonhang') {
        include("modules/quanlydonhang/xemdonhang.php");
    } elseif ($tam == 'quanlydanhmuctintuc' && $query == 'them') {
        include("modules/quanlydanhmuctintuc/them.php");
        include("modules/quanlydanhmuctintuc/lietke.php");
    } elseif ($tam == 'quanlydanhmuctintuc' && $query == 'sua') {
        include("modules/quanlydanhmuctintuc/sua.php");
    } elseif ($tam == 'quanlydanhmuctintuc' && $query == 'lietke') {
        include("modules/quanlydanhmuctintuc/lietke.php");
    } elseif ($tam == 'quanlytintuc' && $query == 'them') {
        include("modules/quanlytintuc/them.php");
        include("modules/quanlytintuc/lietke.php");
    } elseif ($tam == 'quanlytintuc' && $query == 'sua') {
        include("modules/quanlytintuc/sua.php");
    } elseif ($tam == 'quanlyweb' && $query == 'capnhat') {
        include("modules/thongtinweb/quanly.php");
    } elseif ($tam == 'quanlydonhang' && $query == 'suadonhang') {
        include("modules/quanlydonhang/suadonhang.php");
    }
    elseif ($tam == 'quanlysanpham' && $query == 'timkiem') {
        include("modules/quanlysanpham/lietke.php");
    } else {
        include("modules/dashboard.php");
    }
    ?>
</div>