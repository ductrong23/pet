<?php
include("../../config/config.php");

//  $_POST['dựa vào name đã đặt bên them.php']
$tenbaiviet = $_POST['tenbaiviet'];
//  Xử lý ảnh
$hinhanh = $_FILES['hinhanh']['name'];
$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
$hinhanh = time() . '_' . $hinhanh;
//
$tomtat = $_POST['tomtat'];
$noidung = $_POST['noidung'];
$tinhtrang = $_POST['tinhtrang'];
$danhmuc = $_POST['danhmuc'];

if (isset($_POST['thembaiviet'])) {
    //  Thêm tin tức
    $sql_them = "INSERT INTO tbl_tintuc(tenbaiviet, tomtat, noidung,  id_danhmuc, tinhtrang, hinhanh) 
    VALUE('" . $tenbaiviet . "','" . $tomtat . "','" . $noidung . "','" . $danhmuc . "','" . $tinhtrang . "','" . $hinhanh . "')";
    mysqli_query($mysqli, $sql_them);
    move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
    header('Location:../../index.php?action=quanlytintuc&query=them');
} else if (isset($_POST['suabaiviet'])) {
    //  Sửa tin tức
    if (!empty($_FILES['hinhanh']['name'])) {   //  Nếu có hình ảnh mới 
        //  Di chuyển ảnh mới vào uploads
        move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
        //  Update hình ảnh mới
        $sql_update = "UPDATE tbl_tintuc SET tenbaiviet='" . $tenbaiviet . "',tomtat='" . $tomtat . "',noidung='" . $noidung . "',id_danhmuc='" . $danhmuc . "',tinhtrang='" . $tinhtrang . "',hinhanh='" . $hinhanh . "'
        WHERE id='$_GET[idbaiviet]'";
        //  Xoá hình ảnh cũ
        $sql = "SELECT * FROM tbl_baiviet WHERE id = '$_GET[idbaiviet]' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_array($query)) {
            unlink('uploads/' . $row['hinhanh']);
        }
    } else {
        $sql_update = "UPDATE tbl_tintuc SET tenbaiviet='" . $tenbaiviet . "',tomtat='" . $tomtat . "',noidung='" . $noidung . "',id_danhmuc='" . $danhmuc . "',tinhtrang='" . $tinhtrang . "'
        WHERE id='$_GET[idbaiviet]'";
    }
    mysqli_query($mysqli, $sql_update);
    header('Location:../../index.php?action=quanlytintuc&query=them');
} else {
    //  Xoá tin tức
    $id = $_GET['idbaiviet'];
    $sql = "SELECT * FROM tbl_tintuc WHERE id = '$id' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($query)) {
        unlink('uploads/' . $row['hinhanh']);
    }
    $sql_xoa = "DELETE FROM tbl_tintuc WHERE id='" . $id . "'";
    mysqli_query($mysqli, $sql_xoa);
    header("Location:../../index.php?action=quanlytintuc&query=them");
}
