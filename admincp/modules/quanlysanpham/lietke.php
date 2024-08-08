<?php
$sql_lietke_sp = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc ORDER BY id_sanpham DESC";
$query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);
?>
<h1 class="title-liet-ke-san-pham">LIỆT KÊ SẢN PHẨM</h1>
<table class="bang-liet-ke" style="width:100%" border="1" style="border-collapse:collapse">
    <tr>
        <th>ID</th>
        <th>Tên sản phẩm</th>
        <th>Mã sản phẩm</th>
        <th>Giá sản phẩm</th>
        <th>Giá gốc</th>
        <th>Số lượng</th>
        <th>Hình ảnh</th>
        <th>Tóm tắt</th>
        <th>Nội dung</th>
        <th>Trạng thái</th>
        <th>Danh mục</th>
        <th>Quản lý</th>
    </tr>
    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query_lietke_sp)) {
        $i++;
    ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row['tensanpham'] ?></td>
            <td><?php echo $row['masp'] ?></td>
            <td><?php echo $row['giasp'] ?></td>
            <td><?php echo $row['giagiam'] ?></td>
            <td><?php echo $row['soluong'] ?></td>
            <td><img src="modules/quanlysanpham/uploads/<?php echo $row['hinhanh'] ?>" width="150px"></td>
            <td><?php echo $row['tomtat'] ?></td>
            <td><?php echo $row['noidung'] ?></td>
            <td><?php if ($row['tinhtrang'] == 1) {
                    echo 'Kích hoạt';
                } else {
                    echo 'Ẩn';
                }
                ?></td>
            <td><?php echo $row['tendanhmuc'] ?></td>
            <td>
                <a href="modules/quanlysanpham/xuly.php?idsanpham=<?php echo $row['id_sanpham'] ?>">Xoá</a> |
                <a href="?action=quanlysanpham&query=sua&idsanpham=<?php echo $row['id_sanpham'] ?>">Sửa</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>

