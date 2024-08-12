<?php
include("../../config/config.php");

//  $_POST['dựa vào name đã đặt bên them.php']
$tensanpham = $_POST['tensanpham'];
$masp = $_POST['masp'];
$giasp = $_POST['giasp'];
$giagiam = $_POST['giagiam'];
$phantram = $_POST['phantram'];
$soluong = $_POST['soluong'];
//  Xử lý ảnh
$hinhanh = $_FILES['hinhanh']['name'];
$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
$hinhanh = time() . '_' . $hinhanh;
$tomtat = $_POST['tomtat'];
$noidung = $_POST['noidung'];
$tinhtrang = $_POST['tinhtrang'];
$danhmuc = $_POST['danhmuc'];

if (isset($_POST['themsanpham'])) {
    //  Thêm sản phẩm
    $sql_them = "INSERT INTO tbl_sanpham(tensanpham, masp, giasp, giagiam, phantram, soluong, hinhanh, tomtat, noidung, tinhtrang, id_danhmuc) 
    VALUE('" . $tensanpham . "','" . $masp . "','" . $giasp . "','" . $giagiam . "', '" . $phantram . "','" . $soluong . "','" . $hinhanh . "','" . $tomtat . "','" . $noidung . "','" . $tinhtrang . "', '" . $danhmuc . "')";
    mysqli_query($mysqli, $sql_them);
    move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
    header('Location:../../index.php?action=quanlysanpham&query=them');
} else if (isset($_POST['suasanpham'])) {
    //  Sửa sản phẩm
    if (!empty($_FILES['hinhanh']['name'])) {   //  Nếu có hình ảnh mới 
        //  Di chuyển ảnh mới vào uploads
        move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
        //  Update hình ảnh mới
        $sql_update = "UPDATE tbl_sanpham 
        SET tensanpham='" . $tensanpham . "', masp='" . $masp . "',giasp='" . $giasp . "', 
        giagiam='" . $giagiam . "', phantram='".$phantram."',
        soluong='" . $soluong . "',hinhanh='" . $hinhanh . "',tomtat='" . $tomtat . "',
        noidung='" . $noidung . "',tinhtrang='" . $tinhtrang . "',id_danhmuc='" . $danhmuc . "' 
        WHERE id_sanpham='$_GET[idsanpham]'";
        //  Xoá hình ảnh cũ
        $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$_GET[idsanpham]' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_array($query)) {
            unlink('uploads/' . $row['hinhanh']);
        }
    } else {
        $sql_update = "UPDATE tbl_sanpham 
        SET tensanpham='" . $tensanpham . "', masp='" . $masp . "',giasp='" . $giasp . "',
        giagiam='" . $giagiam . "', phantram='".$phantram."',
        soluong='" . $soluong . "',tomtat='" . $tomtat . "',
        noidung='" . $noidung . "',tinhtrang='" . $tinhtrang . "',id_danhmuc='" . $danhmuc . "' 
        WHERE id_sanpham='$_GET[idsanpham]'";
    }
    mysqli_query($mysqli, $sql_update);
    header('Location:../../index.php?action=quanlysanpham&query=them');
} else {
    //  Xoá sản phẩm
    $id = $_GET['idsanpham'];
    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$id' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($query)) {
        unlink('uploads/' . $row['hinhanh']);
    }
    $sql_xoa = "DELETE FROM tbl_sanpham WHERE id_sanpham='" . $id . "'";
    mysqli_query($mysqli, $sql_xoa);
    header("Location:../../index.php?action=quanlysanpham&query=them");
}
