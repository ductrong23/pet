
<?php
$sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc ORDER BY thutu DESC";
$query_lietke_danhmucsp = mysqli_query($mysqli, $sql_lietke_danhmucsp);

?>
<h1 class="title-liet-ke">LIỆT KÊ DANH MỤC SẢN PHẨM</h1>
<table class="bang-liet-ke" style="width:100%" border="1" style="border-collapse:collapse">
    <tr>
        <th>ID</th>
        <th>Tên danh mục</th>
        <th>Quản lý</th>
    </tr>
    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query_lietke_danhmucsp)) {
        $i++;
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $row['tendanhmuc'] ?></td>
        <td>
        <a href="?action=quanlydanhmucsanpham&query=sua&iddanhmuc=<?php echo $row['id_danhmuc'] ?>"  ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
            <a href="modules/quanlydanhmucsanpham/xuly.php?iddanhmuc=<?php echo $row['id_danhmuc'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục sản phẩm này?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a> 
        </td>
    </tr>
    <?php
    }
    ?>
</table>

