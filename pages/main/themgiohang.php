<h1>giỏ hàng</h1>
<?php
session_start();
include("../../admincp/config/config.php");

//  Thêm số lượng
if (isset($_GET['cong'])) {
    $id = $_GET['cong'];
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            $product[] = array('id' => $cart_item['id'], 'tensanpham' => $cart_item['tensanpham'], 'masp' => $cart_item['masp'], 'giasp' => $cart_item['giasp'], 'soluong' =>  $cart_item['soluong'], 'hinhanh' => $cart_item['hinhanh']);
            $_SESSION['cart'] = $product;
        } else {
            if ($cart_item['soluong'] < 10) {
                $tangsoluong = $cart_item['soluong'] + 1;
                $product[] = array('id' => $cart_item['id'], 'tensanpham' => $cart_item['tensanpham'], 'masp' => $cart_item['masp'], 'giasp' => $cart_item['giasp'], 'soluong' =>  $tangsoluong, 'hinhanh' => $cart_item['hinhanh']);
            } else {
                $product[] = array('id' => $cart_item['id'], 'tensanpham' => $cart_item['tensanpham'], 'masp' => $cart_item['masp'], 'giasp' => $cart_item['giasp'], 'soluong' =>  $cart_item['soluong'], 'hinhanh' => $cart_item['hinhanh']);
            }
            $_SESSION['cart'] = $product;
        }
    }
    header('Location:../../index.php?quanly=giohang');
}
//  Trừ số lượng
if (isset($_GET['tru'])) {
    $id = $_GET['tru'];
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            $product[] = array('id' => $cart_item['id'], 'tensanpham' => $cart_item['tensanpham'], 'masp' => $cart_item['masp'], 'giasp' => $cart_item['giasp'], 'soluong' =>  $cart_item['soluong'], 'hinhanh' => $cart_item['hinhanh']);
            $_SESSION['cart'] = $product;
        } else {
            if ($cart_item['soluong'] > 1) {
                $giamsoluong = $cart_item['soluong'] - 1;
                $product[] = array('id' => $cart_item['id'], 'tensanpham' => $cart_item['tensanpham'], 'masp' => $cart_item['masp'], 'giasp' => $cart_item['giasp'], 'soluong' =>  $giamsoluong, 'hinhanh' => $cart_item['hinhanh']);
            } else {
                $product[] = array('id' => $cart_item['id'], 'tensanpham' => $cart_item['tensanpham'], 'masp' => $cart_item['masp'], 'giasp' => $cart_item['giasp'], 'soluong' =>  $cart_item['soluong'], 'hinhanh' => $cart_item['hinhanh']);
            }
            $_SESSION['cart'] = $product;
        }
    }
    header('Location:../../index.php?quanly=giohang');
}
//  Xoá sản phẩm
if (isset($_SESSION['cart']) && isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            $product[] = array('id' => $cart_item['id'], 'tensanpham' => $cart_item['tensanpham'], 'masp' => $cart_item['masp'], 'giasp' => $cart_item['giasp'], 'soluong' => $cart_item['soluong'], 'hinhanh' => $cart_item['hinhanh']);
        }
        $_SESSION['cart'] = $product;
        header('Location:../../index.php?quanly=giohang');
    }
}

//  Xoá tất cả sản phẩm
if (isset($_GET['xoatatca']) && $_GET['xoatatca'] == 1) {
    unset($_SESSION['cart']);
    header('Location:../../index.php?quanly=giohang');
}

//  Thêm sản phẩm vào giỏ hàng

if (isset($_POST['themgiohang'])) {
    // session_destroy();
    $id = $_GET['idsanpham'];
    $soluong = 1;
    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham='" . $id . "' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);
    if ($row) {
        $new_product = array(array('id' => $id, 'tensanpham' => $row['tensanpham'], 'masp' => $row['masp'], 'giasp' => $row['giasp'], 'soluong' => $soluong, 'hinhanh' => $row['hinhanh']));
        //  Kiểm tra giỏ hàng tồn tại
        if (isset($_SESSION['cart'])) {
            $found = false;
            foreach ($_SESSION['cart'] as $cart_item) {
                //  Nếu dữ liệu trùng thì công thêm số lượng
                if ($cart_item['id'] == $id) {
                    $product[] = array('id' => $cart_item['id'], 'tensanpham' => $cart_item['tensanpham'], 'masp' => $cart_item['masp'], 'giasp' => $cart_item['giasp'], 'soluong' => $soluong + 1, 'hinhanh' => $cart_item['hinhanh']);
                    $found = true;
                } else {
                    //  Nếu dữ liệu không trùng thì thêm mới sản phẩm
                    $product[] = array('id' => $cart_item['id'], 'tensanpham' => $cart_item['tensanpham'], 'masp' => $cart_item['masp'], 'giasp' => $cart_item['giasp'], 'soluong' => $cart_item['soluong'], 'hinhanh' => $cart_item['hinhanh']);
                }
            }
            if ($found == false) {
                //  Liên kết dữ liệu new_product với product
                $_SESSION['cart'] = array_merge($product, $new_product);
            } else {
                $_SESSION['cart'] = $product;
            }
        } else {
            $_SESSION['cart'] = $new_product;
        }
    }
    header('Location: ../../index.php?quanly=giohang');
}
