<?php
$sql_lietke_danhmucbv = "SELECT * FROM tbl_danhmuctintuc ORDER BY thutu DESC";
$query_lietke_danhmucbv = mysqli_query($mysqli, $sql_lietke_danhmucbv);
?>
<h1 class="title-liet-ke">LIỆT KÊ DANH MỤC TIN TỨC</h1>
<table class="bang-liet-ke" style="width:100%" border="1" style="border-collapse:collapse">
    <tr>
        <th>ID</th>
        <th>Tên danh mục</th>
        <th>Quản lý</th>
    </tr>
    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query_lietke_danhmucbv)) {
        $i++;
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $row['tendanhmuc_baiviet'] ?></td>
        <td>
            <a href="modules/quanlydanhmuctintuc/xuly.php?idbaiviet=<?php echo $row['id_baiviet'] ?>">Xoá</a> |
            <a href="?action=quanlydanhmuctintuc&query=sua&idbaiviet=<?php echo $row['id_baiviet'] ?>">Sửa</a>
        </td>
    </tr>
    <?php
    }
    ?>
</table>

