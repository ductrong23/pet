<p>
<h1 class="title-them">THÊM TIN TỨC</h1>
</p>

<table class="bang-them" border="1" width="100%" border-collapse=collapse>
    <form action="modules/quanlytintuc/xuly.php" method="POST" enctype="multipart/form-data">
        <tr>
            <td>Tên bài viết</td>
            <td><input type="text" name="tenbaiviet"></td>
        </tr>

        <tr>
            <td>Hình ảnh</td>
            <td><input type="file" name="hinhanh"></td>
        </tr>

        <tr>
            <td>Tóm tắt</td>
            <td><textarea rows="10" name="tomtat" id="tomtattintuc" style="resize:none"></textarea></td>
        </tr>

        <tr>
            <td>Nội dung</td>
            <td><textarea rows="10" name="noidung" id="noidungtintuc" style="resize:none"></textarea></td>
        </tr>

        <tr>
            <td>Danh mục tin tức</td>
            <td>
                <select name="danhmuc">
                    <?php
                    $sql_danhmuc = "SELECT * FROM tbl_danhmuctintuc ORDER BY id_baiviet DESC";
                    $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
                    while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                    ?>
                        <option value="<?php echo $row_danhmuc['id_baiviet'] ?>"><?php echo $row_danhmuc['tendanhmuc_baiviet'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </td>
        </tr>

        <tr>
            <td>Tình trạng</td>
            <td>
                <select name="tinhtrang">
                    <option value="1">Kích hoạt</option>
                    <option value="0">Ẩn</option>
                </select>
            </td>
        </tr>

        <tr>
            <td colspan="2"><input type="submit" name="thembaiviet" value="Thêm bài viết"></td>
        </tr>
    </form>
</table>

