<?php
$sql_sua_danhmucbv = "SELECT * FROM tbl_danhmuctintuc WHERE id_baiviet='$_GET[idbaiviet]'LIMIT 1";
$query_sua_danhmucbv = mysqli_query($mysqli, $sql_sua_danhmucbv);
?>

<p>
<h1 class="title-sua">SỬA DANH MỤC TIN TỨC</h1>
</p>

<table class="bang-sua" border="1" width="50%" border-collapse=collapse>
    <form action="modules/quanlydanhmuctintuc/xuly.php?idbaiviet=<?php echo $_GET['idbaiviet'] ?>" method="POST">
        <?php
        while ($dong = mysqli_fetch_array($query_sua_danhmucbv)) {
        ?>
            <tr>
                <th colspan="2">Điền danh mục bài viêt</th>
            </tr>
            <tr>
                <td>Tên danh mục</td>
                <td><input type="text" value="<?php echo $dong['tendanhmuc_baiviet'] ?>" name="tendanhmucbaiviet"></td>
            </tr>
            <tr>
                <td>Thứ tự</td>
                <td><input type="text" value="<?php echo $dong['thutu'] ?>" name="thutu"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="suadanhmucbaiviet" value="Cập nhật lại danh mục bài viết"></td>
            </tr>
        <?php
        }
        ?>
    </form>
</table>

