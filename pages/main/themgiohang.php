// themgiohang.php
<h1>giỏ hàng</h1>
<?php
session_start();
include("../../admincp/config/config.php");

function themSanPhamVaoGio($id, $soluong = 1) {
    global $mysqli;
    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham='" . $id . "' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);
    if ($row) {
        $new_product = array(array('id' => $id, 'tensanpham' => $row['tensanpham'], 'masp' => $row['masp'], 'giasp' => $row['giasp'], 'soluong' => $soluong, 'hinhanh' => $row['hinhanh']));
        // Kiểm tra giỏ hàng tồn tại
        if (isset($_SESSION['cart'])) {
            $found = false;
            foreach ($_SESSION['cart'] as $cart_item) {
                if ($cart_item['id'] == $id) {
                    $product[] = array('id' => $cart_item['id'], 'tensanpham' => $cart_item['tensanpham'], 'masp' => $cart_item['masp'], 'giasp' => $cart_item['giasp'], 'soluong' => $cart_item['soluong'] + $soluong, 'hinhanh' => $cart_item['hinhanh']);
                    $found = true;
                } else {
                    $product[] = array('id' => $cart_item['id'], 'tensanpham' => $cart_item['tensanpham'], 'masp' => $cart_item['masp'], 'giasp' => $cart_item['giasp'], 'soluong' => $cart_item['soluong'], 'hinhanh' => $cart_item['hinhanh']);
                }
            }
            if ($found == false) {
                $_SESSION['cart'] = array_merge($product, $new_product);
            } else {
                $_SESSION['cart'] = $product;
            }
        } else {
            $_SESSION['cart'] = $new_product;
        }
    }
}

if (isset($_POST['themgiohang']) || isset($_GET['idsanpham'])) {
    $id = isset($_POST['idsanpham']) ? $_POST['idsanpham'] : $_GET['idsanpham'];
    themSanPhamVaoGio($id);
    header('Location: ../../index.php?quanly=giohang');
    exit();
}

//  Thêm số lượng sản phẩm trong giỏ hàng
if (isset($_GET['cong'])) {
    $id = $_GET['cong'];
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            $product[] = array('id' => $cart_item['id'], 'tensanpham' => $cart_item['tensanpham'], 'masp' => $cart_item['masp'], 'giasp' => $cart_item['giasp'], 'soluong' =>  $cart_item['soluong'], 'hinhanh' => $cart_item['hinhanh']);
        } else {
            if ($cart_item['soluong'] < 10) {
                $tangsoluong = $cart_item['soluong'] + 1;
                $product[] = array('id' => $cart_item['id'], 'tensanpham' => $cart_item['tensanpham'], 'masp' => $cart_item['masp'], 'giasp' => $cart_item['giasp'], 'soluong' =>  $tangsoluong, 'hinhanh' => $cart_item['hinhanh']);
            } else {
                $product[] = array('id' => $cart_item['id'], 'tensanpham' => $cart_item['tensanpham'], 'masp' => $cart_item['masp'], 'giasp' => $cart_item['giasp'], 'soluong' =>  $cart_item['soluong'], 'hinhanh' => $cart_item['hinhanh']);
            }
        }
    }
    $_SESSION['cart'] = $product;
    header('Location: ../../index.php?quanly=giohang');
    exit();
}

//  Trừ số lượng sản phẩm trong giỏ hàng
if (isset($_GET['tru'])) {
    $id = $_GET['tru'];
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            $product[] = array('id' => $cart_item['id'], 'tensanpham' => $cart_item['tensanpham'], 'masp' => $cart_item['masp'], 'giasp' => $cart_item['giasp'], 'soluong' =>  $cart_item['soluong'], 'hinhanh' => $cart_item['hinhanh']);
        } else {
            if ($cart_item['soluong'] > 1) {
                $giamsoluong = $cart_item['soluong'] - 1;
                $product[] = array('id' => $cart_item['id'], 'tensanpham' => $cart_item['tensanpham'], 'masp' => $cart_item['masp'], 'giasp' => $cart_item['giasp'], 'soluong' =>  $giamsoluong, 'hinhanh' => $cart_item['hinhanh']);
            } else {
                $product[] = array('id' => $cart_item['id'], 'tensanpham' => $cart_item['tensanpham'], 'masp' => $cart_item['masp'], 'giasp' => $cart_item['giasp'], 'soluong' =>  $cart_item['soluong'], 'hinhanh' => $cart_item['hinhanh']);
            }
        }
    }
    $_SESSION['cart'] = $product;
    header('Location: ../../index.php?quanly=giohang');
    exit();
}

//  Xoá sản phẩm trong giỏ hàng
if (isset($_SESSION['cart']) && isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            $product[] = array('id' => $cart_item['id'], 'tensanpham' => $cart_item['tensanpham'], 'masp' => $cart_item['masp'], 'giasp' => $cart_item['giasp'], 'soluong' => $cart_item['soluong'], 'hinhanh' => $cart_item['hinhanh']);
        }
    }
    $_SESSION['cart'] = $product;
    header('Location: ../../index.php?quanly=giohang');
    exit();
}

//  Xoá tất cả sản phẩm trong giỏ hàng
if (isset($_GET['xoatatca']) && $_GET['xoatatca'] == 1) {
    unset($_SESSION['cart']);
    header('Location: ../../index.php?quanly=giohang');
    exit();
}
?>


