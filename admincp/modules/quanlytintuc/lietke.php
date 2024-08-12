<?php
$sql_lietke_bv = "SELECT * FROM tbl_tintuc, tbl_danhmuctintuc 
WHERE tbl_tintuc.id_danhmuc=tbl_danhmuctintuc.id_baiviet 
ORDER BY tbl_tintuc.id_danhmuc DESC";
$query_lietke_bv = mysqli_query($mysqli, $sql_lietke_bv);
?>
<h1 class="title-liet-ke">LIỆT KÊ TIN TỨC</h1>
<table class="bang-liet-ke" style="width:100%" border="1" style="border-collapse:collapse">
    <tr>
        <th>ID</th>
        <th>Tên bài viết</th>
        <th>Danh mục</th>
        <th>Hình ảnh</th>
        <th>Tóm tắt</th>
        <th>Nội dung</th>
        <th>Trạng thái</th>
        <th>Quản lý</th>
    </tr>
    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query_lietke_bv)) {
        $i++;
    ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row['tenbaiviet'] ?></td>
            <td><?php echo $row['tendanhmuc_baiviet'] ?></td>
            <td><img src="modules/quanlytintuc/uploads/<?php echo $row['hinhanh'] ?>" width="150px"></td>
            <td><?php echo $row['tomtat'] ?></td>
            <td><?php echo $row['noidung'] ?></td>
            <td><?php if ($row['tinhtrang'] == 1) {
                    echo 'Kích hoạt';
                } else {
                    echo 'Ẩn';
                }
                ?></td>
            <td>
            <a href="?action=quanlytintuc&query=sua&idbaiviet=<?php echo $row['id'] ?>">Sửa</a> |
                <a href="modules/quanlytintuc/xuly.php?idbaiviet=<?php echo $row['id'] ?>"  onclick="return confirm('Bạn có chắc chắn muốn xóa tin tức này?');">Xoá</a>

            </td>
        </tr>
    <?php
    }
    ?>
</table>

