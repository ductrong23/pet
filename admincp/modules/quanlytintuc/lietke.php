<!--    TÌM KIẾM TIN TỨC -->
<h1 class="title-liet-ke-tin-tuc">TÌM KIẾM TIN TỨC</h1>
<form action="" method="POST">
    <input type="hidden" name="action" value="quanlytintuc">
    <input type="hidden" name="query" value="timkiem">
    <div class="tim-kiem">
        <input class="o-tim-kiem-liet-ke" type="text" name="search_query" placeholder="Tìm kiếm tin tức...">
        <input class="nut-tim-kiem-liet-ke" type="submit" value="Tìm kiếm">
    </div>
</form>


<?php
if (isset($_POST['search_query'])) {
    $search_query = $_POST['search_query'];
    $sql_timkiem_tt = "SELECT * FROM tbl_tintuc, tbl_danhmuctintuc 
                      WHERE tbl_tintuc.id_danhmuc=tbl_danhmuctintuc.id_baiviet 
                      AND (tenbaiviet LIKE '%" . $search_query . "%' 
                      OR tomtat LIKE '%" . $search_query . "%')
                      ORDER BY id DESC";
} else {
    $sql_timkiem_tt = "SELECT * FROM tbl_tintuc, tbl_danhmuctintuc 
                      WHERE tbl_tintuc.id_danhmuc=tbl_danhmuctintuc.id_baiviet 
                      ORDER BY id DESC";
}
$query_timkiem_tt = mysqli_query($mysqli, $sql_timkiem_tt);
?>




<!-- <?php
$sql_lietke_bv = "SELECT * FROM tbl_tintuc, tbl_danhmuctintuc 
WHERE tbl_tintuc.id_danhmuc=tbl_danhmuctintuc.id_baiviet 
ORDER BY tbl_tintuc.id_danhmuc DESC";
$query_lietke_bv = mysqli_query($mysqli, $sql_lietke_bv);
?> -->
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
    // while ($row = mysqli_fetch_array($query_lietke_bv)) {
        while ($row = mysqli_fetch_array($query_timkiem_tt)) {
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
            <a href="?action=quanlytintuc&query=sua&idbaiviet=<?php echo $row['id'] ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                <a href="modules/quanlytintuc/xuly.php?idbaiviet=<?php echo $row['id'] ?>"  onclick="return confirm('Bạn có chắc chắn muốn xóa tin tức này?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>

            </td>
        </tr>
    <?php
    }
    ?>
</table>



<style>
    .tim-kiem {
        text-align: -webkit-center;
        margin-top: 50px;
        margin-bottom: 50px;
    }

    input.o-tim-kiem-liet-ke {
        padding: 15px;
        border-radius: 20px;
        width: 300px;
        border: 2px solid black;
        font-size: medium;
    }

    input.o-tim-kiem-liet-ke:hover {
        border: 2px solid green;
    }

    input.o-tim-kiem-liet-ke:focus {
        background-color: bisque;
    }


    input.nut-tim-kiem-liet-ke {
        padding: 15px;
        border-radius: 20px;
        width: 85px;
        border: 2px solid black;
        height: calc(6 - 2px);
        transition: 0.5s;
        position: relative;
    }

    input.nut-tim-kiem-liet-ke:hover {
        scale: 1.06;
        background-color: #123f39;
        color: white
    }
</style>