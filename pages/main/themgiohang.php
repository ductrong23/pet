<h1>giỏ hàng</h1>
<?php
session_start();
include("../../admincp/config/config.php");
include "../../cart_functions.php";


function themSanPhamVaoGio($id, $soluong = 1, $clearCart = false, $buyNow = false)
{

    // Đảm bảo $_SESSION['cart'] được khởi tạo
    if (empty($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    global $mysqli;
    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham='" . $id . "' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);
    if ($row) {
        $new_product = array(array('id' => $id, 'tensanpham' => $row['tensanpham'], 'masp' => $row['masp'], 'giasp' => $row['giasp'], 'soluong' => $soluong, 'hinhanh' => $row['hinhanh']));
        if ($buyNow) {
            $_SESSION['muangay'] = $new_product;
            $_SESSION['muangay_time'] = time(); // Lưu thời gian tạo session
        } else {

            // Kiểm tra giỏ hàng tồn tại
            if (isset($_SESSION['cart'])) {

                $product = []; // Khởi tạo mảng rỗng cho biến $product
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

    //  LƯU SẢN PHẨM ĐƯỢC THÊM VÀO GIỎ HÀNG
    if (isset($_SESSION['id_khachhang'])) {
        $userId = $_SESSION['id_khachhang'];
        saveUserCart($userId, $_SESSION['cart']);
    }
}


// Kiểm tra thời gian hết hạn trước khi thực hiện mua hàng
function kiemTraMuaNgayHetHan()
{
    if (isset($_SESSION['muangay_time'])) {
        $hienTai = time();
        $thoiGianTao = $_SESSION['muangay_time'];
        $thoiHan = 90;

        if (($hienTai - $thoiGianTao) > $thoiHan) {
            unset($_SESSION['muangay']);
            unset($_SESSION['muangay_time']);
            return false;
        }
    }
    return true;
}

//  NÚT MUA NGAY => ĐIỀU HƯỚNG VỀ THÔNG TIN VẬN CHUYỂN
if (isset($_POST['muangay']) || (isset($_GET['action']) && $_GET['action'] == 'muangay')) {
    // $id = isset($_GET['idsanpham']) ? $_GET['idsanpham'] : '';
    $id = isset($_POST['idsanpham']) ? $_POST['idsanpham'] : $_GET['idsanpham'];
    if ($id) {
        themSanPhamVaoGio($id, 1, false, true);
        if (kiemTraMuaNgayHetHan()) {
            if (isset($_SESSION['id_khachhang'])) {
                echo "<script>window.location.href='../../index.php?quanly=vanchuyen';</script>";
            } else {
                echo "<script>window.location.href='../../index.php?quanly=vanchuyenoff';</script>";
            }
        } else {
            echo "Thời gian mua hàng đã hết, vui lòng thêm sản phẩm lại.";
            header('Location: ../../index.php');
        }
        exit();
    }
}


//  NÚT THÊM GIỎ HÀNG => ĐIỀU HƯỚNG VỀ (GIỎ HÀNG) SẢN PHẨM ĐANG XEM
if (isset($_POST['themgiohang'])) {
    // $id = isset($_POST['idsanpham']) ? $_POST['idsanpham'] : $_GET['idsanpham'];
    $id = isset($_POST['idsanpham']) ? $_POST['idsanpham'] : '';
    themSanPhamVaoGio($id);
    // header('Location: ../../index.php?quanly=giohang');
    header('Location: ../../index.php?quanly=sanpham&id='.$id);
    exit();
}

//  ICON GIỎ HÀNG => VẪN Ở TRANG INDEX
if (isset($_GET['idsanpham'])) {
    // $id = isset($_POST['idsanpham']) ? $_POST['idsanpham'] : $_GET['idsanpham'];
    $id = isset($_GET['idsanpham']) ? $_GET['idsanpham'] : '';
    themSanPhamVaoGio($id);
    header('Location: ../../index.php');
    exit();
}




//  Thêm số lượng sản phẩm trong giỏ hàng
if (isset($_GET['cong'])) {
    $id = $_GET['cong'];

    $product = array(); // Khởi tạo mảng rỗng

    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            // $product = [];
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


    // Kiểm tra và tăng số lượng cho sản phẩm trong $_SESSION['muangay']
    if (isset($_SESSION['muangay'])) {
        foreach ($_SESSION['muangay'] as &$cart_item) {
            if ($cart_item['id'] == $id) {
                if ($cart_item['soluong'] < 10) {
                    $cart_item['soluong'] += 1;
                }
                break;
            }
        }
    }


    if (isset($_SESSION['id_khachhang'])) {
        saveUserCart($_SESSION['id_khachhang'], $_SESSION['cart']);
    }

    // header('Location: ../../index.php?quanly=giohang');
    // Điều hướng về trang đang xem
    $redirect_page = isset($_GET['redirect']) ? $_GET['redirect'] : 'giohang';
    header('Location: ../../index.php?quanly=' . $redirect_page);

    exit();
}

//  Trừ số lượng sản phẩm trong giỏ hàng
if (isset($_GET['tru'])) {
    $id = $_GET['tru'];

    $product = array(); // Khởi tạo mảng rỗng

    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            // $product = [];
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

    // Kiểm tra và giảm số lượng cho sản phẩm trong $_SESSION['muangay']
    if (isset($_SESSION['muangay'])) {
        foreach ($_SESSION['muangay'] as &$cart_item) {
            if ($cart_item['id'] == $id) {
                if ($cart_item['soluong'] > 1) {
                    $cart_item['soluong'] -= 1;
                }
                break;
            }
        }
    }

    if (isset($_SESSION['id_khachhang'])) {
        saveUserCart($_SESSION['id_khachhang'], $_SESSION['cart']);
        // error_log("Saved cart after adding product: " . print_r($_SESSION['cart'], true));
    }
    // header('Location: ../../index.php?quanly=giohang');
    // Điều hướng về trang đang xem
    $redirect_page = isset($_GET['redirect']) ? $_GET['redirect'] : 'giohang.php';
    header('Location: ../../index.php?quanly=' . $redirect_page);
    exit();
}

//  Xoá sản phẩm trong giỏ hàng
if (isset($_SESSION['cart']) && isset($_GET['xoa'])) {
    $id = $_GET['xoa'];

    $product = array(); // Khởi tạo mảng rỗng

    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            // $product = [];
            $product[] = array('id' => $cart_item['id'], 'tensanpham' => $cart_item['tensanpham'], 'masp' => $cart_item['masp'], 'giasp' => $cart_item['giasp'], 'soluong' => $cart_item['soluong'], 'hinhanh' => $cart_item['hinhanh']);
        }
    }
    $_SESSION['cart'] = $product;

    if (isset($_SESSION['id_khachhang'])) {
        saveUserCart($_SESSION['id_khachhang'], $_SESSION['cart']);
        // error_log("Saved cart after adding product: " . print_r($_SESSION['cart'], true));
    }

    header('Location: ../../index.php?quanly=giohang');
    exit();
}

//  Xoá tất cả sản phẩm trong giỏ hàng
if (isset($_GET['xoatatca']) && $_GET['xoatatca'] == 1) {

    if (isset($_SESSION['id_khachhang'])) {
        saveUserCart($_SESSION['id_khachhang'], array()); // Save an empty cart
    }
    unset($_SESSION['cart']);

    header('Location: ../../index.php?quanly=giohang');
    exit();
}

?>


<!-- //  CẢ ICON GIỎ HÀNG - THÊM GIỎ HÀNG => ĐIỀU HƯỚNG VỀ GIỎ HÀNG 

// if (isset($_POST['themgiohang']) || isset($_GET['idsanpham'])) {
//     $id = isset($_POST['idsanpham']) ? $_POST['idsanpham'] : $_GET['idsanpham'];
//     themSanPhamVaoGio($id);
//     header('Location: ../../index.php?quanly=giohang');
//     exit();
// } -->